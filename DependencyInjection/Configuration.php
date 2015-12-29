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

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elendev_roxy_fileman');

        $rootNode
            ->children()
                ->arrayNode('profiles')
                ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('file_system_service_id')->defaultNull()->end()
                            ->append($this->createLocalFilesystem())
                            ->append($this->createConf())
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('roxyfileman_lib_path')
                    ->defaultNull()
                ->end()
                ->scalarNode('file_system_service_id')
                    ->defaultNull()
                ->end()
                ->append($this->createLocalFilesystem())
                ->append($this->createConf())
            ->end();

        return $treeBuilder;
    }

    private function createLocalFilesystem(){
        return $this->createNode('local_file_system')
                ->children()
                    ->scalarNode('base_path')
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('base_url')
                        ->cannotBeEmpty()
                    ->end()
                ->end();
    }

    private function createConf(){
        return $this->createNode('conf')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('files_root')->defaultNull()->end()
                ->scalarNode('return_url_prefix')->defaultNull()->end()
                ->scalarNode('session_path_key')->defaultNull()->end()
                ->integerNode('thumbs_view_width')
                    ->defaultValue(140)
                    ->min(50)
                    ->max(300)
                ->end()
                ->integerNode('thumbs_view_height')
                    ->defaultValue(120)
                    ->min(50)
                    ->max(300)
                ->end()
                ->integerNode('preview_thumb_width')
                    ->defaultValue(200)
                    ->min(50)
                    ->max(400)
                ->end()
                ->integerNode('preview_thumb_height')
                    ->defaultValue(200)
                    ->min(50)
                    ->max(400)
                ->end()
                ->integerNode('max_image_width')
                    ->defaultValue(2000)
                    ->min(50)
                    ->max(4000)
                ->end()
                ->integerNode('max_image_height')
                    ->defaultValue(2000)
                    ->min(50)
                    ->max(4000)
                ->end()
                ->enumNode('integration')
                    ->values(array('ckeditor', 'tinymce3', 'tinymce4', 'custom'))
                    ->defaultValue('ckeditor')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('dirlist_route')
                    ->defaultValue('elendev_roxyfileman_dir_list')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('createdir_route')
                    ->defaultValue('elendev_roxyfileman_create_dir')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('deletedir_route')
                    ->defaultValue('elendev_roxyfileman_delete_dir')
                    ->cannotBeEmpty()
                ->end()
                    ->scalarNode('movedir_route')
                    ->defaultValue('elendev_roxyfileman_move_dir')
                ->cannotBeEmpty()
                ->end()
                ->scalarNode('copydir_route')
                    ->defaultValue('elendev_roxyfileman_copy_dir')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('renamedir_route')
                    ->defaultValue('elendev_roxyfileman_rename_dir')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('fileslist_route')
                    ->defaultValue('elendev_roxyfileman_file_list')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('upload_route')
                    ->defaultValue('elendev_roxyfileman_upload')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('download_route')
                    ->defaultValue('elendev_roxyfileman_download')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('downloaddir_route')
                    ->defaultValue('elendev_roxyfileman_download_dir')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('deletefile_route')
                    ->defaultValue('elendev_roxyfileman_delete_file')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('movefile_route')
                    ->defaultValue('elendev_roxyfileman_move_file')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('copyfile_route')
                    ->defaultValue('elendev_roxyfileman_copy_file')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('renamefile_route')
                    ->defaultValue('elendev_roxyfileman_rename_file')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('generatethumb_route')
                    ->defaultValue('elendev_roxyfileman_generate_thumb')
                    ->cannotBeEmpty()
                ->end()
                ->enumNode('defaultview')
                    ->values(array('list', 'thumb'))
                    ->defaultValue('list')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('forbidden_uploads')
                    ->defaultValue('zip js jsp jsb mhtml mht xhtml xht php phtml php3 php4 php5 phps shtml jhtml pl sh py cgi exe application gadget hta cpl msc jar vb jse ws wsf wsc wsh ps1 ps2 psc1 psc2 msh msh1 msh2 inf reg scf msp scr dll msi vbs bat com pif cmd vxd cpl htpasswd htaccess')
                ->end()
                ->scalarNode('allowed_uploads')
                    ->defaultNull()
                ->end()
                ->scalarNode('filepermissions')
                    ->defaultValue('0644')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('dirpermissions')
                    ->defaultValue('0644')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('lang')
                    ->defaultValue('auto')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('dateformat')
                    ->defaultValue('dd/MM/yyyy HH:mm')
                    ->cannotBeEmpty()
                ->end()
                ->booleanNode('open_last_dir')
                    ->defaultValue(true)
                ->end()
            ->end();
    }

    /**
     * Creates a node.
     *
     * @param string $name The node name.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node.
     */
    protected function createNode($name)
    {
        return $this->createTreeBuilder()->root($name);
    }

    /**
     * Creates a tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder.
     */
    protected function createTreeBuilder()
    {
        return new TreeBuilder();
    }
}
