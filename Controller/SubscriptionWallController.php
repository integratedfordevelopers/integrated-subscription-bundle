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

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}