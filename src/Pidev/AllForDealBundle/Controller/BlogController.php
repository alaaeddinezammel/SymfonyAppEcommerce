<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller {

    public function AddAction() {
        $blog = new \Pidev\AllForDealBundle\Entity\Blog();

        $formb = new \Pidev\AllForDealBundle\Form\BlogType();
        $form = $this->createForm($formb, $blog);

 
  
            
        
        $req = $this->get('request');
        if ($form->handleRequest($req)->isValid()) {
         $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
        }

        return $this->render('PidevAllForDealBundle:Admin:add_blog.html.twig', array('f' => $form->createView()));
    }

    public function afficherAction() {
        $em = $this->getDoctrine()->getManager();
 $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $blog = $em->getRepository('PidevAllForDealBundle:Blog')->findAll();

        return $this->render('PidevAllForDealBundle:Default:blog.html.twig', array('i' => $blog,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function detailAction($id) {
        $em = $this->getDoctrine()->getManager();
$cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $blog = $em->getRepository('PidevAllForDealBundle:Blog')->findById($id);

        return $this->render('PidevAllForDealBundle:Default:post.html.twig', array('i' => $blog,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function afficherAAction() {
        $em = $this->getDoctrine()->getManager();
$cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $blog = $em->getRepository('PidevAllForDealBundle:Blog')->findAll();

        return $this->render('PidevAllForDealBundle:Admin:blog.html.twig', array('i' => $blog,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function DeleteAction($id) {

        $em = $this->getDoctrine()->getManager();

        $objet = $em->getRepository('PidevAllForDealBundle:Blog')->findOneById($id);

        $em->remove($objet);
        $em->flush();
        return $this->redirectToRoute('AfficherABlog');
    }

    public function modifierAction($id) {

        $em = $this->getDoctrine()->getManager();

        $objet = $em->getRepository('PidevAllForDealBundle:Blog')->findOneById($id);


        $formb = new \Pidev\AllForDealBundle\Form\BlogMType();
        $form = $this->createForm($formb, $objet);



        $req = $this->get('request');
        if ($form->handleRequest($req)->isValid()) {
            $em1 = $this->getDoctrine()->getManager();

            $em1->persist($objet);
            $em1->flush();
        }


        return $this->render('PidevAllForDealBundle:Admin:modifierBlog.html.twig', array('f' => $form->createView()));
    }

}
