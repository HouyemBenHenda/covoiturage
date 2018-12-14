<?php

namespace covBundle\Controller;

use covBundle\Entity\offre;
use covBundle\Entity\reservation;
use covBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class offreController extends Controller
{
    /**
     * @Route("/display_offre",name="display_offre")
     */
    public function display_offreAction(Request $request)
    {
        $offre =new offre();
        $form=$this->createForm("covBundle\Form\offreType",$offre,array("action"=>$this->generateUrl("add_offre")));

        return $this->render('@cov/offre/display.offre.html.twig', array(
        "form"=>$form->createView()   // ...
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/display_update_offre/{offre}",name="display_update_offre")
     */
    public function display_update_offre(Request $request,offre $offre=null){
        $offre->setImageVoiture("");
    $form=$this->createForm("covBundle\Form\offre_updateType",$offre,array("action"=>$this->generateUrl("update_offre",array("id"=>$offre->getId()))));
        return $this->render('@cov/offre/display.update.offre.html.twig', array(
            "form"=>$form->createView()));
    }

    /**
     * @Route("/add_offre",name="add_offre")
     */
    public function add_offreAction(Request $request)

    {
    $user=new user();
        $user_id=$request->getSession()->get('user');
        $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);
        $offre=new  offre();
        $form=$this->createForm("covBundle\Form\offreType",$offre);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $file=$form['image_voiture']->getData();
            $newfile=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter("voiture_image"),$newfile);
            $offre->setImageVoiture($newfile);
            $offre->setUser($user);
            $em=$this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            $reservation=new reservation();
            $reservation->setConducteur($user);
            $reservation->setDate($offre->getDate());
            $reservation->setHeure($offre->getHeure());
            $reservation->setVilleDep($offre->getVilleDep());
            $reservation->setVilleArriv($offre->getVilleArr());
            $reservation->setImageVaoiture($offre->getImageVoiture());
            $reservation->setNomVoiture($offre->getNomVoiture());
            $reservation->setDescription($offre->getDescription());
            $reservation->setNbreplace($offre->getNbrePlace());
            $reservation->setPrix($offre->getPrix());
            $reservation->setEtat("en cours");
            $em1=$this->getDoctrine()->getManager();
            $em1->persist($reservation);
            $em1->flush();

        }
        return $this->forward("covBundle:compte:load_compte");
    }

    /**
     * @Route("/update_offre/{id}",name="update_offre")
     */
    public function update_offreAction(Request $request,$id)
    {       $offre=$this->getDoctrine()->getRepository("covBundle:offre")->find($id);

        if($offre){
            $form=$this->createForm("covBundle\Form\offre_updateType",$offre);

            $form->handleRequest($request);
            $reservation=$this->getDoctrine()->getRepository("covBundle:reservation")->findOneBy(array("conducteur"=>$offre->getUser(),"heure"=>$offre->getHeure(),"date"=>$offre->getDate()));
            $reservation->setDate($offre->getDate());
            $reservation->setHeure($offre->getHeure());
            $reservation->setVilleDep($offre->getVilleDep());
            $reservation->setVilleArriv($offre->getVilleArr());

            $reservation->setNomVoiture($offre->getNomVoiture());
            $reservation->setDescription($offre->getDescription());
            $reservation->setNbreplace($offre->getNbrePlace());
            $reservation->setPrix($offre->getPrix());
    $em=$this->getDoctrine()->getManager();
    $em->persist($offre);
    $em->flush();
    $em1=$this->getDoctrine()->getManager();
    $em1->persist($reservation);
            $em1->flush();
        }
      return  $this->forward("covBundle:compte:mesoffres");
    }

    /**
     * @Route("/delete_offre/{offre}")
     */
    public function delete_offreAction(Request $request,offre $offre=null)
    {
        if($offre){

            $user=$this->getDoctrine()->getRepository(  "covBundle:user")->find($offre->getUser());
                $reservation=$this->getDoctrine()->getRepository("covBundle:reservation")->findOneBy(array("conducteur"=>$user->getId(),"date"=>$offre->getDate(),"heure"=>$offre->getHeure()));

                $em=$this->getDoctrine()->getManager();
                $em->remove($offre);
                $em1=$this->getDoctrine()->getManager();
                $em1->remove($reservation);
                $em1->flush();

        }
        return $this->forward("covBundle:compte:mesoffres");
    }

    /**
     * @Route("mes_reservations",name="mes_reservations")
     */
    public function mesreservationsAction(Request $request){

        $user_id=$request->getSession()->get('user');
        $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);
        $reservations=$this->getDoctrine()->getRepository("covBundle:reservation")->mes_resrvations($user->getId());
        return $this->render("@cov/Default/mesreservations.html.twig",array("reservations"=>$reservations));
    }

}
