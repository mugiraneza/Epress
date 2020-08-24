<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;


use AppBundle\Entity\User;

class UserController extends Controller{

    /**
     * @Route("/users",name="users")
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(){

        $userManager=$this->get('fos_user.user_manager');
        $users=$userManager->findUsers();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();
        return $this->render('utilisateursList.html.twig',array('users'=>$users,'clients'=>$clients));
    }

    /**
     * @Route("/mod/{id}",name="mod")
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function editAction (Request $request, User $id)
    {
        $editForm = $this ->createForm( 'AppBundle\Form\UserType' , $id);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this ->getDoctrine()->getManager();
            $em->persist($id); $em->flush();
            return $this ->redirectToRoute( 'users' );
        }
        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();
        return $this->render( 'edit.html.twig' , array(
            'article' => $id,
            'edit_form' => $editForm->createView(),'clients'=>$clients));
    }

    /**
     * @Route("/effacer/{id}",name="effacer")
     *  @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function sAction ( User $id)
    {
        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($id);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('users');
    }



    /**
     * @Route("/essaie",name="essaie")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function EssaieAction(){

        return $this->render('essaie.html.twig');
    }

}