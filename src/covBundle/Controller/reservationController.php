<?php

namespace covBundle\Controller;

use covBundle\Entity\reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class reservationController
 * @package covBundle\Controller
 * @\Symfony\Component\Routing\Annotation\Route("/reservation")
 */
class reservationController extends Controller
{
    /**
     * @Route("/display")
     */
    public function displayAction()
    {
        return $this->render('covBundle:reservation:display.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/reserver/{reservation}",name="reserver")
     */
    public function reserverAction(Request $request,reservation $reservation=null)
    {

        if($reservation){
            $user_id=$request->getSession()->get('user');
            $user=$this->getDoctrine()->getRepository("covBundle:user")->find($user_id);
            if($reservation->getPassager1()==null and $reservation->getPassager2()!= $user and $reservation->getPassager3() != $user and $reservation->getPassager4() != $user){
                $reservation->setPassager1($user);
            }elseif ($reservation->getPassager1() != $user and $reservation->getPassager2()== null and $reservation->getPassager3() != $user and $reservation->getPassager4() != $user){
                $reservation->setPassager2($user);
            }elseif ($reservation->getPassager1() != $user and $reservation->getPassager2()!= $user and $reservation->getPassager3() == null and $reservation->getPassager4() != $user){
                $reservation->setPassager3($user);
            }elseif ($reservation->getPassager1() != $user and $reservation->getPassager2()!= $user and $reservation->getPassager3() != $user and $reservation->getPassager4() == null){
                $reservation->setPassager4($user);
            }
            if($reservation->getPassager1() != null and $reservation->getPassager2()!= null and $reservation->getPassager3() != null and $reservation->getPassager4() != null){
                $reservation->setEtat("cloturée");
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
        }
        return $this->forward("covBundle:compte:load_compte");
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('covBundle:reservation:display.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete_reservation/{reservation}",name="delete_reservation")
     */
    public function deleteAction(Request $request,reservation $reservation=null)
    {
        if($reservation) {
            $user_id = $request->getSession()->get('user');
            $user = $this->getDoctrine()->getRepository("covBundle:user")->find($user_id);
            if($reservation->getPassager1() == $user){
                    $reservation->setPassager1(null);
            }elseif ($reservation->getPassager2() == $user){
                $reservation->setPassager2(null);
            }elseif ($reservation->getPassager3() == $user){
                $reservation->setPassager3(null);
            }elseif ($reservation->getPassager4()==$user){
                $reservation->setPassager4(null);
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
        }
        return $this->forward("covBundle:offre:mesreservations");
    }

}
