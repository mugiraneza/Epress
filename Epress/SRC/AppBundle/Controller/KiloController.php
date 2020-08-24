<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Kilo;
use AppBundle\Entity\Statistique2;
use AppBundle\Form\KiloType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class KiloController extends Controller

{
    /**
     * @Route("/addKilo",name="addKilo")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {

        $Kilo= new Kilo();

        $form = $this->createform(KiloType::class,$Kilo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            

                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Kilo);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listeKilo');

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('KiloAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listKilo",name="listeKilo")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listKiloAction(Request $request)
    {

        $Kilo= new Kilo();

        $form = $this->createform(KiloType::class,$Kilo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){


                $enregistrement = $this->getDoctrine()->getManager();

                $date=new \DateTime('now');

                $Kilo->setDate($date);

                $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique2');

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
                    $statis->setMontant( (int) $Kilo->getPoid()->getPrix() + $tota );
                    $e->flush();

                }

                if($b==0)
                {
                    $e= $this->getDoctrine()->getManager();
                    $stat = new Statistique2();
                    $stat->setDate(new \DateTime('now'));
                    $stat->setMontant((int)$Kilo->getPoid()->getPrix());
                    $e->persist($stat);
                    $e->flush();
                }


                $enregistrement->persist($Kilo);

                $enregistrement->flush();



                $this->addFlash('notice','Enregistrement reussi');

                $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

                $clients= $cli->findAll();



                $repository= $this->getDoctrine()->getRepository('AppBundle:Kilo');

                $K= $repository->findAll();

                return $this->render('Impression2.html.twig',['clients'=>$clients,'id'=>$Kilo->getId(),'date'=>$date,'Kilo'=>$K]);


        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Kilo');

        $KiloS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('KiloList.html.twig',['clients'=>$clients,'form'=>$formView,'KiloS'=>$KiloS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editKilo/{id}",name="edit_Kilo")
     *
     *
     *
     */



    public function edit(Request $request, Kilo $Kilo)
    {

        $form = $this->createform(KiloType::class,$Kilo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Kilo');

            $KiloS= $repository->findAll();

            $bool=0;
            foreach ($KiloS as $type)
            {
                if($type->getLibelle()==$Kilo->getLibelle() && $type->getId()!=$Kilo->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();


                $this->addFlash('notice','Edition reussie');


                $enregistrement->flush();

                return $this->redirectToRoute('listeKilo');
            }else
            {
                $this->addFlash('notice', 'Type de Kilo deja existant!!');

                return $this->redirectToRoute('listeKilo');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('KiloAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteKilo/{id}",name="supprimer_Kilo")
     *
     *
     *
     */

    public function delete(Kilo $Kilo)
    {


        $enregistrement = $this->getDoctrine()->getManager();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique2');

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
            $statis->setMontant( $tota-(int) $Kilo->getPoid()->getPrix()  );
            $e->flush();

        }

        $enregistrement->remove($Kilo);

        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeKilo');



    }
}