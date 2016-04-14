<?php

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IntegratedSubscriptionBundle:Default:index.html.twig', array('name' => $name));
    }
}
