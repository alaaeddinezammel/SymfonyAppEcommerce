<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReclamationController extends Controller {

    public function AddAction($id) {
        $reclamation = new \Pidev\AllForDealBundle\Entity\Reclamation();

        $formb = new \Pidev\AllForDealBundle\Form\ReclamationType();
        $form = $this->createForm($formb, $reclamation);

$em = $this->getDoctrine()->getManager();
            
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $req = $this->get('request');
        if ($form->handleRequest($req)->isValid()) {
            
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->findOneById($this->getUser()->getId());
            $reclamation->setIdMembre($user);
            $service = $em->getRepository('PidevAllForDealBundle:Service')->findOneById($id);
            $reclamation->setIdService($service);
            $a=new \Datetime();
            $b=$a->format('Y-m-d H:i:s');
            $reclamation->setDate($b);
            
            $em->persist($reclamation);
            $em->flush();
        }

        return $this->render('PidevAllForDealBundle:Reclamation:add_reclamation.html.twig', array('f' => $form->createView(),'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function AfficherAction() {
        $em = $this->getDoctrine()->getManager();
      
  
        $reclamation = $em->getRepository('PidevAllForDealBundle:Reclamation')->findAll();

        return $this->render('PidevAllForDealBundle:Admin:reclamation.html.twig', array('i' => $reclamation));
    }

    public function DeleteAction($idService, $idMembre) {

        $em = $this->getDoctrine()->getManager();
    
        /*  $idService=2;
          // $user= $em->getRepository('PidevAllForDealBundle:Membre')->findOneById($idMembre);
          // $service= $em->getRepository('PidevAllForDealBundle:Service')->findOneById($idService);
          $objet=$em->getRepository('PidevAllForDealBundle:Reclamation')
          ->find($idService);



         */
$objet = $em->createQuery("delete FROM PidevAllForDealBundle:Reclamation d where d.idMembre=" . $idMembre . " and d.idService=" . $idService)->getResult();
        
         // $em->remove($objet);
          //$em->flush();
          return $this->redirectToRoute('afficher_reclamation');    

    }
    public function DeleteAllAction( $idMembre) {

        $em = $this->getDoctrine()->getManager();
       
       
$objet = $em->createQuery("delete FROM PidevAllForDealBundle:Reclamation d where d.idMembre=" . $idMembre . " and d.reponse is not NULL")->getResult();
       
          return $this->redirectToRoute('afficher_reclamation');    

    }

    public function Detail_reclamationAction($idService, $idMembre) {
       
         $reclamation = new \Pidev\AllForDealBundle\Entity\Reclamation();

        $formb = new \Pidev\AllForDealBundle\Form\ReponseType();
        $form = $this->createForm($formb, $reclamation);

 $em = $this->getDoctrine()->getManager();
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $req = $this->get('request');
        if ($form->handleRequest($req)->isValid()) {
           

           
            $service = $em->getRepository('PidevAllForDealBundle:Service')->find($idService);
            
            $rec = $em->getRepository('PidevAllForDealBundle:Membre')->findOneById($idMembre);
            
               
        $update = $em->createQuery("Update PidevAllForDealBundle:Reclamation d set d.reponse='".$reclamation->getReponse()."' where d.idMembre=".$idMembre." and d.idService=".$idService)->getResult();
        $message= \Swift_Message::newInstance()
                ->setSubject('au sujet de votre reclamation pour: '.$service->getNom())
                ->setFrom('allfordeal1@gmail.com')
                ->setTo($rec->getEmail())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($reclamation->getReponse());
        
        $this->get('mailer')->send($message);
        return $this->redirect($this->generateUrl('afficher_reclamation'));
        }  
         $em1 = $this->getDoctrine()->getManager();
         $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $destinos = $em1->createQuery("SELECT d FROM PidevAllForDealBundle:Reclamation d where d.idMembre=". $idMembre . " and d.idService=" . $idService)->getResult();
        
        
      
        return $this->render('PidevAllForDealBundle:Reclamation:detail_reclamation.html.twig', array('i' => $destinos,'f' => $form->createView(),'cat1' => $cat1, 'sous1' => $sous1));
    }
   
        
   /* public function RepondreAction() {
   $reclamation = new \Pidev\AllForDealBundle\Entity\Reclamation();

        $formb = new \Pidev\AllForDealBundle\Form\ReponseType();
        $form = $this->createForm($formb, $reclamation);



        $req = $this->get('request');
        if ($form->handleRequest($req)->isValid()) {
            $em = $this->getDoctrine()->getManager();
           // $user = $em->getRepository('PidevAllForDealBundle:Membre')->findOneById($reclamation->getIdMembre());
           
            //$service = $em->getRepository('PidevAllForDealBundle:Service')->findOneById($reclamation->getIdService());
            
        $update = $em->createQuery("Update PidevAllForDealBundle:Reclamation  set reponse=".$reclamation->getReponse()." where idMembre=" . $idMembre . " and idService=" . $idService)->getResult();
        }
        return $this->render('PidevAllForDealBundle:Reclamation:detail_reclamation.html.twig', array('f' => $form->createView()));
    }*/

}
