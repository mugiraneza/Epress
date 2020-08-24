<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Linge;
use AppBundle\Form\LingeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class LingeController extends Controller

{
    /**
     * @Route("/addLinge",name="addLinge")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        
        $Linge= new Linge();

        $form = $this->createform(LingeType::class,$Linge);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

            $LingeS= $repository->findAll();

            $bool=0;
            foreach ($LingeS as $type)
            {
                if($type->getLibelle()==$Linge->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();

            $enregistrement->persist($Linge);
            $enregistrement->flush();

            $this->addFlash('notice','Enregistrement reussi');

            return $this->redirectToRoute('listeLinge');
            }else
            {
                $this->addFlash('notice', 'Linge deja existante!!');

                return $this->redirectToRoute('listeLinge');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('LingeAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listLinge",name="listeLinge")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listLingeAction(Request $request)
    {

        $Linge= new Linge();

        $form = $this->createform(LingeType::class,$Linge);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

            $LingeS= $repository->findAll();

            $bool=0;
            foreach ($LingeS as $type)
            {
                if($type->getLibelle()==$Linge->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Linge);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listeLinge');
            }else
            {
                $this->addFlash('notice', 'Linge deja existant!!');

                return $this->redirectToRoute('listeLinge');

            }

        }

        $formView= $form->createView();
        
        $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

        $LingeS= $repository->findAll();


        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('LingeList.html.twig',['clients'=>$clients,'form'=>$formView,'LingeS'=>$LingeS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editLinge/{id}",name="edit_Linge")
     *
     *
     *
     */



    public function edit(Request $request, Linge $Linge)
    {
        
        $form = $this->createform(LingeType::class,$Linge);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

            $LingeS= $repository->findAll();

            $bool=0;
            foreach ($LingeS as $type)
            {
                if($type->getLibelle()==$Linge->getLibelle() && $type->getId()!=$Linge->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('listeLinge');
            }else
            {
                $this->addFlash('notice', 'Linge deja existant!!');

                return $this->redirectToRoute('listeLinge');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('LingeAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteLinge/{id}",name="supprimer_Linge")
     *
     *
     *
     */

    public function delete(Linge $Linge)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Linge);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeLinge');



    }
}