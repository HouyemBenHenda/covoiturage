<?php

namespace covBundle\Controller;

use covBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class compteController extends Controller
{
    /**
     * @Route("/display_login_user",name="display_login_user")
     */
    public function display_login_userAction()
    {
        $user=new user();
        $form=$this->createForm("covBundle\Form\user_loginType",$user,array('action'=>$this->generateUrl('login_user')));

        return $this->render('@cov/Default/index.html.twig',array("form"=>$form->createView()));
    }

    /**
     * @Route("/acceuil",name="acceuil")
     */
    public function display_acceuilAction(){
        return $this->render("@cov/Default/acceuil.html.twig");

    }

    /**
     * @Route("/apropos",name="apropos")
     */
    public  function  aproposAction(){
        return $this->render("@cov/Default/apropos.html.twig");
    }


    /**
     * @Route("/contacter",name="contacter")
     */
    public function contacterAction(){
        return $this->render("@cov/Default/contacter.html.twig");

    }

    /**
     * @Route("/display_compte",name="display_compte")
     */
    public function displaycompteAction(Request $request){
        $user_id=$request->getSession()->get('user');

        $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);

        $user->setImage("");
        $form=$this->createForm("covBundle\Form\adminType",$user,array("action"=>$this->generateUrl("update_conducteur",array("user"=>$user_id))));
        return $this->render("@cov/conducteur/update.html.twig",array("form"=>$form->createView()));
    }

    /**
     * @Route("/historique",name="historique")
     */
    public function historiqueAction(Request $request){
        $user=new user();
        $user=$this->getDoctrine()->getRepository("covBundle:user")->find($request->getSession()->get('user'));
        $reservations=$this->getDoctrine()->getRepository("covBundle:reservation")->findBy(array("conducteur"=>$user->getId(),"passager_1"=>$user->getId(),"passager2"=>$user->getId(),"passager3"=>$user->getId(),"passager4"=>$user->getId(),"etat"=>"cloturé"));
        return $this->render("@cov/conducteur/historique.html.twig",array("reservations"=>$reservations));
    }


    /**
     * @Route("/login_user",name="login_user")
     */
    public function login_userAction(Request $request){

        $user=new user();
        $form=$this->createForm("covBundle\Form\user_loginType",$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $user1=new user();
            $user1=$this->getDoctrine()->getRepository("covBundle:user")->findOneBy(array("login"=>$user->getLogin(),"password"=>$user->getPassword()));
            if($user1){
                $request->getSession()->set('user',$user1->getId());
                return $this->forward("covBundle:compte:load_compte");
            }else{
                return $this->forward("covBundle:compte:display_login_user");
            }
        }
        return $this->forward("covBundle:compte:display_login_user");

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/load_compte",name="load_compte")
     */
    public function load_compteAction(Request $request){

            $user_id=$request->getSession()->get('user');
            $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);

$reservations=$this->getDoctrine()->getRepository("covBundle:reservation")->select_reservations($user->getId());


        return $this->render("@cov/Default/compte.html.twig",array("reservations"=>$reservations));
    }

    /**
     * @Route("/log_out",name="log_out")
     */
    public function log_outAction(Request $request){
        $request->getSession()->clear();

        return $this->forward("covBundle:compte:display_login_user");

    }

    /**
     * @param Request $request
     * @Route("/mesoffres",name="mesoffres")
     */
    public function mesoffresAction(Request $request){

        $user_id=$request->getSession()->get('user');
        $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);
        $offres=$this->getDoctrine()->getRepository("covBundle:offre")->findBy(array("user"=>$user_id));
        return $this->render("@cov/Default/mesoffres.html.twig",array("offres"=>$offres));
    }



}
