# README

The bundle provide a [Roxyfileman](http://www.roxyfileman.com/) integration for Symfony2. It works well with [IvoryCKEditorBundle](https://github.com/egeloen/IvoryCKEditorBundle).

## Documentation

 1. [Installation](#installation)
 2. [Configuration](#configuration)
   1. [File location configuration](#file-location-configuration)
   2. [Roxyfileman configuration](#roxyfileman-configuration)
   3. [Multiple profiles](#multiple-profiles)
 3. [Advanced customization](#advanced-customization)
   1. [Custom filesystem service](#custom-filesystem-service)
   2. [Custom version of Roxyfileman](#custom-version-of-roxyfileman)
 4. [LICENSE](#license)
 
## Installation
Require the bundle in your composer.json file:

``` json
    {
        "require": {
            "elendev/roxyfileman-bundle": "~1.0"
        }
    }
```

Register the bundle :

``` php
    // app/AppKernel.php
    
    public function registerBundles()
    {
        return array(
            new Elendev\RoxyFilemanBundle\ElendevRoxyFilemanBundle(),
            // ...
        );
    }
```

Update composer :

```
    $ composer update
```

Import the bundle's routes to your routing configuration file, e.g. `routing.yml`:

```
ElendevRoxyFilemanBundle:
    resource: "@ElendevRoxyFilemanBundle/Resources/config/routing.yml"
    prefix:   /elendev-roxyfileman
```

The prefix can be changed. You can also add the path to the firewall to have the file manager service protected.  
 
## Configuration
RoxyFilemanBundle provide a simple configuration.

### File location configuration

If you use the default `LocalFileSystem` (recommanded), this is the **required configuration** :

``` yaml
    elendev_roxy_fileman:
        local_file_system:
            base_path: /path/to/your/file
            base_url: /url/to/the/base/path
```

The `base_path` parameter should be absolute. The `base_url` parameter is appended to the file name / relative file path to create its url.
The `LocalFileSystem` is used to access to a certain directory in the local file system. If you want to serve file from a distant server or located in database, you can take a look at the [Custom filesystem service](#custom-filesystem-service) section.

### Roxyfileman configuration
Every configuration options are available on the [Roxyfileman configuration page](http://www.roxyfileman.com/install).
``` yaml
    elendev_roxy_fileman:
        conf:
            dirlist_route: elendev_roxyfileman_dir_list
            files_root: ...
            
```

The parameters have to be in lowercase.
**Be careful** : every url parameter available on the [Roxyfileman configuration page](http://www.roxyfileman.com/install) should be used as a route here and the parameter have to be postfixed by `_route`. For example : the parameter `DIRLIST` becomes `dirlist_route`.


### Multiple profiles

Above shows how the bundle work in single profile mode. Occasionally, you may need different file manager instances to manage different directories - imagine a CMS with a "album" and a "blog" module, and you don't want the "album" administrator to touch the files in the "blog" module. This is possible by telling the bundle to operate in multi-profile mode. Here's how:

``` yaml
    elendev_roxy_fileman:
        profiles: # Triggers multi-profile mode
            album: # Name of the profile
                local_file_system:
                    base_path: /path/to/album/directory
                    base_url: /web/album/directory
                conf:
                    integration: tinymce4
            blog:
                local_file_system:
                    base_path: /path/to/blog/directory
                    base_url: /web/blog/directory
                conf:
                    integration: tinymce4
            
```

Now we have two profiles defined, each with its own base path, URL settings, and configuration options.

The bundle needs to know which profile it should work on when its certain URL is accessed. One way is to add the `profile` placeholder to the routing config:

``` yaml
    ElendevRoxyFilemanBundle:
        resource: "@ElendevRoxyFilemanBundle/Resources/config/routing.yml"
        prefix:   /elendev-roxyfileman/{profile}
        requirements:
            profile: blog|album
```

**Note:** When `profiles` is not empty, the bundle will operate in multi-profile mode. `conf`, `local_file_system` and `file_system_service_id` values defined in the root configuration will be ignored.

### Integration with rich text editor (CKEditor)

The original index path `/fileman/index.html` is served by the route `elendev_roxyfileman_index` in this bundle, and is what you need to integrate with rich text editors like CKEditor. For example:

```
<script> 
$(function(){
   CKEDITOR.replace( 'editor1', {
        // Single profile mode
        filebrowserBrowseUrl: '{{ path('elendev_roxyfileman_index') }}',
        // To specify the profile name in multi-profile mode:
        // filebrowserBrowseUrl: '{{ path('elendev_roxyfileman_index', { 'profile': 'blog' }) }}',
        filebrowserImageBrowseUrl: '{{ path('elendev_roxyfileman_index') }}?type=image',
        removeDialogTabs: 'link:upload;image:upload'
   }); 
});
 </script>
```

Using this bundle with `egeloen/IvoryCKEditorBundle` is really simple, a small modification to the `ivory_ck_editor` configuration do the job :
```
ivory_ck_editor:
    default_config: default
    configs:
        default:
            filebrowserBrowseRoute: elendev_roxyfileman_index
```

## Advanced customization

### Custom filesystem service
The `filesystem` service represent a file system for Roxyfileman. It is capable of serving files, file and directory trees, do operations on directories and files, ...
You can create a custom filesystem service by implementing the `Elendev\RoxyFilemanBundle\FileSystem\FileSystemInterface` and provide it as a service to the `elendev_roxy_fileman` parameter.

``` yaml
    elendev_roxy_fileman:
        file_system_service_id: id_of_the_file_service
```

### Custom version of Roxyfileman
The bundle comes with a version of Roxyfileman library. If you want to use a custom version, you can specify the path to the directory containing the `index.html` file to the `roxyfileman_lib_path` parameter.
``` yaml
    elendev_roxy_fileman:
        roxyfileman_lib_path: /path/to/the/library
``` 
The library files are served by the `Elendev\RoxyFilemanBundle\Controller\ResourcesController.php` controller. It don't have to be publicly accessible.

## LICENCE
The Elendev RoxyFileman BUndle is under the MIT license. For the full copyright and license information, please read the [LICENSE](LICENSE) file that was distributed with this source code.

A partial copy of [Roxyfileman](http://www.roxyfileman.com) library is bundled with this bundle. The [Roxyfileman](http://www.roxyfileman.com) library is under the [GPLv3](Resources/doc/licenses/gpl-3.0.txt) license. A copy of the [GPLv3](Resources/doc/licenses/gpl-3.0.txt) license was distributed with this source code.
