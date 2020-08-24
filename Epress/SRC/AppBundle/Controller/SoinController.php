<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Soin;
use AppBundle\Form\SoinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class SoinController extends Controller

{
    /**
     * @Route("/addSoin",name="addSoin")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {

        $Soin= new Soin();

        $form = $this->createform(SoinType::class,$Soin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Soin');

            $S= $repository->findAll();

            $bool=0;
            foreach ($S as $type)
            {
                if($type->getnom() == $Soin->getnom() )
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

                return $this->redirectToRoute('listeSoin');
            }else
            {
                $this->addFlash('notice', 'Soin deja existant!!');

                return $this->redirectToRoute('listeSoin');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('SoinAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listSoin",name="listeSoin")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listSoinAction(Request $request)
    {

        $Soin= new Soin();

        $form = $this->createform(SoinType::class,$Soin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Soin');

            $S= $repository->findAll();

            $bool=0;
            foreach ($S as $type)
            {
                if($type->getNom() == $Soin->getNom())
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

                return $this->redirectToRoute('listeSoin');
            }else
            {
                $this->addFlash('notice', 'Soin deja existant!!');

                return $this->redirectToRoute('listeSoin');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Soin');

        $Soin= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('SoinList.html.twig',['clients'=>$clients,'form'=>$formView,'Soin'=>$Soin]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editSoin/{id}",name="edit_Soin")
     *
     *
     *
     */



    public function edit(Request $request, Soin $Soin)
    {

        $form = $this->createform(SoinType::class,$Soin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Soin');

            $S= $repository->findAll();

            $bool=0;
            foreach ($S as $type)
            {
                if( $type->getnom() == $Soin->getnom() && $type->getId()!=$Soin->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $this->addFlash('notice','Edition reussie');


                $enregistrement->flush();

                return $this->redirectToRoute('listeSoin');
            }else
            {
                $this->addFlash('notice', 'Soin deja existant!!');

                return $this->redirectToRoute('listeSoin');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('SoinAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     * @Route("/deleteSoin/{id}",name="supprimer_Soin")
     *
     */

    public function delete(Soin $Soin)
    {


        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Soin);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeSoin');



    }
}