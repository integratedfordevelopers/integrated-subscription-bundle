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
use Symfony\Component\Intl\Data\Util\ArrayAccessibleResourceBundle;

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
            ->add('teaser', 'textarea', array('label' => 'Description'))
            ->add('disabled', 'checkbox', array('required' => false))
            ->add('freetier', 'integer', array('required' => false))
            ->add('channel', 'integrated_channel_choice', ['multiple'=> true, 'expanded'=> true, 'mapped'=>false])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();
            foreach($request->request->get("form")["channel"] as $channel) {
                $wallchannel = new WallChannel();
                $wallchannel->setChannel($channel);
                $wallchannel->setWall($wall->getId());
                $wallchannel->setSubscriptionWall($wall);
                $em2 = $this->getDoctrine()->getManager();
                $em2->persist($wallchannel);
                $em2->flush();
            }
            
            $this->addFlash(
                'notice',
                'Your wall is created!'
            );
            return $this->redirectToRoute('integrated_subscription_show_wall');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:create.html.twig', $build);
    }

    public function editAction(SubscriptionWall $wall, Request $request)
    {
        $channelNames = array();
        $selectedChannelNames = array();
        $selectedChannelIDs = array();

        $em = $this->getDoctrine()->getManager();
        $channels = $this->get("integrated_content.channel.manager")->findAll();

        foreach($channels as $channel) {
            $channelNames[] = $channel->getId();
        }

        sort($channelNames);

        foreach($wall->getWallChannels() as $wallChannel) {
            $selectedChannelNames[] = $wallChannel->getChannel();
        }

        foreach($selectedChannelNames as $selectedChannelName) {
            $selectedChannelIDs[] = array_search($selectedChannelName, $channelNames);
        }

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('teaser', 'textarea', array('label' => 'Description'))
            ->add('disabled', 'checkbox', array('required' => false))
            ->add('freetier', 'integer', array('required' => false,'data'=> 0))
            ->add('channel', 'choice', ['choices' => $channelNames, 'multiple'=> true, 'expanded'=> true, 'mapped' => false, 'data' => $selectedChannelIDs])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        // form posted
        if ($form->isValid()) {
            $em->flush();

            $wall->setName($request->request->get("form")["name"]);
            $wall->setTeaser($request->request->get("form")["teaser"]);
            if(isset($request->request->get("form")["disabled"])) {
                $wall->setDisabled($request->request->get("form")["disabled"]);
            }
            $wall->setFreetier($request->request->get("form")["freetier"]);

            // Delete part
            $entities = $em->getRepository('IntegratedSubscriptionBundle:WallChannel')->findBy(array('wall' => $wall->getId()));
            foreach($entities as $entity) {
                if ($entity != null){
                    $em->remove($entity);
                    $em->flush();
                }
            }


            // Add part
            foreach($request->request->get("form")["channel"] as $channel) {
                $wallChannel = new WallChannel();
                $wallChannel->setWall($wall->getId());
                $wallChannel->setChannel($channelNames[$channel]);
                $wallChannel->setSubscriptionWall($wall);
                dump($wallChannel);
                $em->persist($wallChannel);
                $em->flush();
            }

            $this->addFlash(
                'notice',
                'Your wall has been updated!'
            );
            return $this->redirectToRoute('integrated_subscription_show_wall');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:edit.html.twig', $build);
    }
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $wall = $em->getRepository('IntegratedSubscriptionBundle:SubscriptionWall')->find($id);
        if (!$wall) {
            throw $this->createNotFoundException(
                'No wall found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($wall)
            ->add('delete', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->remove($wall);
            $em->flush();
            $this->addFlash(
                'notice',
                'The wall was deleted'
            );
            return $this->redirectToRoute('integrated_subscription_show_wall');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:delete.html.twig', $build);
    }
}