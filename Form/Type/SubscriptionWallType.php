<?php

/*
 * This file is part of the Integrated package.
 *
 * (c) e-Active B.V. <integrated@e-active.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Integrated\Bundle\SubscriptionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl>
 * @author Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');

        $builder->add('teaser', 'textarea',
            ['label' => 'Teaser']
        );

        $builder->add('disabled', 'checkbox',
            ['required' => false]
        );

        $builder->add('freeTier', 'integer',
            ['required' => false]
        );

        if(isset($options["attr"]["selectedChannelNames"])) {
            $builder->add('channel', 'choice',
                [
                    'choices' => $options["attr"]["channelNames"],
                    'multiple' => true,
                    'expanded' => true,
                    'mapped' => false,
                    'data' => $options["attr"]["selectedChannelNames"]
                ]
            );
        } else {
            $builder->add('channel', 'choice',
                [
                    'choices' => $options["attr"]["channelNames"],
                    'multiple' => true,
                    'expanded' => true,
                    'mapped' => false
                ]
            );
        }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'theme' => 'default',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'integrated_subscription_wall';
    }
}
