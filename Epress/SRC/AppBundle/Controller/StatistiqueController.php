<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class StatistiqueController extends Controller
{

    /**
     * @Route("/Statistique",name="Statistique")
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listStatistiquesAction()
    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique2');

        $Statistiques2= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique3');

        $Statistiques3= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique4');

        $Statistiques4= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $today=new \DateTime('now');
        $d=new \DateTime('now');
        $precedent=$d->modify('-7 day');



        return $this->render('Statistiques.html.twig',[
            'Statistiques'=>$Statistiques,
            'Statistiques2'=>$Statistiques2,
            'Statistiques3'=>$Statistiques3,
            'Statistiques4'=>$Statistiques4,
            'today'=>$today,'prec'=>$precedent,
            'clients'=>$clients
        ]);
    }


    /**
     * @Route("/Stat/{debut}/{fin}",name="Stat")
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listStatAction(\DateTime $debut,\DateTime $fin)
    {
        $repository=$this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques=$repository->getStat($debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $repository=$this->getDoctrine()->getRepository('AppBundle:Statistique2');

        $Statistiques2=$repository->getStatique($debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $repository=$this->getDoctrine()->getRepository('AppBundle:Statistique3');

        $Statistiques3=$repository->getS($debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $repository=$this->getDoctrine()->getRepository('AppBundle:Statistique4');

        $Statistiques4=$repository->getSituation($debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $today=new \DateTime('now');




        return $this->render('Stat.html.twig',[
            'Statistiques'=>$Statistiques,
            'Statistiques2'=>$Statistiques2,
            'Statistiques3'=>$Statistiques3,
            'Statistiques4'=>$Statistiques4,
            'today'=>$today,'prec'=>$debut,
            'fin'=>$fin,
            'clients'=>$clients
        ]);
    }
}
