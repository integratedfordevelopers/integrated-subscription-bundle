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

use Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall;
use Integrated\Bundle\SubscriptionBundle\Model\WallChannel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl>
 * @author Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallController extends Controller
{

    /**
     * Lists the walls
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $walls = $this->getDoctrine()
            ->getRepository('Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall')
            ->findAll();

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', ['walls' => $walls]);
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
        $channelNames = [];
        foreach ($channels as $channel) {
            $channelNames[] = $channel->getName();
        }

        $form = $this->createCreateForm($wall, $channelNames);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();

            if (isset($request->request->get("integrated_subscription_wall")["channel"])) {
                foreach ($request->request->get("integrated_subscription_wall")["channel"] as $channel) {
                    $wallChannel = new WallChannel();
                    $wallChannel->setChannel($channelNames[$channel]);
                    $wallChannel->setWall($wall);
                    $wallChannel->setSubscriptionWall($wall);
                    $em->persist($wallChannel);
                    $em->flush();
                }
            }

            $this->get('braincrafted_bootstrap.flash')->success('Wall created');

            return $this->redirectToRoute('integrated_subscription_show_wall');
        }
        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:create.html.twig', $build);
    }

    /**
     * @param SubscriptionWall $wall
     * @param array $channelNames
     * @param array $selectedChannelNames
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function createCreateForm(SubscriptionWall $wall, $channelNames, $selectedChannelNames)
    {

        $attr = array("channelNames" => $channelNames, "selectedChannelNames" => $selectedChannelNames);

        $form = $this->createForm(
            'integrated_subscription_wall',
            $wall,
            [
                'action' => $this->generateUrl('integrated_subscription_create_wall'),
                'method' => 'POST',
                'attr' => $attr
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Save']);

        return $form;
    }

    public function editAction(Request $request)
    {
        $wall = new SubscriptionWall();
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

        $form = $this->createCreateForm($wall, $channelNames, $selectedChannelNames);
        $form->handleRequest($request);

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

    public function showAction()
    {
    }

    public function deleteAction()
    {
    }
}
