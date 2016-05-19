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

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl>
 * @author Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallController
{
    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param TwigEngine $templating
     */
    public function __construct(TwigEngine $templating, EntityManager $em)
    {
        $this->templating = $templating;
        $this->em = $em;
    }

    /**
     * Lists the walls
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $walls = $this->em
            ->getRepository('Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall')
            ->findAll();

        return $this->templating->renderResponse('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', ['walls' => $walls]);
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
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function createCreateForm(SubscriptionWall $wall, $channelNames)
    {

        $form = $this->createForm(
            'integrated_subscription_wall',
            $wall,
            [
                'action' => $this->generateUrl('integrated_subscription_create_wall'),
                'method' => 'POST',
                'attr' => $channelNames
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Save']);

        return $form;
    }

    public function editAction()
    {
    }

    public function showAction()
    {
    }

    public function deleteAction()
    {
    }
}
