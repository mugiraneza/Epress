<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Poids;
use AppBundle\Form\PoidsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class PoidsController extends Controller

{
    /**
     * @Route("/addPoids",name="addPoids")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {

        $Poids= new Poids();

        $form = $this->createform(PoidsType::class,$Poids);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Poids');

            $Poid= $repository->findAll();

            $bool=0;
            foreach ($Poid as $type)
            {
                if($type->getEspace() == ( $Poids->getMin().'-'.$Poids->getMax() ) )
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();
                $Poids->setEspace($Poids->getMin().'-'.$Poids->getMax());
                $enregistrement->persist($Poids);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listePoids');
            }else
            {
                $this->addFlash('notice', 'Interval de Poids deja existant!!');

                return $this->redirectToRoute('listePoids');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PoidsAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listPoids",name="listePoids")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listPoidsAction(Request $request)
    {

        $Poids= new Poids();

        $form = $this->createform(PoidsType::class,$Poids);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Poids');

            $Poid= $repository->findAll();

            $bool=0;
            foreach ($Poid as $type)
            {
                if($type->getEspace() == ( $Poids->getMin().'-'.$Poids->getMax() ))
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();
                $Poids->setEspace($Poids->getMin().'-'.$Poids->getMax());
                $enregistrement->persist($Poids);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listePoids');
            }else
            {
                $this->addFlash('notice', 'Interval de Poids deja existant!!');

                return $this->redirectToRoute('listePoids');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Poids');

        $Poid= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PoidsList.html.twig',['clients'=>$clients,'form'=>$formView,'Poid'=>$Poid]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editPoids/{id}",name="edit_Poids")
     *
     *
     *
     */



    public function edit(Request $request, Poids $Poids)
    {

        $form = $this->createform(PoidsType::class,$Poids);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Poids');

            $Poid= $repository->findAll();

            $bool=0;
            foreach ($Poid as $type)
            {
                if( $type->getEspace() == ( $Poids->getMin().'-'.$Poids->getMax() ) && $type->getId()!=$Poids->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $Poids->setEspace($Poids->getMin().'-'.$Poids->getMax());

                $this->addFlash('notice','Edition reussie');


                $enregistrement->flush();

                return $this->redirectToRoute('listePoids');
            }else
            {
                $this->addFlash('notice', 'Interval de Poids deja existant!!');

                return $this->redirectToRoute('listePoids');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PoidsAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deletePoids/{id}",name="supprimer_Poids")
     *
     *
     *
     */

    public function delete(Poids $Poids)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Poids);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listePoids');



    }
}