<?php
/**
 * This file is part of the Roxyfileman Bundle
 *
 * (c) Jonas Renaudot <jonas.renaudot@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this code source
 */

namespace Elendev\RoxyFilemanBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ElendevRoxyFilemanExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach($config['conf'] as $key => $value){
            $container->setParameter('elendev_roxyfileman.conf.' . $key, $value);
        }



        //Alias correct file system service if one is specified
        if(!empty($config['file_system_service_id'])){
            $container->setAlias('elendev_roxy_fileman.file_system', $config['file_system_service_id']);
            $container->removeDefinition('elendev_roxy_fileman.local_file_system');
        } else {

            if(empty($config['local_file_system']) || empty($config['local_file_system']['base_path']) || empty($config['local_file_system']['base_url'])) {
                throw new InvalidConfigurationException('local_file_system.base_path and local_file_system.base_url have to be defined if file_system_service_id is empty in elendev_roxyfileman configuration');
            }

            $container->setParameter('elendev_roxyfileman.local_file_system.base_path', $config['local_file_system']['base_path']);
            $container->setParameter('elendev_roxyfileman.local_file_system.base_url', $config['local_file_system']['base_url']);
        }



        //set path to roxyfileman library, default one if no library is set
        if(empty($config['roxyfileman_lib_path'])) {
            $libPath = __DIR__ . '/../Resources/lib/roxyfileman';
        } else {
            $libPath = $config['roxyfileman_lib_path'];
        }

        $container->setParameter('elendev_roxyfileman.roxyfileman_library_path', $libPath);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
