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
     * SubscriptionWallController constructor.
     * @param TwigEngine $templating
     * @param EntityManager $em
     * @param FormFactory $form
     * @param RouterInterface $router
     * @param RequestStack $requestStack
     * @param FlashMessage $flashMessage
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
    public function deleteAction()
    {
    }
}
