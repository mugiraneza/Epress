<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PaiementController extends Controller
{
    /**
     * @Route("/payer",name="payer")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listpaieAction()
    {
        $repository= $this->getDoctrine()->getRepository('AppBundle:Paiement');

        $Paiements= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        return $this->render('PaiementList.html.twig',['paiements'=>$Paiements,'clients'=>$clients]);
    }
}
