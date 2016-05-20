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

    public function createAction()
    {
    }

    public function editAction()
    {
    }

    public function showAction()
    {
    }
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $wall = $em->getRepository('Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall')->find($id);
        if (!$wall) {
            throw $this->createNotFoundException(
                'No wall found for id ' . $id
            );
        }

        dump($wall);

        $form = $this->createFormBuilder($wall)
            ->add('Delete', 'submit')
            ->add('Cancel', 'button')
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
