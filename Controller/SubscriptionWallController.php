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

use Braincrafted\Bundle\BootstrapBundle\Session\FlashMessage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

use Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall;
use Integrated\Bundle\SubscriptionBundle\Model\WallChannel;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

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
     * @var Request
     */
    protected $request;

    /**
     * @var FormFactory
     */
    protected $form;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var FlashMessage
     */
    protected $flashMessage;

    /**
     * @param TwigEngine $templating
     */
    public function __construct(TwigEngine $templating, EntityManager $em, FormFactory $form, RouterInterface $router, RequestStack $requestStack, FlashMessage $flashMessage)
    {
        $this->templating = $templating;
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
        $this->form = $form;
        $this->router = $router;
        $this->flashMessage = $flashMessage;
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

        return $this->templating->renderResponse('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', [
            'walls' => $walls
        ]);
    }

    /**
     * Creates a wall
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $wall = new SubscriptionWall();

        $form = $this->createCreateForm($wall);
        $form->handleRequest($this->request);

        if ($form->isValid()) {
            $this->em->persist($wall);

            $channels = $form->get('channel')->getData();
            foreach ($channels as $channel) {
                $wallChannel = new WallChannel();
                $wallChannel->setChannel($channel->getId());
                $wallChannel->setWall($wall);
                $wallChannel->setSubscriptionWall($wall);
                $this->em->persist($wallChannel);
            }

            $this->em->flush();
            $this->flashMessage->success('Wall created');

            return new RedirectResponse($this->router->generate("integrated_subscription_show_wall"));
        }

        return $this->templating->renderResponse('IntegratedSubscriptionBundle:SubscriptionWall:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param SubscriptionWall $wall
     * @return Form
     */
    protected function createCreateForm(SubscriptionWall $wall)
    {
        $form = $this->form->create(
            'integrated_subscription_wall',
            $wall,
            [
                'action' => $this->router->generate('integrated_subscription_create_wall'),
                'method' => 'POST',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }

    public function editAction()
    {
        $wall = new SubscriptionWall();
        $channelNames = $selectedChannelNames = $selectedChannels = array();

        $channels = $this->cm->findAll();

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
        $form->handleRequest($this->request);

        // Form Posted
        if ($form->isValid()) {
            // Store changed data

            $wall->setName($this->request->get("form")["name"]);
            $wall->setTeaser($this->request->get("form")["teaser"]);
            if (isset($this->request->get("form")["disabled"])) {
                $wall->setDisabled($this->request->get("form")["disabled"]);
            }
            $wall->setFreetier($this->request->get("form")["freetier"]);

            // Delete all existing WallChannel records
            $entities = $this->em->findBy(array('wall' => $wall->getId()));
            foreach ($entities as $entity) {
                if ($entity != null) {
                    $this->em->remove($entity);
                    $this->em->flush();
                }
            }

            // Store new WallChannel data
            foreach ($this->request->get("form")["channel"] as $channel) {
                $wallChannel = new WallChannel();
                $wallChannel->setWall($wall->getId());
                $wallChannel->setChannel($channelNames[$channel]);
                $wallChannel->setSubscriptionWall($wall);
                $this->em->persist($wallChannel);
                $this->em->flush();
            }

            $this->flashMessage->success('Wall has been updated');

            return $this->router->redirectToRoute('integrated_subscription_show_wall');
        }

        $build['form'] = $form->createView();
        return $this->templating->renderResponse('IntegratedSubscriptionBundle:SubscriptionWall:edit.html.twig', $build);
    }

    public function showAction()
    {
    }

    public function deleteAction()
    {
    }
}
