<?php
/**
 * Created by PhpStorm.
 * User: Albert-David
 * Date: 19-04-16
 * Time: 12:42
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionWall;

use Integrated\Bundle\SubscriptionBundle\Entity\WallChannel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;

class SubscriptionWallController extends Controller
{
    public function indexAction(){
        $walls = $this->getDoctrine()
            ->getRepository('IntegratedSubscriptionBundle:SubscriptionWall')
            ->findAll();

        if (!$walls) {
            throw $this->createNotFoundException('No walls found!');
        }

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', array('walls' => $walls));
    }
    public function createAction(Request $request) {

        $wall = new SubscriptionWall();

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('channels', 'integrated_channel_choice', ['multiple'=> true, 'expanded'=> true])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {

            $channels = $wall->getChannels();

            $wall->setChannels(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();

            foreach($channels as $channel) {
                $wallchannel = new WallChannel();
                $wallchannel->setChannel($channel->getId());
                $wallchannel->setWall($wall->getId());
                $wallchannel->setSubscriptionWall($wall);

                $em2 = $this->getDoctrine()->getManager();
                $em2->persist($wallchannel);
                $em2->flush();
            }

            return new Response('Wall added successfuly');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:create.html.twig', $build);
    }
    public function editAction()
    {
        $walls = $this->getDoctrine()
            ->getRepository('IntegratedSubscriptionBundle:SubscriptionWall')
            ->findAll();
        if (!$walls) {
            throw $this->createNotFoundException('No walls found!');
        }

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', array('walls' => $walls));
    }
    public function deleteAction()
    {
        $walls = $this->getDoctrine()
            ->getRepository('IntegratedSubscriptionBundle:SubscriptionWall')
            ->findAll();
        if (!$walls) {
            throw $this->createNotFoundException('No walls found!');
        }

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', array('walls' => $walls));
    }
}