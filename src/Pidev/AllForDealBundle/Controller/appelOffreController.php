<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pidev\AllForDealBundle\Entity\AppelOffre;
use Pidev\AllForDealBundle\Form\RechercheForm;
use Symfony\Component\HttpFoundation\Response;

class appelOffreController extends Controller {

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
    
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
           $modeles = $em->getRepository('PidevAllForDealBundle:AppelOffre')->findAppelOffre($this->getUser()->getId());
        return $this->render('PidevAllForDealBundle:offre:appelOffre.html.twig', array(
                    'modeles' => $modeles,'cat1' => $cat1, 'sous1' => $sous1
        ));
    }
    public function alllistAction() {
        $em = $this->getDoctrine()->getManager();
    
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
           $modeles = $em->getRepository('PidevAllForDealBundle:AppelOffre')->findAppelOffreAll($this->getUser()->getId());
        return $this->render('PidevAllForDealBundle:offre:appelOffre_all.html.twig', array(
                    'modeles' => $modeles,'cat1' => $cat1, 'sous1' => $sous1
        ));
    }

    public function addAppelOffreAction() {
        $em = $this->getDoctrine()->getManager();
        
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
           
        $req = $this->getRequest();
        if ($req->getMethod() == "POST") {
            $model = new AppelOffre();
            $x = $req->get('sujet');
            $y = $req->get('description');
            $w = $req->get('lieu');
            $z = $req->get('remarque');
            $a = $req->get('datedebut');
            $b = $req->get('datefin');
            $model->setSujet($x);
            $model->setDescription($y);
            $model->setLieu($w);
            $model->setRemarque($z);
            $model->setDatedebut($a);
            $model->setDatefin($b);
           
            $model->setIdConsommateur($this->getUser());
            $em->persist($model);
            $em->flush();
        }
        return $this->render("PidevAllForDealBundle:offre:add_appelOffre.html.twig",array('cat1' => $cat1, 'sous1' => $sous1));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $Modele = $em->getRepository('PidevAllForDealBundle:AppelOffre')->find($id);
        $em->remove($Modele);
        $em->flush();
        return $this->redirectToRoute('Affichage_offre');
    }

    public function updateAction($id) {
        //em
        $em = $this->getDoctrine()->getManager();
        
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $Modele = $em->getRepository('PidevAllForDealBundle:AppelOffre')->find($id);

        $form = $this->createForm(new \Pidev\AllForDealBundle\Form\OffreForm, $Modele);
        $request = $this->getRequest();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mod = $form->getData();
            $em->persist($mod);
            $em->flush();
            return($this->redirectToRoute("Affichage_offre"));
        }
        return $this->render('PidevAllForDealBundle:offre:update_appelOffre.html.twig', array('form18' => $form->createView(),'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function detail_offreAction($id) {
        $em = $this->getDoctrine()->getManager();

            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $destinos = $em->getRepository('PidevAllForDealBundle:AppelOffre')->find($id);

        
        
        $stmt = $em->getConnection()->prepare("SELECT * FROM appel_offre_membre where appel_offre_membre.id_fournisseur= :id");

        $id1 = $this->getUser()->getId();

        $stmt->bindParam(':id', $id1);
        $stmt->execute();
        
        if (empty($stmt->fetchAll()))
        { $empty=true;}
        else {$empty=false;}
//         var_dump($empty);
//        die();
        
        return $this->render('PidevAllForDealBundle:offre:detail_appelOffre.html.twig', array('i' => $destinos,'e'=>$empty,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function reponse_offreAction($id) {
        $em = $this->getDoctrine()->getManager();

            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $config = new \Doctrine\DBAL\Configuration();
//..
        $connectionParams = array(
            'dbname' => 'pidev',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

        $conn->insert('appel_offre_membre', array('id_appel_offre' => $id, 'id_fournisseur' => $this->getUser()->getId()));

        return $this->redirectToRoute("Affichage_offre_All");
    }

    public function notification_offreAction() {

        $em = $this->getDoctrine()->getManager();

            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        
        $stmt = $em->getConnection()->prepare("SELECT * FROM appel_offre_membre INNER JOIN appel_offre ON appel_offre_membre.id_appel_offre=appel_offre.id inner join membre on membre.id = appel_offre_membre.id_fournisseur where appel_offre.id_consommateur= :id");

        $id = $this->getUser()->getId();

        $stmt->bindParam(':id', $id);
        $stmt->execute();

//        var_dump($stmt->fetchAll());
//        die();

        return $this->render('PidevAllForDealBundle:offre:listeNotification.html.twig', array('i' => $stmt->fetchAll(),'cat1' => $cat1, 'sous1' => $sous1));
    }

}
