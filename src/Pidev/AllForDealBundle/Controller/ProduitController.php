<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pidev\AllForDealBundle\Entity\Image;
use Pidev\AllForDealBundle\Form\ImageType;
use Pidev\AllForDealBundle\Repository\ProduitRepository;
use Pidev\AllForDealBundle\Entity\Produit;
use Pidev\AllForDealBundle\Entity\Categorie;
use Pidev\AllForDealBundle\Entity\SousCategorie;
use Pidev\AllForDealBundle\Entity\EvaluationProd;
use Pidev\AllForDealBundle\Entity\Membre;
use blackknight467\StarRatingBundle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pidev\AllForDealBundle\Entity\EvaluationProd;
use Pidev\AllForDealBundle\Entity\LigneCmd;
use Pidev\AllForDealBundle\Entity\CommentaireProd;




class ProduitController extends Controller {

    public function detailAction($id, $categID) {

        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $produit = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);

        $images = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit" => $id));
        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ  and o.etat='approuver' GROUP BY m.idProduit order by m.updatedAt ")
                ->setParameter('categ', $categID)
                ->setMaxResults(3);

        $imageslike = $query->getResult();
//        ----------------------------------

        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ  and o.reduction>2 and o.etat='approuver'  GROUP BY m.idProduit order by m.updatedAt ")
                ->setParameter('categ', $categID)
                ->setMaxResults(3);

        $imagesred = $query->getResult();

//        -----------------------------------
        $moyenne = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->moyenne($produit);
        $moyenne = ceil($moyenne);
        dump($moyenne);
           $id1 = $this->getUser()->getId();
        $cE = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->countProduitEv($id1,$id);
       if (empty($cE))
        { $empty=true;}
        else {$empty=false;}
        
//         var_dump($empty);
//        die();
        $Request = $this->getRequest();
        if ($Request->getMethod() == 'POST') {
            die('hereaaaaaaaaaaaaaaaaaaaaaa');
            $em = $this->getDoctrine()->getManager();
            $prod = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);


            $noteDonne = $Request->get("note");
            var_dump($noteDonne);
//        $compte = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->find($id);
            $note = new EvaluationProd();
            $note->setRating($noteDonne);
//        $agent = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->find($offre->getIdAgent());
//        $note->setIdAgent($agent);
            $note->setIdProduit($prod);
            $a = $this->getUser()->getId();
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->find($a);
            
            $note->setIdMembre($user);
            $em->persist($note);
            $em->flush();

            $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->moyenne($prod);
            $moyenne = ceil($moyen);
            
         
        }
        return $this->render('PidevAllForDealBundle:Default:detail.html.twig', array('produit' => $produit, 'images' => $images, 'cat1' => $cat1, 'sous1' => $sous1, 'imageslike' => $imageslike, 'moyenne' => $moyenne, 'imagesred' => $imagesred, 'e'=>$empty ));
    }

    public function getMyProductAction() {


        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();


        $em = $this->getDoctrine()->getManager();
$a = $this->getUser()->getId();
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->find($a);

        $query = $em
                ->createQuery("SELECT   m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where o.id=m.idProduit and  o.idFournisseur=:a GROUP BY m.idProduit ")
                ->setParameter('a', $a);

        $produit = $query->getResult();

        $produits = $this->get('knp_paginator')->paginate($produit, $this->get('request')->query->get('page', 1), 4);




        return $this->render('PidevAllForDealBundle:Default:supplier_products.html.twig', array('produits' => $produits, 'cat1' => $cat1, 'sous1' => $sous1));
    }

//    public function uploadAction(Request $request) {
//        $image = new Image();
//        $type = new ImageType();
//        $form = $this->createForm($type, $image);
//        
//        
//        if ($form->handleRequest($request)->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($image);
//            $em->flush();
//            var_dump($request->get('imageFile'));
//        }
//
//        return $this->render("PidevAllForDealBundle:Default:add.html.twig", array("form" => $form->createView()));
//    }




    public function accueilreqAction() {

        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $query = $em
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.etat='approuver' GROUP BY m.idProduit order by m.updatedAt ")
                ->setMaxResults(10);

        $images = $query->getResult();

        return $this->render("PidevAllForDealBundle:Default:index.html.twig", array("images" => $images, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function detailDIndexAction($id) {



        $em = $this->getDoctrine()->getManager();
        $moyenne = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->moyenne($produit);
        $moyenne = ceil($moyenne);
        dump($moyenne);
        $produit = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);

        $images = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit" => $id));
        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ and o.etat='approuver'  GROUP BY m.idProduit order by m.updatedAt ")
                ->setParameter('categ', $idSousCategorie)
                ->setMaxResults(3);

        $imageslike = $query->getResult();
           $id1 = $this->getUser()->getId();
        $cE = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->countProduitEv($id1,$id);
       if (empty($cE))
        { $empty=true;}
        else {$empty=false;}


        return $this->render('PidevAllForDealBundle:Default:detail.html.twig', array('produit' => $produit, 'images' => $images, 'imageslike' => $imageslike, '$moyenne' => $moyenne,'e'=>$empty));
    }

    public function suppressionAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $query = $em
                ->createQuery("SELECT   m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where o.id=m.idProduit GROUP BY m.idProduit ");

        $produit = $query->getResult();

        $lignes = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit" => $id));
        $prod = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);
        
        
               $objet = $em->createQuery("delete FROM PidevAllForDealBundle:EvaluationProd d where d.idProduit=".$id)->getResult();
$objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:CommentaireProd d where d.idProduit=".$id)->getResult();
 $objet12 = $em->createQuery("delete FROM PidevAllForDealBundle:LigneCmd d where d.idProduit=".$id)->getResult();

        foreach ($lignes as $ligne) {
            $em->remove($ligne);
        }
        
        
        
        $em->remove($prod);
        $em->flush();





        return $this->redirect($this->generateUrl('supplier_products'));
    }

    public function newAction() {
        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $em = $this->getDoctrine()->getManager();
$a = $this->getUser()->getId();
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->find($a);
            
        $produit = new Produit();
        $Request = $this->getRequest();

        if ($Request->getMethod() == 'POST') {
            $produit = new Produit();


            $produit->setNom($Request->get('nom'));


            $produit->setPrix($Request->get('prix'));


            $search = $Request->get('region_input');


            $Scateg1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->find($search);

            $produit->setIdSousCategorie($Scateg1);
        $produit->setIdFournisseur($user);



            $produit->setReduction($Request->get('reduction'));
            $produit->setPoints($Request->get('points'));


            $produit->setEtat("attente");
            $t = $this->updated = new \DateTime("now");
            /* @var $format type */
            $produit->setDateLancement($t->format('Y-m-d H:i:s'));



            $produit->setCouleur($Request->get('colors'));

            $em->persist($produit);
            $em->flush();

            $photos = $Request->get('image');
            $j = 0;
            foreach ($photos as $photo) {
                if ($j < 3) {
                    $media = new Image();
                    $media->setIdProduit($produit);
                    $media->setImageName($photo);
                    $media->setUpdatedAt($this->updated = new \DateTime("now"));

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($media);
                    $em->flush();
                }
                $j++;
            }
            return $this->redirectToRoute('supplier_products');
        }
        return $this->render('PidevAllForDealBundle:Default:add_product.html.twig', array('cat1' => $cat1, 'sous1' => $sous1));
    }

    public function ratingAAction($id, $categID) {

        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();


        $prod = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);
        $images = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array("idProduit" => $id));
        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ and o.etat='approuver' GROUP BY m.idProduit order by m.updatedAt ")
                ->setParameter('categ', $categID)
                ->setMaxResults(3);

        $imageslike = $query->getResult();
        //        ----------------------------------

        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ  and o.reduction>2 and o.etat='approuver'  GROUP BY m.idProduit order by m.updatedAt ")
                ->setParameter('categ', $categID)
                ->setMaxResults(3);

        $imagesred = $query->getResult();

//        -----------------------------------
        $em = $this->getDoctrine()->getManager();

        $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->moyenne($prod);
        $moyenne = ceil($moyen);
        $Request = $this->getRequest();
   $id1 = $this->getUser()->getId();
        $cE = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->countProduitEv($id1,$id);
       if (empty($cE))
        { $empty=true;}
        else {$empty=false;}
        if ($Request->getMethod() == 'POST') {

            dump($Request->get('note'));
//             var_dump($Request->get('note'));

            $em = $this->getDoctrine()->getManager();
            $prod = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);


            $noteDonne = $Request->get('note');
//        var_dump($noteDonne);
//        $compte = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->find($id);
            $note = new EvaluationProd();
            $note->setRating($noteDonne);
$a = $this->getUser()->getId();
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->find($a);
            
            
            $note->setIdMembre($user);

            $note->setIdProduit($prod);

            $em->persist($note);
            $em->flush();

            $em = $this->getDoctrine()->getEntityManager();
            $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->moyenne($prod);
            $moyenne = ceil($moyen);
        }
        return $this->render('PidevAllForDealBundle:Default:detail.html.twig', array('produit' => $prod, 'images' => $images, 'cat1' => $cat1, 'sous1' => $sous1, 'imageslike' => $imageslike, 'moyenne' => $moyenne, 'imagesred' => $imagesred,'e'=>$empty));
//        
//            die('$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$');
//        }
//          return $this->redirect($this->generateUrl('presentation', array('produit' => $prod, 'images' => $images,'cat1' => $cat1, 'sous1' => $sous1,'imageslike'=>$imageslike,'moyenne'=>$moyenne)));
        // return $this->render('EspritCompteBundle:Offre:single.html.twig', array( 'results' => $results,'offre' => $offre, 'photos' => $photos , 'moyenne'=>$moyenne , 'commentaires' => $commentaires,'json_tab'=>json_encode($json_tab) ,'a' => $a));
    }

//    -----------------------------------ooooooooooooooooo---------------------------------------------

    public function updateprodAction($id) {
        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $em = $this->getDoctrine()->getManager();


        $em = $this->getDoctrine()->getManager();
        $produp = $em->getRepository('PidevAllForDealBundle:Produit')->find($id);

        $imagesup = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array('idProduit' => $produp));


        $Request = $this->getRequest();

        if ($Request->getMethod() == 'POST') {
            $produp->setNom($Request->get('nom'));
            $produp->setPrix($Request->get('prix'));
            $produp->setReduction($Request->get('reduction'));
            $produp->setPoints($Request->get('points'));
            $produp->setEtat('attente');

            $produp->setCouleur($Request->get('colors'));
            $search = $Request->get('region_input');


            $Scateg1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->find($search);

            $produp->setIdSousCategorie($Scateg1);
            $em->merge($produp);
            $em->flush();
            $photos = $Request->get('image');

            $imagesup = $em->getRepository('PidevAllForDealBundle:Image')->findBy(array('idProduit' => $produp));

            $j = sizeof($imagesup);
            // echo $j;
            foreach ($photos as $photo) {
                if ($j < 3) {
                    $media = new Image();
                    $media->setIdProduit($produp);
                    $media->setImageName($photo);
                    $media->setUpdatedAt($this->updated = new \DateTime("now"));
                    $em->persist($media);
                    $em->flush();
                    echo $j . '<br>';
                }
                $j++;
            }





            return $this->redirectToRoute('supplier_products');
        }
        return $this->render("PidevAllForDealBundle:Default:Updateprod.html.twig", array("produp" => $produp, 'cat1' => $cat1, 'sous1' => $sous1, 'imagesup' => $imagesup));
    }

    public function deleteimageupAction($id) {
        $em = $this->getDoctrine()->getManager();

        $imagesup = $em->getRepository('PidevAllForDealBundle:Image')->find($id);
        $a = $imagesup->getIdProduit();
        $em->remove($imagesup);
        $em->flush();

        return $this->redirect($this->generateUrl('update_products', array('id' => $a->getId())));
    }

    public function uploadAction(Request $request) {
        $image = new Image();
        $type = new ImageType();
        $form = $this->createForm($type, $image);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
        }

        return $this->render("PidevAllForDealBundle:Default:add.html.twig", array("form" => $form->createView()));
    }

    /* filtreeeeeeeeeeeeee */


    public function ParcourtImageAction($idSousCategorie) {

  $em = $this->getDoctrine()->getManager();
  $count = $em->getRepository('PidevAllForDealBundle:Produit')->countProduit($idSousCategorie);
 $countall = $em->getRepository('PidevAllForDealBundle:Produit')->countallProduit();

       $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();


        $produits = $em->getRepository('PidevAllForDealBundle:Produit')->findAll();

        $query = $this->getDoctrine()->getEntityManager()->createQuery("SELECT   m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where o.id=m.idProduit and o.idSousCategorie=:idsous and o.etat='approuver' GROUP BY m.idProduit ")
                ->setParameter('idsous', $idSousCategorie);


        $image = $query->getResult();


        $images = $this->get('knp_paginator')->paginate($image, $this->get('request')->query->get('page', 1), 4);




        return $this->render('PidevAllForDealBundle:Default:category.html.twig', array('produits' => $produits, 'images' => $images, 'cat1' => $cat1, 'sous1' => $sous1,'idSousCategorie'=>$idSousCategorie,'count'=>$count,'countall'=>$countall));
    }

    public function filtreitemAction($item,$id) {

        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery("SELECT  m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:idsous and o.etat='approuver' GROUP BY m.idProduit order by o.".$item)
                  ->setParameter('idsous', $id);
        $image = $query->getResult();
$images = $this->get('knp_paginator')->paginate($image, $this->get('request')->query->get('page', 1), 4);

        $html = $this->renderView("PidevAllForDealBundle:Default:divfiltre.html.twig", array('images' => $images, 'cat1' => $cat1, 'sous1' => $sous1));
        return new Response($html);
//        $serializedEntity = $this->container->get('jms_serializer')->serialize($orders, 'json');
//
//        return new Response($serializedEntity);
    }

}
