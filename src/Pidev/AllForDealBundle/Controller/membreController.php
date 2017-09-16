<?php
namespace Pidev\AllForDealBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pidev\AllForDealBundle\Controller\membre;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
class membreController extends Controller{
    
    public function getParent()

 {

 return 'FOSUserBundle';

 }
 
 
    
    
    
    public function DesactivateAction(Request $request)
    {   
        $model= $this->getUser();
        $model->setEnabled(FALSE);
        $em=$this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();
        
        $anonToken=new \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken('50cdf89882454', 'anon.', array());
        $this->get('security.context')->setToken($anonToken);
        
         $em = $this->getDoctrine()->getManager();
            $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
           
           $query = $em
                ->createQuery("SELECT distinct m from PidevAllForDealBundle:Image m,PidevAllForDealBundle:Produit o where m.idProduit=o.id GROUP BY m.idProduit order by m.updatedAt ")
     
                ->setMaxResults(10);

        $images = $query->getResult();
           
        return $this->render ('PidevAllForDealBundle:Default:index.html.twig', array('images' => $images,'cat1' => $cat1, 'sous1' => $sous1));
    }


    public function AjouterAction()
    {   $req=$this->get('request');
        $model= new \Pidev\AllForDealBundle\Entity\Membre();
        if($req->getMethod()=="POST")
        {
        $nom=$req->get('nom');
        $prenom=$req->get('prenom');  
        $age=$req->get('age'); 
        $genre=$req->get('genre'); 
        $adresse=$req->get('adresse'); 
        $type=$req->get('type'); 
        $email=$req->get('email');
        $login=$req->get('login'); 
        $password=$req->get('password'); 
        
        $model->setNom($nom);
        $model->setPrenom($prenom);
        $model->setAge($age);
        $model->setGenre($genre);
        $model->setAdresse($adresse);
        $model->setType($type);
        $model->setPoints(1000);
        $model->setEmail($email);
        $model->setLogin($login);
        $model->setPassword($password);
        $em=$this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();
            return new Response('Bienvenue dans Notre Site WEb!! Vous avez 1000 points Gratuites !!');
        }
         return $this->render('PidevAllForDealBundle:Default:register.html.twig'); 
     }
     public function ajouter2Action()
     {
        $em = $this->getDoctrine()->getManager();
        $model= new \Pidev\AllForDealBundle\Entity\Membre();
//        $model = $em->getRepository('PidevAllForDealBundle:Membre')->find($id);
        $form = $this->createForm(new \FOS\UserBundle\Form\Type\RegistrationFormType, $model);
        $request=$this->getRequest();
        if($form->handleRequest($request)->isValid())
        {
        $em = $this->getDoctrine()->getManager();
        $mod=$form->getData();
        $em->persist($mod);
        $em->flush();
        return $this->render('PidevAllForDealBundle:Default:register.html.twig'); 
        }
//        return $this->render('PidevAllForDealBundle:Default:modifProfil.html.twig', array('form18' => $form->createView()));
  
        return $this->render('PidevAllForDealBundle:Default:register1.html.twig', array('form18' => $form->createView()));  
     }
     public function add1Action() {
        $model = new \Pidev\AllForDealBundle\Entity\Membre();
        $form = $this->createForm(new \FOS\UserBundle\Form\Type\RegistrationFormType("$model"));
        $request = $this->getRequest();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
        }
        return $this->render('PidevAllForDealBundle:Default:register.html.twig', array('form18' => $form->createView()));
    }
             

    function AffichageAction()
    {
            $em=$this->getDoctrine()->getManager();
    $membres=$em->getRepository
            ('PidevAllForDealBundle:Membre')->findAll();
return $this->render('PidevAllForDealBundle:Admin:membre1.html.twig',
        array('membres'=>$membres)); 


    }
    function Affichage2Action($id)
    {
            $em=$this->getDoctrine()->getManager();
    $membres=$em->getRepository
            ('PidevAllForDealBundle:Membre')->find($id);
return $this->render('PidevAllForDealBundle:Default:aff.html.twig',
        array('membres'=>$membres)); 
    }


    public function SupprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        
//         $objet1 = $em->createQuery("delete FROM PidevAllForDealBundle:produit d where d.idService=".$id)->getResult();

        $m = $em->getRepository('PidevAllForDealBundle:Membre')->find($id);
        $em->remove($m);
        $em->flush();
        return($this->redirectToRoute("admin_affiche"));

    }
    public function ModifierAction($id)
    {
    
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository('PidevAllForDealBundle:Membre')->find($id);
        $form = $this->createForm(new \Pidev\AllForDealBundle\Form\MembreForm, $model);
        $request=$this->getRequest();
        if($form->handleRequest($request)->isValid())
        {
        $em = $this->getDoctrine()->getManager();
        $mod=$form->getData();
//        var_dump($mod);
//        die();
        $em->persist($mod);
        $em->flush();
        return($this->redirectToRoute("admin_affiche"));
        }
        return $this->render('PidevAllForDealBundle:Default:Modifier.html.twig', array('form18' => $form->createView()));
  
    }
    
    public function RechercheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $m = $em->getRepository('PidevAllForDealBundle:Membre')->findAll();
        $request = $this->get('request');
        if ($request->getMethod()=="POST")
        {
            $search=$request->get('search');
            $m=$em->getRepository('PidevAllForDealBundle:Membre')->findBy(array("nom"=>$search));        
        }
        return $this->render('PidevAllForDealBundle:Default:recherche.html.twig',array("membre"=>$m));
        
//    $em=$this->getDoctrine()->getManager();
//    $m=$em->getRepository('PidevAllForDealBundle:Membre')->findByDQL();
//    return $this->render('PidevAllForDealBundle:Membre:recherche.html.twig', array('membre'=>$m));
    
    }

    
}