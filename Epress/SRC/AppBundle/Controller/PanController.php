<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Pan;

use AppBundle\Entity\Linge;
use AppBundle\Entity\Paiement;
use AppBundle\Entity\Soin;
use AppBundle\Entity\Statistique;
use AppBundle\Entity\Statistique4;
use AppBundle\Entity\TypeTissu;
use AppBundle\Form\ClientType;
use AppBundle\Form\PanType;

use AppBundle\Form\LingeType;
use AppBundle\Form\PaiementType;
use AppBundle\Form\SoinType;
use AppBundle\Form\TypeTissuType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class PanController extends Controller
{

    /**
     * @Route("/addPan",name="addPan")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     *
     */
    public function addAction(request $request)
    {
        $Pan = new Pan();

        $date=new \DateTime('now');

        $form = $this->createform(PanType::class, $Pan);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $enregistrement = $this->getDoctrine()->getManager();

            $repository= $this->getDoctrine()->getRepository('AppBundle:Pan');

            $Pans= $repository->findAll();

            $i=0;

            foreach($Pans as $Pani)
            {

                if( $Pani->getSoin()->getId()==$Pan->getSoin()->getId()  and $Pani->getEtat()==0)
                {
                    $this->addFlash('notice', 'Soin deja choisi');

                    return $this->redirectToRoute('addPan');

                }
            }


            if($i==0)
            {
                $Pan->setDate(new \DateTime('now'));

                $Pan->setEtat(0);

                $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique4');

                $Statistiques= $repository->findAll();
                $b=0;
                foreach($Statistiques as $statis)
                {
                    $aujour=(new \DateTime('now'))->format('d-m-Y');

                    if($statis->getDate()->format('d-m-Y')== $aujour)
                    {
                        $b=1;
                    }
                    else
                    {
                        $b=0;
                    }
                }


                if($b==1)
                {
                    $e= $this->getDoctrine()->getManager();
                    $tota= (int) $statis->getMontant();
                    $statis->setMontant( (int) ($Pan->getSoin()->getPrix()) + $tota );
                    $e->flush();

                }

                if($b==0)
                {
                    $e= $this->getDoctrine()->getManager();
                    $stat = new Statistique4();
                    $stat->setDate(new \DateTime('now'));
                    $stat->setMontant( ((int) ($Pan->getSoin()->getPrix() ) )  );
                    $e->persist($stat);
                    $e->flush();
                }
                $enregistrement->persist($Pan);
                $enregistrement->flush();

                $this->addFlash('notice', 'Enregistrement reussi');

                return $this->redirectToRoute('addPan');

            }

        }

        $formView = $form->createView();


        $Soin = new Soin();

        $Soinform = $this->createform(SoinType::class,$Soin);

        $Soinform->handleRequest($request);

        if ($Soinform->isSubmitted() && $Soinform->isValid()) {

            $repository= $this->getDoctrine()->getRepository('AppBundle:Soin');

            $SoinS= $repository->findAll();

            $bool=0;
            foreach ($SoinS as $type)
            {
                if($type->getNom()==$Soin->getNom())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();
                $enregistrement->persist($Soin);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('addPan');
            }else
            {
                $this->addFlash('notice', 'Soin deja existant!!');

                return $this->redirectToRoute('addPan');

            }

        }

        $formSoinView = $Soinform->createView();

        $cli = $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients = $cli->findAll();

        $P = $this->getDoctrine()->getRepository('AppBundle:Pan');

        $ps = $P->findAll();


        return $this->render('PanAdd.html.twig', ['date'=>$date,'clients' => $clients, 'form' => $formView, 'formSoin' => $formSoinView,'Pans'=>$ps]);


    }

    /**
     * @Route("/listPan",name="listePan")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listPanAction(Request $request)
    {


        $repository= $this->getDoctrine()->getRepository('AppBundle:Pan');

        $PanS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PanList.html.twig',['clients'=>$clients,'Pans'=>$PanS]);
    }

    /**
     *
     * @Route("/salon",name="salon")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */



    public function SalAction()

    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Pan');

        $pans= $repository->getPan();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $date=new \DateTime('now');

        $rendu= $this->render('Impression4.html.twig',['pans'=>$pans,'clients'=>$clients,'date'=>$date ]);


        foreach($pans as $p)
        {

            $enregistrement = $this->getDoctrine()->getManager();
            $p->setEtat(1);
            $enregistrement->flush();
        }


        return $rendu;

    }



    /**
     *
     * @return Response
     *
     * @Route("/deletePan/{id}",name="supprimer_Pan")
     *
     */

    public function delete(Pan $Pan)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique4');

        $Statistiques= $repository->findAll();
        $b=0;
        foreach($Statistiques as $statis)
        {
            $aujour=(new \DateTime('now'))->format('d-m-Y');

            if($statis->getDate()->format('d-m-Y')== $aujour)
            {
                $b=1;
            }
            else
            {
                $b=0;
            }
        }


        if($b==1)
        {
            $e= $this->getDoctrine()->getManager();
            $tota= (int) $statis->getMontant();
            $statis->setMontant( $tota-((int) $Pan->getSoin()->getPrix())  );
            $e->flush();

        }
        $enregistrement->remove($Pan);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('addPan');



    }



    /**
     *
     * @return Response
     *
     * @Route("/deleteS/{id}",name="supprimer_S")
     *
     */

    public function del(Pan $Pan)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique4');

        $Statistiques= $repository->findAll();
        $b=0;
        foreach($Statistiques as $statis)
        {
            $aujour=(new \DateTime('now'))->format('d-m-Y');

            if($statis->getDate()->format('d-m-Y')== $aujour)
            {
                $b=1;
            }
            else
            {
                $b=0;
            }
        }


        if($b==1)
        {
            $e= $this->getDoctrine()->getManager();
            $tota= (int) $statis->getMontant();
            $statis->setMontant( $tota-((int) $Pan->getSoin()->getPrix()) );
            $e->flush();

        }
        $enregistrement->remove($Pan);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listePan');



    }
}
