<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $query = $em
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id GROUP BY m.idProduit order by m.updatedAt ")
                ->setMaxResults(10);

        $images = $query->getResult();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();



        $stmt = $em->getConnection()->prepare("SELECT * FROM appel_offre_membre INNER JOIN appel_offre ON appel_offre_membre.id_appel_offre=appel_offre.id inner join membre on membre.id = appel_offre_membre.id_fournisseur where appel_offre.id_consommateur= :id");

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $id = $this->getUser()->getId();
        }

        

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->render("PidevAllForDealBundle:Default:index.html.twig", array('i' => $stmt->fetchAll(), 'images' => $images, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function detailAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:detail.html.twig');
    }

    public function notFoundAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:not_found.html.twig');
    }

    public function blogAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:blog.html.twig');
    }

    public function categoryAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:category.html.twig');
    }

    public function categoryFullAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:category_full.html.twig');
    }

    public function categoryRightAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:category_right.html.twig');
    }

    public function contactAction() {
        
         $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:contact.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function customerAccountAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:customer_account.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function customerWishlistAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:customer_wishlist.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function faqAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:faq.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function postAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:post.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function registerAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:register.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function textAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:text.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function textRightAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:text_right.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function addProductAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:add_product.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function supplierProductsAction() {
        $em = $this->getDoctrine()->getManager();
        
          $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        return $this->render('PidevAllForDealBundle:Default:supplier_products.html.twig',array( 'cat1' => $cat1, 'sous1' => $sous1));
    }

}
