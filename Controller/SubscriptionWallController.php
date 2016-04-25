<?php
/**
 * Created by PhpStorm.
 * User: Albert-David
 * Date: 19-04-16
 * Time: 12:42
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionWall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Forms;

class SubscriptionWallController extends Controller
{
//    public function indexAction(){
//        $news = $this->getDoctrine()
//            ->getRepository('Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionWall')
//            ->find('1c285820-088c-11e6-86ad-080027d8aa75');
//        if (!$news) {
//            throw $this->createNotFoundException('No news found by id ');
//        }
//
//        $build['news_item'] = $news;
//        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:news_show.html.twig', $build);
////        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig');
//    }
    public function createAction(Request $request) {

        $wall = new SubscriptionWall();

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();
            return new Response('Wall added successfuly');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:create.html.twig', $build);
    }
}