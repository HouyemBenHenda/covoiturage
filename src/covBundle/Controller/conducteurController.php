<?php

namespace covBundle\Controller;

use covBundle\Entity\offre;
use covBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class conducteurController extends Controller
{


    /**
     * @Route("/ajouter",name="ajouter")
     */
    public function ajouterAction(Request $request)
    {

        $user=new user();
        $form=$this->createForm("covBundle\Form\userType",$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $file=$form['image']->getData();
            $newfile=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter("user_image"),$newfile);
            $user->setImage($newfile);
                        $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
       return $this->forward("covBundle:compte:display_login_user");
    }

    /**
     * @Route("/display_ajout",name="displayajout")
     */
    public function display_addAction(){
        $user=new user();
    $form=$this->createForm("covBundle\Form\userType",$user,array('action'=>$this->generateUrl("ajouter")));
    return $this->render("@cov/conducteur/display.html.twig",array("form"=>$form->createView()));
    }

    /**
     * @Route("/update_conducteur/{user}",name="update_conducteur")
     */
    public function updateAction(Request $request ,user $user=null)
    {
        if($user){
            $form=$this->createForm("covBundle\Form\adminType",$user);
            $form->handleRequest($request);
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->forward("covBundle:compte:displaycompte");
    }



    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {

        return $this->render('@cov/conducteur/delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/search")
     */
    public function searchAction()
    {
        return $this->render('covBundle:conducteur:search.html.twig', array(
            // ...
        ));
    }

}
