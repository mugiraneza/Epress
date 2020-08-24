<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Produit;
use AppBundle\Form\ProduitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class ProduitController extends Controller

{
    /**
     * @Route("/addProduit",name="addProduit")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {

        $Produit= new Produit();

        $form = $this->createform(ProduitType::class,$Produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

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

                return $this->redirectToRoute('listeProduit');
            }else
            {
                $this->addFlash('notice', 'Produit deja existant!!');

                return $this->redirectToRoute('listeProduit');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('ProduitAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listProduit",name="listeProduit")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listProduitAction(Request $request)
    {

        $Produit= new Produit();

        $form = $this->createform(ProduitType::class,$Produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

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

                return $this->redirectToRoute('listeProduit');
            }else
            {
                $this->addFlash('notice', 'Produit deja existant!!');

                return $this->redirectToRoute('listeProduit');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Produit');

        $ProduitS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('ProduitList.html.twig',['clients'=>$clients,'form'=>$formView,'ProduitS'=>$ProduitS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editProduit/{id}",name="edit_Produit")
     *
     *
     *
     */



    public function edit(Request $request, Produit $Produit)
    {

        $form = $this->createform(ProduitType::class,$Produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Produit');

            $ProduitS= $repository->findAll();

            $bool=0;
            foreach ($ProduitS as $type)
            {
                if($type->getnom()==$Produit->getnom() && $type->getId()!=$Produit->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();


                $this->addFlash('notice','Edition reussie');


                $enregistrement->flush();

                return $this->redirectToRoute('listeProduit');
            }else
            {
                $this->addFlash('notice', 'Produit deja existant!!');

                return $this->redirectToRoute('listeProduit');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('ProduitAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteProduit/{id}",name="supprimer_Produit")
     *
     *
     *
     */

    public function delete(Produit $Produit)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Produit);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeProduit');



    }
}