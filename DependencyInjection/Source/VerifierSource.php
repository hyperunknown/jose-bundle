<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2016 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\JoseBundle\DependencyInjection\Source;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class VerifierSource implements SourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'verifiers';
    }

    /**
     * {@inheritdoc}
     */
    public function createService($name, array $config, ContainerBuilder $container)
    {
        $service_id = sprintf('jose.verifier.%s', $name);
        $definition = new Definition('Jose\Verifier');
        $definition->setFactory([
            new Reference('jose.factory.service'),
            'createVerifier',
        ]);
        $definition->setArguments([
            $config['algorithms'],
            null === $config['logger'] ? null : new Reference($config['logger']),
        ]);

        $container->setDefinition($service_id, $definition);
    }

    /**
     * {@inheritdoc}
     */
    public function addConfigurationSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('verifiers')
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
            ->arrayNode('algorithms')->isRequired()->prototype('scalar')->end()->end()
            ->scalarNode('logger')->defaultNull()->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }
}
