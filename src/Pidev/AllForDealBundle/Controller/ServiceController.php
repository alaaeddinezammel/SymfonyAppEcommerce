<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pidev\AllForDealBundle\Entity\Service;
use Pidev\AllForDealBundle\Form\ServiceType;
use Pidev\AllForDealBundle\Entity\Membre;
use Symfony\Component\HttpFoundation\Request;
use Pidev\AllForDealBundle\Entity;
use Pidev\AllForDealBundle\Entity\EvaluationService;
use Pidev\AllForDealBundle\Entity\Demande;
use Pidev\AllForDealBundle\Entity\Reclamation;
use Pidev\AllForDealBundle\Entity\CommentaireService;

class ServiceController extends Controller {

    public function ratingSAction($id) {

        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $service = $em->getRepository('PidevAllForDealBundle:Service')->findBy(array('id' => $id));


        $prod = $em->getRepository('PidevAllForDealBundle:Service')->find($id);

//        $query = $this->getDoctrine()->getEntityManager()
//                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Service  where m.id=:ii   ")
//                ->setParameter('ii', $id)
//                ;
//
//        $imageslike = $query->getResult();
        //        ----------------------------------
//        $query = $this->getDoctrine()->getEntityManager()
//                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id and o.idSousCategorie=:categ  and o.reduction>2 and o.etat='approuver'  GROUP BY m.idProduit order by m.updatedAt ")
//                ->setParameter('categ', $categID)
//                ->setMaxResults(3);
//
//        $imagesred = $query->getResult();
//        -----------------------------------
        $em = $this->getDoctrine()->getManager();

        $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationService')->moyenne($prod);
        $moyenne = ceil($moyen);
        $Request = $this->getRequest();

        if ($Request->getMethod() == 'POST') {

            dump($Request->get('note'));
//             var_dump($Request->get('note'));

            $em = $this->getDoctrine()->getManager();
            $prod = $em->getRepository('PidevAllForDealBundle:Service')->find($id);


            $noteDonne = $Request->get('note');
//        var_dump($noteDonne);
//        $compte = $em->getRepository('PidevAllForDealBundle:EvaluationProd')->find($id);
            $note = new EvaluationService();
            $note->setRating($noteDonne);
            $a = $this->getUser()->getId();
            $user = $em->getRepository('PidevAllForDealBundle:Membre')->find($a);

            $note->setIdMembre($user);
            $note->setIdService($prod);
            $em->persist($note);
            $em->flush();

            $em = $this->getDoctrine()->getEntityManager();
            $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationService')->moyenne($prod);
            $moyenne = ceil($moyen);
        }
        return $this->render('PidevAllForDealBundle:Service:detail_service.html.twig', array('i'=>$service,'ii' => $id,'produit' => $prod, 'cat1' => $cat1, 'sous1' => $sous1, 'moyenne' => $moyenne));
//        
//            die('$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$');
//        }
//          return $this->redirect($this->generateUrl('presentation', array('produit' => $prod, 'images' => $images,'cat1' => $cat1, 'sous1' => $sous1,'imageslike'=>$imageslike,'moyenne'=>$moyenne)));
        // return $this->render('EspritCompteBundle:Offre:single.html.twig', array( 'results' => $results,'offre' => $offre, 'photos' => $photos , 'moyenne'=>$moyenne , 'commentaires' => $commentaires,'json_tab'=>json_encode($json_tab) ,'a' => $a));
    }

    public function addServiceAction() {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $model = new Service();
        $Request = $this->getRequest();
        if ($Request->getMethod() == "POST") {
            $model = new Service();
            $x = $Request->get('nom');
            $y = $Request->get('categorie');
            $w = $Request->get('description');

            $model->setNom($x);
            $model->setCategorie($y);
            $model->setDescription($w);
            $a = $this->getUser()->getId();
            $mem = new Membre();
            $mem = $em->getRepository('PidevAllForDealBundle:Membre')->findOneBy(array('id' => $a));

            $model->setIdFournisseur($mem);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($model);
            $em->flush();
            return $this->redirectToRoute('supplier_Myservices');
        }
        return $this->render('PidevAllForDealBundle:Service:add_service.html.twig', array('cat1' => $cat1, 'sous1' => $sous1));
    }

    public function supplierServicesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $service = $em->getRepository('PidevAllForDealBundle:Service')->findAll();

        $pagination = $this->get('knp_paginator')->paginate(
                $service, $request->query->get('page', 1), 5);

        return $this->render('PidevAllForDealBundle:Service:ListAllService.html.twig', array('mod' => $service, 'pagination' => $pagination, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function mesServicesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $a = $this->getUser()->getId();
        $mem = new Membre();
        $mem = $em->getRepository('PidevAllForDealBundle:Membre')->findOneBy(array('id' => $a));

        $service = $em->getRepository('PidevAllForDealBundle:Service')->findBy(array('idFournisseur' => $mem));

        $pagination = $this->get('knp_paginator')->paginate(
                $service, $request->query->get('page', 1), 5);

        return $this->render('PidevAllForDealBundle:Service:MyServices.html.twig', array('mod' => $pagination, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function gestionServiceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $service = $em->getRepository('PidevAllForDealBundle:Service')->findAll();
        return $this->render('PidevAllForDealBundle:Service:GestionService.html.twig', array('mod' => $service, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
                             $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:EvaluationService d where d.idService=".$id)->getResult();
               
               $objet11 = $em->createQuery("delete FROM PidevAllForDealBundle:Reclamation d where d.idService=".$id)->getResult();
               
 $objet1144 = $em->createQuery("delete FROM PidevAllForDealBundle:Demande d where d.idService=".$id)->getResult();
               
               $objet1144 = $em->createQuery("delete FROM PidevAllForDealBundle:CommentaireService d where d.idService=".$id)->getResult();
               
        $objet = $em->getRepository('PidevAllForDealBundle:Service')->find($id);
        $em->remove($objet);
        $em->flush();
        return $this->redirectToRoute('supplier_Myservices');
    }

    function updateAction($id) {
//        $em=$this->getDoctrine()->getManager();
//        $service = $em->getRepository('PidevAllForDealBundle:Service')->find($id);      
//        return $this->render('PidevAllForDealBundle:Service:modif_service.html.twig', array('mod' => $service));

        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $model = $em->getRepository('PidevAllForDealBundle:Service')->find($id);
        $form = $this->createForm(new ServiceType(), $model);
        $request = $this->getRequest();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mod = $form->getData();
            $em->persist($mod);
            $em->flush();
            return($this->redirectToRoute('supplier_Myservices'));
        }
        return $this->render('PidevAllForDealBundle:Service:modif_service.html.twig', array('f' => $form->createView(), 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function Detail_serviceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

            
        $service1 = $em->getRepository('PidevAllForDealBundle:Service')->find($id);
        $moyen = $em->getRepository('PidevAllForDealBundle:EvaluationService')->moyenne($service1);
            $moyenne = ceil($moyen);
        $service = $em->getRepository('PidevAllForDealBundle:Service')->findBy(array('id' => $id));
        $em->flush();
        $a = $this->getUser()->getId();
        $mem = $em->getRepository('PidevAllForDealBundle:Membre')->findOneBy(array('id' => $a));

$Request = $this->getRequest();
 if ($Request->getMethod() == 'POST') {
//Ici le mail de validation
        $message = \Swift_Message::newInstance()
                ->setSubject('A propos de votre Service ')
                ->setFrom(array('allfordeal1@gmail.com' => "All For Deal"))
                ->setTo($service1->getIdFournisseur()->getEmailCanonical())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('PidevAllForDealBundle:Service:EmailService.html.twig', array('service' => $service1->getIdFournisseur(), 'consommateur_email' => $mem->getEmailCanonical(), 'consommateur_nom' => $mem->getNom())));
        $this->get('mailer')->send($message);
        $this->get('session')->getFlashBag()->add('success', '');
 return $this->redirect($this->generateUrl('supplier_Allservices'));
 }
        return $this->render('PidevAllForDealBundle:Service:detail_service.html.twig', array('i' => $service, 'cat1' => $cat1, 'sous1' => $sous1, 'ii' => $id,'moyenne'=>$moyenne));
   
        }

    public function DetailMyserviceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();

        $destinos = $em->getRepository('PidevAllForDealBundle:Service')->findBy(array('id' => $id));
        return $this->render('PidevAllForDealBundle:Service:detailmyservice.html.twig', array('i' => $destinos, 'cat1' => $cat1, 'sous1' => $sous1));
    }

}
