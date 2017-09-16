<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pidev\AllForDealBundle\Entity\Service;
use Pidev\AllForDealBundle\Entity\Reclamation;
use Pidev\AllForDealBundle\Entity\Membre;
use Symfony\Component\HttpFoundation\Request;

class adminController extends Controller {

public function membreAction() {
        
        return $this->render("PidevAllForDealBundle:Admin:membre.html.twig");
    }
 
    public function approuverAction($id){
        $em = $this->getDoctrine()->getManager();
         
      $query = $em
                ->createQuery("SELECT   m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where o.id=m.idProduit and o.etat='attente' GROUP BY m.idProduit ");
           
        $produits = $query->getResult();
        
         $Pro = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);
        $Pro->setEtat("approuver");
     
          $em->merge($Pro); 
    $em->flush();   
        return $this->render('PidevAllForDealBundle:Admin:produit.html.twig', array('produits' => $produits));
    }

    public function getMyProductAction() {
        $em = $this->getDoctrine()->getManager();
        
      
           
        $em = $this->getDoctrine()->getManager();
        
        
      $query = $em
                ->createQuery("SELECT   m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where o.id=m.idProduit and o.etat='attente' GROUP BY m.idProduit ");
           
        $produits = $query->getResult();
        
         
        
        return $this->render('PidevAllForDealBundle:Admin:produit.html.twig', array('produits' => $produits));
        
    }

      public function suppressionAction($id){
          
         $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
                            $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:EvaluationService d where d.idService=".$id)->getResult();
               
               $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:Reclamation d where d.idService=".$id)->getResult();
        
               $objet = $em->createQuery("delete FROM PidevAllForDealBundle:EvaluationProd d where d.idProduit=".$id)->getResult();

           
        $produit = $query->getResult();
         
        $lignes = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit"=> $id));
             $prod = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);
        foreach ($lignes as $ligne) {
    $em->remove($ligne);
        }
        $em->remove($prod);
$em->flush();

        return $this->redirect($this->generateUrl('produitA'));

    }
    
     public function detailAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
       
        $produit = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);
        
        $images = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit" => $id));
        
//        ----------------------------------
        
//        -----------------------------------

        return $this->render('PidevAllForDealBundle:Admin:detailAdmin.html.twig', array('produit' => $produit, 'images' => $images));
        
    }
    
    public function supplierServicesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        //Intersection entre deux table
        $serviceR = $em->createQuery("select s from PidevAllForDealBundle:Service s join PidevAllForDealBundle:Reclamation r where s.id = r.idService")->getResult();
//        $serviceN = $em->createQuery("select s from PidevAllForDealBundle:Service s where s not in '".$serviceR."'")->getResult();
//        $serviceN = $em->createQuery('SELECT s FROM PidevAllForDealBundle:Service s WHERE s.id NOT IN (SELECT r.idService FROM PidevAllForDealBundle:Reclamation r)')->getResult();    

        $serviceN = $em->createQuery("SELECT s FROM PidevAllForDealBundle:Service s WHERE s.id not in "
                        . "( SELECT IDENTITY(r.idService) FROM PidevAllForDealBundle:Reclamation r)")->getResult();

        $service = $em->getRepository('PidevAllForDealBundle:Service')->findAll();
        /*
          var_dump($serviceN);
          die();
         */
        $pagination = $this->get('knp_paginator')->paginate(
                $service, $request->query->get('page', 1), 5);

        return $this->render('PidevAllForDealBundle:Admin:service.html.twig', array('N' => $serviceN, 'R' => $serviceR, 'page' => $pagination));
    }
    
     public function viewAction($id) {

        $em = $this->getDoctrine()->getManager();
        $detail = $em->getRepository('PidevAllForDealBundle:Service')->findBy(array('id' => $id));
        $test = $em->getRepository('PidevAllForDealBundle:Service')->find($id);       
        $t = $test->getIdFournisseur()->getId();
      
        $S_R= $em->getRepository('PidevAllForDealBundle:Reclamation')
          ->find(array('idService'=> $id ,'idMembre'=>$t));
        
        if($S_R instanceof Reclamation)
        {
            $a= "Service réclamé" ;
        }
        else
        {
            $a ="Service Non réclamé";
        }
        
//        var_dump($a);
        
        $rec = $em->getRepository('PidevAllForDealBundle:Reclamation')->findBy(array('idService' => $id));
        return $this->render('PidevAllForDealBundle:Admin:view_service.html.twig', array('i' => $detail,'b' => $a, 'j' => $rec));
    }
        public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        
               $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:EvaluationService d where d.idService=".$id)->getResult();
               
               $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:Reclamation d where d.idService=".$id)->getResult();
        $objet = $em->getRepository('PidevAllForDealBundle:Service')->find($id);
       
        $em->remove($objet);
        $em->flush();
        return $this->redirectToRoute('serviceA');
    }
////////////////////////////////offfffre
    
    public function offreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('PidevAllForDealBundle:AppelOffre')->findAll();
        return $this->render('PidevAllForDealBundle:Admin:offre.html.twig',array(
                'modeles'=>$modeles
        ));
    }
   public function detail_offreAction($id) {
        $em = $this->getDoctrine()->getManager();

        $destinos = $em->getRepository('PidevAllForDealBundle:AppelOffre')->findBy(array('id'=>$id)); 
        return $this->render('PidevAllForDealBundle:Admin:detail_offre_admin.html.twig', array('i' => $destinos));
    }
    
     public function deleteadminAction($id)
    {
      $em = $this->getDoctrine()->getEntityManager();
     ;
      $Modele = $em->getRepository('PidevAllForDealBundle:AppelOffre')->find($id);
      
      $em->remove($Modele);
      $em->flush();
return $this->redirectToRoute('offreA');
    }
    
    
    
    public function produitAction() {
        return $this->render('PidevAllForDealBundle:Admin:produit.html.twig');
    }

    public function serviceAction() {
        return $this->render('PidevAllForDealBundle:Admin:service.html.twig');
    }

    public function reclamationAction() {
        return $this->render('PidevAllForDealBundle:Admin:reclamation.html.twig');
    }

    public function chartsAction() {
        return $this->render('PidevAllForDealBundle:Admin:charts.html.twig');
    }

   
}
