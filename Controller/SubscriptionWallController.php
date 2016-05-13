<?php
/**
 * Created by PhpStorm.
 * User: Albert-David
 * Date: 19-04-16
 * Time: 12:42
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubscriptionWallController extends Controller
{
    public function indexAction()
    {
        $walls = $this->getDoctrine()
            ->getRepository('Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall')
            ->findAll();
        if (!$walls) {
            throw $this->createNotFoundException('');
        }

        return $this->render('IntegratedSubscriptionBundle:SubscriptionWall:index.html.twig', ['walls' => $walls]);
    }
    public function editAction()
    {
    }
    public function createAction()
    {
    }
    public function showAction()
    {
    }
    public function deleteAction()
    {
    }
}
