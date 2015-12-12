<?php
/**
 * This file is part of the Roxyfileman Bundle
 *
 * (c) Jonas Renaudot <jonas.renaudot@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this code source
 */

namespace Elendev\RoxyFilemanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourcesController extends Controller
{
    public function resourceAction($file, $profile = null) {

        $filePath = $this->container->getParameter('elendev_roxyfileman.roxyfileman_library_path') . '/' . $file;

        if(!is_file($filePath)){
            throw $this->createNotFoundException();
        }

        $response = new BinaryFileResponse($filePath);

        $extension = explode('.', $file);
        $extension = array_pop($extension);

        if($extension == 'css'){
            $response->headers->set('Content-Type', 'text/css');
        } else if($extension == 'js'){
            $response->headers->set('Content-Type', 'text/javascript');
        } else if($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'jpeg'){
            $response->headers->set('Content-Type', 'image/' . $extension);
        }

        return $response;
    }

}
