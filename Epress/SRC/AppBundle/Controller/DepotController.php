<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Couleur;
use AppBundle\Entity\Depot;
use AppBundle\Entity\Linge;
use AppBundle\Entity\Paiement;
use AppBundle\Entity\Statistique;
use AppBundle\Entity\TypeTissu;
use AppBundle\Form\ClientType;
use AppBundle\Form\CouleurType;
use AppBundle\Form\DepotType;
use AppBundle\Form\LingeType;
use AppBundle\Form\PaiementType;
use AppBundle\Form\TypeTissuType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;

class DepotController extends Controller
{
    /**
     * @Route("/add/{id}",name="addDepot")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * 
     */
    public function addAction(request $request,Client $c)
    {
        $Depot= new Depot();



        $form = $this->createform(DepotType::class,$Depot);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

            $Depots= $repository->findAll();



            foreach ($Depots as $depot)
            {
                    if( $depot->getStatut()=='En traitement' and $depot->getClient()==$c and ( $depot->getLinge()==$Depot->getLinge()  and  $depot->getTissu()==$Depot->getTissu()  and  $depot->getCouleur()==$Depot->getCouleur() ) )
                    {
                        $enregistrement = $this->getDoctrine()->getManager();
                        $qte=$depot->getQuantite();
                        $pri=(int) $depot->getPrix();
                        $depot->setQuantite($qte+$Depot->getQuantite());
                        $depot->setPrix($pri+ (int) $Depot->getPrix());

                        $enregistrement->flush();

                        $this->addFlash('notice','Enregistrement reussi');
                        return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);

                    }
            }

                $enregistrement = $this->getDoctrine()->getManager();
                $Depot->setClient($c);
                $Depot->setDateDepot(new \DateTime('now'));
                $Depot->setStatut('En traitement');
                $Depot->setAvance('0');
                $Depot->setRemise('0');
                $enregistrement->persist($Depot);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');
                return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);

        }



        $formView= $form->createView();


        $Client= new Client();

        $form3 = $this->createform(ClientType::class,$Client);

        $form3->handleRequest($request);

        if($form3->isSubmitted() && $form3->isValid() ){

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

                return $this->redirectToRoute('addDepot',['id'=>$Client->getId()]);
            }else
            {
                $this->addFlash('notice', 'Client deja existant!!');

                return $this->redirectToRoute('listeClient');

            }

        }

        $formView3= $form3->createView();

        $Linge= new Linge();

        $form2 = $this->createform(LingeType::class,$Linge);

        $form2->handleRequest($request);

        if($form2->isSubmitted() && $form2->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

            $Linges= $repository->findAll();
            $bool=0;
            foreach ($Linges as $c)
            {
                if($c->getLibelle()==$Linge->getLibelle())
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

                return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);

            }else
            {
                $this->addFlash('notice', 'Linge deja existant!!');

                return $this->redirectToRoute('listeLinge');

            }

        }

        $formView2= $form2->createView();

        $Couleur= new Couleur();

        $form4 = $this->createform(CouleurType::class,$Couleur);

        $form4->handleRequest($request);

        if($form4->isSubmitted() && $form4->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

            $Couleurs= $repository->findAll();
            $bool=0;
            foreach ($Couleurs as $c)
            {
                if($c->getLibelle()==$Couleur->getLibelle())
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

                return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);

            }else
            {
                $this->addFlash('notice', 'Couleur deja existante!!');

                return $this->redirectToRoute('listeCouleur');

            }

        }

        $formView4= $form4->createView();



        $TypeTissu= new TypeTissu();

        $form5 = $this->createform(TypeTissuType::class,$TypeTissu);

        $form5->handleRequest($request);

        if($form5->isSubmitted() && $form5->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

            $TypeTissus= $repository->findAll();
            $bool=0;
            foreach ($TypeTissus as $c)
            {
                if($c->getLibelle()==$TypeTissu->getLibelle())
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

                return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);

            }else
            {
                $this->addFlash('notice', 'Tissu deja existante!!');

                return $this->redirectToRoute('listeTypeTissu');

            }

        }

        $formView5= $form5->createView();




        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $Depots= $repository->findAll();

        $Paiement= new Paiement();

        $formulaire = $this->createform(PaiementType::class,$Paiement);

        $formulaire->handleRequest($request);

        $formulaireView= $formulaire->createView();

        if($formulaire->isSubmitted() && $formulaire->isValid() )
        {
            $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

            $Depots= $repository->findAll();

            $argent=((int) $Paiement->getMontant());

            foreach ($Depots as $depot)
            {
                $money=( (int) $depot->getPrix()- (int) $depot->getAvance());
               if( $argent >0){
                if(($depot->getStatut()=='En traitement' || $depot->getStatut()=='Partiellement solde') && $depot->getClient()==$c )
                {
                    if($argent >= $money )
                    {

                        $argent= $argent - $money;

                        $enregistrement = $this->getDoctrine()->getManager();
                        $Paiement->setDate(new \DateTime('now'));
                        $Paiement->setClient($c);
                        $Paiement->setDepot($depot);
                        $Paiement->setMontant($money);
                        $paie= new Paiement();
                        $paie->setDate($Paiement->getDate());
                        $paie->setClient($Paiement->getClient());
                        $paie->setDepot($Paiement->getDepot());
                        $paie->setMontant($Paiement->getMontant());
                        $depot->setAvance( $depot->getPrix() );
                        $depot->setStatut('Solde');
                        $enregistrement->persist($paie);
                        $enregistrement->flush();

                        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

                        $Statistiques= $repository->findAll();
                        $b=0;
                        foreach($Statistiques as $statis)
                        {
                            $aujour=(new \DateTime('now'))->format('d-m-Y');

                            if($statis->getDate()->format('d-m-Y')== $aujour)
                            {
                                $b=1;
                            }
                            else
                            {
                                $b=0;
                            }
                        }

                        if($b==1)
                        {
                            $e= $this->getDoctrine()->getManager();
                            $tota=((int) $statis->getMontant());
                            $statis->setMontant( ( (int) $Paiement->getMontant() )+ $tota );
                            $e->flush();

                        }

                        if($b==0)
                        {
                            $e= $this->getDoctrine()->getManager();
                            $stat = new Statistique();
                            $stat->setDate(new \DateTime('now'));
                            $stat->setMontant(( (int) $Paiement->getMontant() ));
                            $e->persist($stat);
                            $e->flush();
                        }
                        $reste=$argent;
                    }else
                    {
                        $enregistrement = $this->getDoctrine()->getManager();
                        $Paiement->setDate(new \DateTime('now'));
                        $Paiement->setClient($c);
                        $Paiement->setDepot($depot);
                        $Paiement->setMontant($argent);
                        $depot->setStatut('Partiellement solde');
                        $depot->setavance($argent+ (int) $depot->getAvance());
                        $paie= new Paiement();
                        $paie->setDate($Paiement->getDate());
                        $paie->setClient($Paiement->getClient());
                        $paie->setDepot($Paiement->getDepot());
                        $paie->setMontant($Paiement->getMontant());
                        $enregistrement->persist($paie);
                        $enregistrement->flush();

                        $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

                        $Statistiques= $repository->findAll();
                        $b=0;
                        foreach($Statistiques as $statis)
                        {
                            $aujour=(new \DateTime('now'))->format('d-m-Y');

                            if($statis->getDate()->format('d-m-Y')== $aujour)
                            {
                                $b=1;
                            }
                            else
                            {
                                $b=0;
                            }
                        }

                        if($b==1)
                        {
                            $e= $this->getDoctrine()->getManager();
                            $tota=((int) $statis->getMontant());
                            $statis->setMontant( ( (int) $Paiement->getMontant() )+ $tota );
                            $e->flush();

                        }

                        if($b==0)
                        {
                            $e= $this->getDoctrine()->getManager();
                            $stat = new Statistique();
                            $stat->setDate(new \DateTime('now'));
                            $stat->setMontant(( (int) $Paiement->getMontant() ));
                            $e->persist($stat);
                            $e->flush();
                        }
                        $reste=0;
                        $argent=0;
                    }

                }

               }

            }
            $this->addFlash('notice','Reglement effectue avec succes');
            return $this->render('DepotA.html.twig',['reste'=>$reste,'formulaire'=>$formulaireView,'id'=>$c->getId(),'Depots'=>$Depots,'clients'=>$clients,'form'=>$formView,'clientform'=>$formView3,'couleurform'=>$formView4,'tissuform'=>$formView5,'lingeform'=>$formView2]);


        }





        return $this->render('DepotAdd.html.twig',['formulaire'=>$formulaireView,'id'=>$c->getId(),'Depots'=>$Depots,'clients'=>$clients,'form'=>$formView,'clientform'=>$formView3,'couleurform'=>$formView4,'tissuform'=>$formView5,'lingeform'=>$formView2]);
    }


    /**
     * @Route("/listDepot",name="listeDepot")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function listDepotAction()
    {
        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $Depots= $repository->findAll();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();




        return $this->render('DepotList.html.twig',['Depots'=>$Depots,'clients'=>$clients]);
    }


    /**
     * @Route("/ed/{depot}/{id}",name="edDepot")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function EdAction(request $request,Depot $depot,Client $c)
    {

        $form = $this->createform(DepotType::class,$depot);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $enregistrement = $this->getDoctrine()->getManager();

            $enregistrement->flush();



            $this->addFlash('notice','Edition reussi');

            return $this->redirectToRoute('addDepot',['id'=>$c->getId()]);



        }



        $formView= $form->createView();


        $Client= new Client();

        $form3 = $this->createform(ClientType::class,$Client);

        $form3->handleRequest($request);

        if($form3->isSubmitted() && $form3->isValid() ){

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

                $enregistrement->persist($Client);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('addDepot');
            }else
            {
                $this->addFlash('notice', 'Client deja existant!!');

                return $this->redirectToRoute('listeClient');

            }

        }

        $formView3= $form3->createView();

        $Linge= new Linge();

        $form2 = $this->createform(LingeType::class,$Linge);

        $form2->handleRequest($request);

        if($form2->isSubmitted() && $form2->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Linge');

            $Linges= $repository->findAll();
            $bool=0;
            foreach ($Linges as $c)
            {
                if($c->getLibelle()==$Linge->getLibelle())
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

                return $this->redirectToRoute('addDepot');

            }else
            {
                $this->addFlash('notice', 'Linge deja existant!!');

                return $this->redirectToRoute('listeLinge');

            }

        }

        $formView2= $form2->createView();

        $Couleur= new Couleur();

        $form4 = $this->createform(CouleurType::class,$Couleur);

        $form4->handleRequest($request);

        if($form4->isSubmitted() && $form4->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Couleur');

            $Couleurs= $repository->findAll();
            $bool=0;
            foreach ($Couleurs as $c)
            {
                if($c->getLibelle()==$Couleur->getLibelle())
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

                return $this->redirectToRoute('addDepot');

            }else
            {
                $this->addFlash('notice', 'Couleur deja existante!!');

                return $this->redirectToRoute('listeCouleur');

            }

        }

        $formView4= $form4->createView();



        $TypeTissu= new TypeTissu();

        $form5 = $this->createform(TypeTissuType::class,$TypeTissu);

        $form5->handleRequest($request);

        if($form5->isSubmitted() && $form5->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeTissu');

            $TypeTissus= $repository->findAll();
            $bool=0;
            foreach ($TypeTissus as $c)
            {
                if($c->getLibelle()==$TypeTissu->getLibelle())
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

                return $this->redirectToRoute('addDepot');

            }else
            {
                $this->addFlash('notice', 'Tissu deja existante!!');

                return $this->redirectToRoute('listeTypeTissu');

            }

        }

        $formView5= $form5->createView();

        $Paiement= new Paiement();

        $formulaire = $this->createform(PaiementType::class,$Paiement);

        $formulaire->handleRequest($request);

        $formulaireView= $formulaire->createView();

        if($formulaire->isSubmitted() && $formulaire->isValid() )
        {
            $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

            $Depots= $repository->findAll();

            $argent=((int) $Paiement->getMontant());

            foreach ($Depots as $depot)
            {
                $money=( (int) $depot->getPrix()- (int) $depot->getAvance());
                if( $argent >0){
                    if(($depot->getStatut()=='En traitement' || $depot->getStatut()=='Partiellement solde') && $depot->getClient()==$c )
                    {
                        if($argent >= $money )
                        {

                            $argent= $argent - $money;

                            $enregistrement = $this->getDoctrine()->getManager();
                            $Paiement->setDate(new \DateTime('now'));
                            $Paiement->setClient($c);
                            $Paiement->setDepot($depot);
                            $Paiement->setMontant($money);
                            $paie= new Paiement();
                            $paie->setDate($Paiement->getDate());
                            $paie->setClient($Paiement->getClient());
                            $paie->setDepot($Paiement->getDepot());
                            $paie->setMontant($Paiement->getMontant());
                            $depot->setAvance( $depot->getPrix() );
                            $depot->setStatut('Solde');
                            $enregistrement->persist($paie);
                            $enregistrement->flush();

                            $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

                            $Statistiques= $repository->findAll();
                            $b=0;
                            foreach($Statistiques as $statis)
                            {
                                $aujour=(new \DateTime('now'))->format('d-m-Y');

                                if($statis->getDate()->format('d-m-Y')== $aujour)
                                {
                                    $b=1;
                                }
                                else
                                {
                                    $b=0;
                                }
                            }

                            if($b==1)
                            {
                                $e= $this->getDoctrine()->getManager();
                                $tota=((int) $statis->getMontant());
                                $statis->setMontant( ( (int) $Paiement->getMontant() )+ $tota );
                                $e->flush();

                            }

                            if($b==0)
                            {
                                $e= $this->getDoctrine()->getManager();
                                $stat = new Statistique();
                                $stat->setDate(new \DateTime('now'));
                                $stat->setMontant(( (int) $Paiement->getMontant() ));
                                $e->persist($stat);
                                $e->flush();
                            }
                            $reste=$argent;
                        }else
                        {
                            $enregistrement = $this->getDoctrine()->getManager();
                            $Paiement->setDate(new \DateTime('now'));
                            $Paiement->setClient($c);
                            $Paiement->setDepot($depot);
                            $Paiement->setMontant($argent);
                            $depot->setStatut('Partiellement solde');
                            $depot->setavance($argent+ (int) $depot->getAvance());
                            $paie= new Paiement();
                            $paie->setDate($Paiement->getDate());
                            $paie->setClient($Paiement->getClient());
                            $paie->setDepot($Paiement->getDepot());
                            $paie->setMontant($Paiement->getMontant());
                            $enregistrement->persist($paie);
                            $enregistrement->flush();

                            $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

                            $Statistiques= $repository->findAll();
                            $b=0;
                            foreach($Statistiques as $statis)
                            {
                                $aujour=(new \DateTime('now'))->format('d-m-Y');

                                if($statis->getDate()->format('d-m-Y')== $aujour)
                                {
                                    $b=1;
                                }
                                else
                                {
                                    $b=0;
                                }
                            }

                            if($b==1)
                            {
                                $e= $this->getDoctrine()->getManager();
                                $tota=((int) $statis->getMontant());
                                $statis->setMontant( ( (int) $Paiement->getMontant() )+ $tota );
                                $e->flush();

                            }

                            if($b==0)
                            {
                                $e= $this->getDoctrine()->getManager();
                                $stat = new Statistique();
                                $stat->setDate(new \DateTime('now'));
                                $stat->setMontant(( (int) $Paiement->getMontant() ));
                                $e->persist($stat);
                                $e->flush();
                            }
                            $reste=0;
                            $argent=0;
                        }

                    }

                }

            }
            $this->addFlash('notice','Reglement effectue avec succes');
            return $this->render('DepotA.html.twig',['reste'=>$reste,'formulaire'=>$formulaireView,'id'=>$c->getId(),'Depots'=>$Depots,'clients'=>$clients,'form'=>$formView,'clientform'=>$formView3,'couleurform'=>$formView4,'tissuform'=>$formView5,'lingeform'=>$formView2]);


        }


        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $Depots= $repository->findAll();



        return $this->render('DepotAdd.html.twig',['id'=>$c->getId(),'formulaire'=>$formulaireView,'Depots'=>$Depots,'clients'=>$clients,'form'=>$formView,'clientform'=>$formView3,'couleurform'=>$formView4,'tissuform'=>$formView5,'lingeform'=>$formView2]);
    }


    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteDe/{id}",name="supde")
     *
     *
     *
     */

    public function delete(Depot $depot)
    {

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($depot);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('listeDepot');

    }

    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/deleteDe2/{id}",name="supde2")
     *
     *
     */

    public function delete2(Depot $depot)
    {

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($depot);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('addDepot',['id'=>$depot->getClient()->getId()]);

    }

    /**
     *
     * @Route("/imp/{id}",name="Imp")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */



    public function ImpAction(Client $client)

    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $depots= $repository->findAll();


        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $date=new \DateTime('now');

        return $this->render('Impression.html.twig',['depots'=>$depots,'clients'=>$clients,'c'=>$client,'date'=>$date ]);

    }

    /**
     *
     * @Route("/Rappel",name="rappel")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */



    public function RappelAction()

    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $depots= $repository->getRappel();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $date=new \DateTime('now');

        return $this->render('Rappel.html.twig',['depots'=>$depots,'clients'=>$clients,'date'=>$date ]);

    }


    /**
     *@Route("/envoyer/{id}",name="envoyer")
     *
     *@return \Symfony\Component\HttpFoundation\Response
     */

    public function envoyer(Client $cli)
    {

        require_once "Moozisms.php";



        $to="228".$cli->getTelephone();
        //$from="CMS SAINT DANIEL";
        $message="Bonjour Mme/Mr ".$cli->getNomPrenom()."Le Pressing KPELLY CENTER vous invite a passer retirer vos habits.Veuillez vous presenter.Merci";
        //$headers="From:$from\n ";
       

            try {
            $serverUrl = "http://aspsmsapi.com/http/sendsms.aspx?"; // URL de base
            $dest = $to; // Numéro du destinataire au foramt international
            $username = "22892700310"; // Votre nom d'utilisateur
            $apikey = "NJGP5VHIHE"; // Votre clé API
            $msg ="Bonjour Mme/Mr ".$cli->getNomPrenom().".Le Pressing KPELLY CENTER vous invite a passer retirer vos habits.Veuillez vous presenter.Merci"; // Contenu du message
            $senderid = "Epress"; // Identifiant d'envoi
            $authmode = "http"; // Obligatoire. Ne pas modifier
            // CURL_INIT
            $ch = curl_init($serverUrl);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,"dest=$dest&username=$username&apikey=$apikey&senderid=$senderid&msg=$msg&authmode=$authmode");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $output = curl_exec($ch); // Afficher le résultat du serveur
            //$me=$output;

                $me=explode('|',$output);
                //var_dump(explode('|',$output));
               // $this->addFlash('notice',$me[1]);
                if($me[0]=='')
                {
                    $m=  'Echec d\'envoie...Veuillez verifier votre connexion internet';
                    $this->addFlash('notice',$m);
                }else
                if($me[1]=="LOW_BALANCE"."</li>")
                {
                    $m=  'Message inssufisent....Veuillez recharger votre compte';
                    $this->addFlash('notice',$m);
                }
                else
                    if($me[0]==""."<li>"."OK"  )
                    {
                        $m=  'Message Envoye Avec success';
                        $this->addFlash('notice',$m);
                    }

            //curl_close($ch);
            }catch(Exception $ex) {
            echo $ex;
            }



        $repository= $this->getDoctrine()->getRepository('AppBundle:Depot');

        $depots= $repository->getRappel();

        $cli= $this->getDoctrine()->getRepository('AppBundle:Client');

        $clients= $cli->findAll();

        $date=new \DateTime('now');



        return $this->render('Rappel.html.twig',['depots'=>$depots,'clients'=>$clients,'date'=>$date ]);

    }



}
