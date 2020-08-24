<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Panier;

use AppBundle\Entity\Linge;
use AppBundle\Entity\Paiement;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Statistique;
use AppBundle\Entity\Statistique3;
use AppBundle\Entity\TypeTissu;
use AppBundle\Form\ClientType;
use AppBundle\Form\PanierType;

use AppBundle\Form\LingeType;
use AppBundle\Form\PaiementType;
use AppBundle\Form\ProduitType;
use AppBundle\Form\TypeTissuType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class PanierController extends Controller
{

    /**
     * @Route("/addPanier",name="addPanier")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     *
     */
    public function addAction(request $request)
    {
        $Panier = new Panier();

        $date=new \DateTime('now');

        $form = $this->createform(PanierType::class, $Panier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $enregistrement = $this->getDoctrine()->getManager();

            $repository= $this->getDoctrine()->getRepository('AppBundle:Panier');

            $Paniers= $repository->findAll();

            $i=0;

            foreach($Paniers as $Pani)
            {

                if( $Pani->getProduit()->getId()==$Panier->getProduit()->getId()  and $Pani->getEtat()==0)
                {
                    $Pani->setQuantite($Panier->getQuantite()+$Pani->getQuantite());
                    $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

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
                        $statis->setMontant( (int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite()) + $tota );
                        $e->flush();

                    }

                    if($b==0)
                    {
                        $e= $this->getDoctrine()->getManager();
                        $stat = new Statistique3();
                        $stat->setDate(new \DateTime('now'));
                        $stat->setMontant( ((int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite() ) )  );
                        $e->persist($stat);
                        $e->flush();
                    }
                    $enregistrement->flush();

                    $this->addFlash('notice', 'Enregistrement reussi');

                    return $this->redirectToRoute('addPanier');

                }
            }


            if($i==0)
            {
                $Panier->setDate(new \DateTime('now'));
                $Panier->setEtat(0);

                $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

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
                    $statis->setMontant( (int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite()) + $tota );
                    $e->flush();

                }

                if($b==0)
                {
                    $e= $this->getDoctrine()->getManager();
                    $stat = new Statistique3();
                    $stat->setDate(new \DateTime('now'));
                    $stat->setMontant( ((int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite() ) )  );
                    $e->persist($stat);
                    $e->flush();
                }
                $enregistrement->persist($Panier);
                $enregistrement->flush();

                $this->addFlash('notice', 'Enregistrement reussi');

                return $this->redirectToRoute('addPanier');

            }







            /* if($bool==0)
             {
                 $enregistrement = $this->getDoctrine()->getManager();
                 $Panier->setDate(new \DateTime('now'));
                 $Panier->setEtat(0);
                 $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

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
                     $statis->setMontant( (int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite()) + $tota );
                     $e->flush();

                 }

                 if($b==0)
                 {
                     $e= $this->getDoctrine()->getManager();
                     $stat = new Statistique3();
                     $stat->setDate(new \DateTime('now'));
                     $stat->setMontant( ((int) ($Panier->getProduit()->getPrix()*$Panier->getQuantite() ) )  );
                     $e->persist($stat);
                     $e->flush();
                 }
                 $enregistrement->persist($Panier);
                 $enregistrement->flush();

                 $this->addFlash('notice', 'Enregistrement reussi');

                 return $this->redirectToRoute('addPanier');

             }*/



        }

        $formView = $form->createView();


        $Produit = new Produit();

        $Produitform = $this->createform(ProduitType::class, $Produit);

        $Produitform->handleRequest($request);

        if ($Produitform->isSubmitted() && $Produitform->isValid()) {

            $repository= $this->getDoctrine()->getRepository('AppBundle:Produit');

            $ProduitS= $repository->findAll();

            $bool=0;
            foreach ($ProduitS as $type)
            {
                if($type->getnom()==$Produit->getnom())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Produit);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('addPanier');
            }else
            {
                $this->addFlash('notice', 'Produit deja existant!!');

                return $this->redirectToRoute('addPanier');

            }

        }

        $formProduitView = $Produitform->createView();

        $cli = $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients = $cli->findAll();

        $P = $this->getDoctrine()->getRepository('AppBundle:Panier');

        $ps = $P->findAll();




        return $this->render('PanierAdd.html.twig', ['date'=>$date,'clients' => $clients, 'form' => $formView, 'formProduit' => $formProduitView,'Paniers'=>$ps]);


    }

    /**
     * @Route("/listPanier",name="listePanier")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listPanierAction(Request $request)
    {


        $repository= $this->getDoctrine()->getRepository('AppBundle:Panier');

        $PanierS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PanierList.html.twig',['clients'=>$clients,'Paniers'=>$PanierS]);
    }


    /**
     *
     * @Route("/p",name="shopping")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */



    public function pressingAction()

    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Panier');

        $paniers= $repository->getPanier();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $date=new \DateTime('now');

        $rendu= $this->render('Impression3.html.twig',['paniers'=>$paniers,'clients'=>$clients,'date'=>$date ]);


        foreach($paniers as $p)
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
     * @Route("/deletePanier/{id}",name="supprimer_Panier")
     *
     */

    public function delete(Panier $Panier)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

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
            $statis->setMontant( $tota-((int) $Panier->getProduit()->getPrix() * $Panier->getQuantite())  );
            $e->flush();

        }
        $enregistrement->remove($Panier);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('addPanier');



    }



    /**
     *
     * @return Response
     *
     * @Route("/deleteP/{id}",name="supprimer_P")
     *
     */

    public function del(Panier $Panier)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

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
            $statis->setMontant( $tota-((int) $Panier->getProduit()->getPrix() * $Panier->getQuantite()) );
            $e->flush();

        }
        $enregistrement->remove($Panier);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listePanier');



    }
}
