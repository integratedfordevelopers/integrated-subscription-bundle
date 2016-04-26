<?php
/**
 * Created by PhpStorm.
 * User: Albert-David
 * Date: 19-04-16
 * Time: 12:42
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;

class SubscriptionTypeController extends Controller
{
    public function createAction(Request $request) {

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