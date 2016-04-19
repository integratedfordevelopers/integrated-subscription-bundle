<?php
/**
 * Created by PhpStorm.
 * User: Albert-David
 * Date: 19-04-16
 * Time: 12:42
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionWall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;


class SubscriptionWallController
{
    public function addAction(Request $request) {

        $wall = new SubscriptionWall();

        $form = $this->createFormBuilder($wall)
            ->add('name', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wall);
            $em->flush();
            return new Response('Wall added successfuly');
        }

        $build['form'] = $form->createView();
        return $this->render('SubscriptionBundle:SubscriptionWall:wall_add.html.twig', $build);
    }
}