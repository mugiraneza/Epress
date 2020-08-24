<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Couleur;
use AppBundle\Form\CouleurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class CouleurController extends Controller

{
    /**
     * @Route("/addCouleur",name="addCouleur")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        
        $Couleur= new Couleur();

        $form = $this->createform(CouleurType::class,$Couleur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

            $CouleurS= $repository->findAll();

            $bool=0;
            foreach ($CouleurS as $type)
            {
                if($type->getLibelle()==$Couleur->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();

            $enregistrement->persist($Couleur);
            $enregistrement->flush();

            $this->addFlash('notice','Enregistrement reussi');

            return $this->redirectToRoute('listeCouleur');
            }else
            {
                $this->addFlash('notice', 'Couleur deja existante!!');

                return $this->redirectToRoute('listeCouleur');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('CouleurAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listCouleur",name="listeCouleur")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listCouleurAction(Request $request)
    {

        $Couleur= new Couleur();

        $form = $this->createform(CouleurType::class,$Couleur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

            $CouleurS= $repository->findAll();

            $bool=0;
            foreach ($CouleurS as $type)
            {
                if($type->getLibelle()==$Couleur->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Couleur);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listeCouleur');
            }else
            {
                $this->addFlash('notice', 'Couleur deja existant!!');

                return $this->redirectToRoute('listeCouleur');

            }

        }

        $formView= $form->createView();
        
        $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

        $CouleurS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('CouleurList.html.twig',['clients'=>$clients,'form'=>$formView,'CouleurS'=>$CouleurS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editCouleur/{id}",name="edit_Couleur")
     *
     *
     *
     */



    public function edit(Request $request, Couleur $Couleur)
    {
        
        $form = $this->createform(CouleurType::class,$Couleur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

            $CouleurS= $repository->findAll();

            $bool=0;
            foreach ($CouleurS as $type)
            {
                if($type->getLibelle()==$Couleur->getLibelle() && $type->getId()!=$Couleur->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('listeCouleur');
            }else
            {
                $this->addFlash('notice', 'Type de couleur deja existant!!');

                return $this->redirectToRoute('listeCouleur');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('CouleurAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteCouleur/{id}",name="supprimer_Couleur")
     *
     *
     *
     */

    public function delete(Couleur $Couleur)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Couleur);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeCouleur');



    }
}