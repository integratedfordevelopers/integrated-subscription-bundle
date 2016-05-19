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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;

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

    public function createAction(Request $request)
    {
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
