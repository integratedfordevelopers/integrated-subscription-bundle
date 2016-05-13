<?php

/*
 * This file is part of the Integrated package.
 *
 * (c) e-Active B.V. <integrated@e-active.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Integrated\Bundle\SubscriptionBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl> and Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class IntegratedSubscriptionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $mapping = [
            __DIR__ . '/Resources/config/mapping/doctrine/' => 'Integrated\\Bundle\\SubscriptionBundle\\Model'
        ];

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mapping));

    }
}
