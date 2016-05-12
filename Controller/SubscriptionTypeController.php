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

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl> and Albert David Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionTypeController extends Controller
{

    /**
     * Creates a type
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {

        $type = new SubscriptionType();

        $form = $this->createFormBuilder($type)
            ->add('name', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            return new Response('Type added successfuly');
        }

        $build['form'] = $form->createView();
        return $this->render('IntegratedSubscriptionBundle:Type:create.html.twig', $build);
    }
}