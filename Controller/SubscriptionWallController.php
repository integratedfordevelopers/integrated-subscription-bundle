<?php
/*
* This file is part of the Integrated package.
*
* (c) e-Active B.V. <integrated@e-active.nl>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionWall;
use Integrated\Bundle\SubscriptionBundle\Entity\WallChannel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl> and Albert David Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallController extends Controller
{

    /**
     * List walls
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $walls = $this->getDoctrine()
            ->getRepository('IntegratedSubscriptionBundle:SubscriptionWall')
            ->findAll();

        if (!$walls) {
            throw $this->createNotFoundException('No walls found!');
        }

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', array('walls' => $walls));
    }

    /**
     * Creates a wall
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $wall = new SubscriptionWall();
        $channels = $channels = $this->get("integrated_content.channel.manager")->findAll();
        $channelNames = array();
        foreach ($channels as $channel) {
            $channelNames[] = $channel->getName();
        }

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('teaser', 'textarea', array('label' => 'Description'))
            ->add('disabled', 'checkbox', array('required' => false))
            ->add('freetier', 'integer', array('required' => false))
            ->add('channel', 'choice', ['choices'=>$channelNames,'multiple'=> true, 'expanded'=> true, 'mapped' => false])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();
            foreach ($request->request->get("form")["channel"] as $channel) {
                $wallChannel = new WallChannel();
                $wallChannel->setChannel($channelNames[$channel]);
                $wallChannel->setWall($wall->getId());
                $wallChannel->setSubscriptionWall($wall);
                $em->persist($wallChannel);
                $em->flush();
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

    /**
     * Edit walls
     *
     * @param SubscriptionWall $wall
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(SubscriptionWall $wall, Request $request)
    {
        $channelNames = $selectedChannelNames = $selectedChannels = array();

        $em = $this->getDoctrine()->getManager();
        $channels = $this->get("integrated_content.channel.manager")->findAll();

        foreach ($channels as $channel) {
            $channelNames[] = $channel->getName();
        }

        foreach ($wall->getWallChannels() as $wallChannel) {
            $selectedChannelNames[] = $wallChannel->getChannel();
        }

        foreach ($selectedChannelNames as $selectedChannelName) {
            $selectedChannels[] = array_search($selectedChannelName, $channelNames);
        }

        sort($channelNames);

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('teaser', 'textarea', array('label' => 'Description'))
            ->add('disabled', 'checkbox', array('required' => false))
            ->add('freetier', 'integer', array('required' => false))
            ->add('channel', 'choice', ['choices' => $channelNames, 'multiple'=> true, 'expanded'=> true, 'mapped' => false, 'data' => $selectedChannels])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        // Form Posted
        if ($form->isValid()) {
            // Store changed data
            $wall->setName($request->get("form")["name"]);
            $wall->setTeaser($request->get("form")["teaser"]);
            if (isset($request->get("form")["disabled"])) {
                $wall->setDisabled($request->get("form")["disabled"]);
            }
            $wall->setFreetier($request->get("form")["freetier"]);

            // Delete all existing WallChannel records
            $entities = $em->getRepository('IntegratedSubscriptionBundle:WallChannel')->findBy(array('wall' => $wall->getId()));
            foreach ($entities as $entity) {
                if ($entity != null) {
                    $em->remove($entity);
                    $em->flush();
                }
            }

            // Store new WallChannel data
            foreach ($request->get("form")["channel"] as $channel) {
                $wallChannel = new WallChannel();
                $wallChannel->setWall($wall->getId());
                $wallChannel->setChannel($channelNames[$channel]);
                $wallChannel->setSubscriptionWall($wall);
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

    /**
     * Deletes a wall
     *
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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