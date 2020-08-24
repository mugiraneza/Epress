<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TypeTissu;
use AppBundle\Form\TypeTissuType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class TypeTissuController extends Controller

{
    /**
     * @Route("/addTypeTissu",name="addTypeTissu")
     *
     *  
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        
        $TypeTissu= new TypeTissu();

        $form = $this->createform(TypeTissuType::class,$TypeTissu);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

            $TypeTissuS= $repository->findAll();

            $bool=0;
            foreach ($TypeTissuS as $type)
            {
                if($type->getLibelle()==$TypeTissu->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();

            $enregistrement->persist($TypeTissu);
            $enregistrement->flush();

            $this->addFlash('notice','Enregistrement reussi');

            return $this->redirectToRoute('listeTypeTissu');
            }else
            {
                $this->addFlash('notice', 'Type de tissu deja existant!!');

                return $this->redirectToRoute('listeTypeTissu');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('TypeTissuAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listTypeTissu",name="listeTypeTissu")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listTypeTissuAction(Request $request)
    {

        $TypeTissu= new TypeTissu();

        $form = $this->createform(TypeTissuType::class,$TypeTissu);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

            $TypeTissuS= $repository->findAll();

            $bool=0;
            foreach ($TypeTissuS as $type)
            {
                if($type->getLibelle()==$TypeTissu->getLibelle())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($TypeTissu);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listeTypeTissu');
            }else
            {
                $this->addFlash('notice', 'Type de Tissu deja existant!!');

                return $this->redirectToRoute('listeTypeTissu');

            }

        }

        $formView= $form->createView();
        
        $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

        $TypeTissuS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('TypeTissuList.html.twig',['clients'=>$clients,'form'=>$formView,'TypeTissuS'=>$TypeTissuS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editTypeTissu/{id}",name="edit_TypeTissu")
     *
     *
     *
     */



    public function edit(Request $request, TypeTissu $TypeTissu)
    {
        
        $form = $this->createform(TypeTissuType::class,$TypeTissu);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

            $TypeTissuS= $repository->findAll();

            $bool=0;
            foreach ($TypeTissuS as $type)
            {
                if($type->getLibelle()==$TypeTissu->getLibelle() && $type->getId()!=$TypeTissu->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('listeTypeTissu');
            }else
            {
                $this->addFlash('notice', 'Type de tissu deja existant!!');

                return $this->redirectToRoute('listeTypeTissu');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('TypeTissuAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteTypeTissu/{id}",name="supprimer_TypeTissu")
     *
     *
     *
     */

    public function delete(TypeTissu $TypeTissu)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($TypeTissu);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeTypeTissu');



    }
}