<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class ClientController extends Controller

{
    /**
     * @Route("/addClient",name="addClient")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        
        $Client= new Client();

        $form = $this->createform(ClientType::class,$Client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Client');

            $ClientS= $repository->findAll();

            $bool=0;
            foreach ($ClientS as $type)
            {
                if(($type->getNom()==$Client->getNom()) && ($type->getPrenom()==$Client->getPrenom()) )
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();
            $Client->setNomPrenom($Client->getNom().' '.$Client->getPrenom() );
            $enregistrement->persist($Client);
            $enregistrement->flush();

            $this->addFlash('notice','Enregistrement reussi');

            return $this->redirectToRoute('listeClient');
            }else
            {
                $this->addFlash('notice', 'Client deja existante!!');

                return $this->redirectToRoute('listeClient');

            }

        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();


        return $this->render('ClientAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }


    /**
     * @Route("/listClient",name="listeClient")
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listClientAction(Request $request)
    {

        $Client= new Client();

        $form = $this->createform(ClientType::class,$Client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Client');

            $ClientS= $repository->findAll();

            $bool=0;
            foreach ($ClientS as $type)
            {
                if( ($type->getNom()==$Client->getNom()) && ($type->getPrenom()==$Client->getPrenom()) )
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

                $enregistrement = $this->getDoctrine()->getManager();
                $Client->setNomPrenom($Client->getNom().' '.$Client->getPrenom() );
                $enregistrement->persist($Client);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('listeClient');
            }else
            {
                $this->addFlash('notice', 'Client deja existant!!');

                return $this->redirectToRoute('listeClient');

            }

        }

        $formView= $form->createView();
        
        $repository= $this->getDoctrine()->getRepository('AppBundle:Client');

        $ClientS= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();


        return $this->render('ClientList.html.twig',['clients'=>$clients,'form'=>$formView,'ClientS'=>$ClientS]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/editClient/{id}",name="edit_Client")
     *
     *
     *
     */



    public function edit(Request $request, Client $Client)
    {
        
        $form = $this->createform(ClientType::class,$Client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Client');

            $ClientS= $repository->findAll();

            $bool=0;
            foreach ($ClientS as $type)
            {
                if( ($type->getNom()==$Client->getNom()) && ($type->getPrenom()==$Client->getPrenom())  && ($type->getId()!=$Client->getId()) )
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {

            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');

            $Client->setNomPrenom($Client->getNom().' '.$Client->getPrenom() );
            $enregistrement->flush();

            return $this->redirectToRoute('listeClient');
            }else
            {
                $this->addFlash('notice', 'Client deja existant!!');

                return $this->redirectToRoute('listeClient');

            }




        }

        $formView= $form->createView();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();


        return $this->render('ClientAdd.html.twig',['clients'=>$clients,'form'=>$formView]);
    }
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteClient/{id}",name="supprimer_Client")
     *
     *
     *
     */

    public function delete(Client $Client)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Client);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeClient');



    }
}