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

use Doctrine\ORM\Query;

use Integrated\Bundle\UserBundle\Form\Type\LoginFormType;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl>
 * @author Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallProcess
{

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var FormFactory
     */
    protected $form;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * SubscriptionWallProcess constructor.
     * @param TwigEngine $templating
     * @param FormFactory $form
     * @param RouterInterface $router
     */
    public function __construct(TwigEngine $templating, FormFactory $form, RouterInterface $router)
    {
        $this->templating = $templating;
        $this->form = $form;
        $this->router = $router;
    }

    /**
     * @return string
     */
    public function getAllModals($blocked) {
        return $this->getBaseModal($blocked) . $this->getLoginModal($blocked);
    }

    /**
     * @return string
     */
    public function getBaseModal($blocked)
    {
        return $this->templating->render('IntegratedSubscriptionBundle:Process:base_modal.html.twig', [
            'blocked' => $blocked
        ]);
    }

    /**
     * @return string
     */
    public function getLoginModal($blocked)
    {
        $form = $this->form->create(
            'user_security_login',
            ['_target_path' => 'test'],
            ['action' => $this->router->generate('integrated_user_check')]
        );

        return $this->templating->render('IntegratedSubscriptionBundle:Process:login_modal.html.twig',[
            'blocked' => $blocked,
            'form' => $form->createView()
        ]);
    }
}
