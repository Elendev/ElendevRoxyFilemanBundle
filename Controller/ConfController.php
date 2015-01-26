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
use Symfony\Component\HttpFoundation\JsonResponse;

class ConfController extends Controller
{
    public function confAction()
    {
        $response = new JsonResponse();

        $response->setData(array(
            'FILES_ROOT'=>          $this->getParameter('files_root'),
            'RETURN_URL_PREFIX'=>   $this->getParameter('return_url_prefix'),
            'SESSION_PATH_KEY'=>    $this->getParameter('session_path_key'),
            'THUMBS_VIEW_WIDTH'=>   $this->getParameter('thumbs_view_width'),
            'THUMBS_VIEW_HEIGHT'=>  $this->getParameter('thumbs_view_height'),
            'PREVIEW_THUMB_WIDTH'=> $this->getParameter('preview_thumb_width'),
            'PREVIEW_THUMB_HEIGHT'=>$this->getParameter('preview_thumb_height'),
            'MAX_IMAGE_WIDTH'=>     $this->getParameter('max_image_width'),
            'MAX_IMAGE_HEIGHT'=>    $this->getParameter('max_image_height'),
            'INTEGRATION'=>         $this->getParameter('integration'),
            'DIRLIST'=>             $this->generateUrl($this->getParameter('dirlist_route')),
            'CREATEDIR'=>           $this->generateUrl($this->getParameter('createdir_route')),
            'DELETEDIR'=>           $this->generateUrl($this->getParameter('deletedir_route')),
            'MOVEDIR'=>             $this->generateUrl($this->getParameter('movedir_route')),
            'COPYDIR'=>             $this->generateUrl($this->getParameter('copydir_route')),
            'RENAMEDIR'=>           $this->generateUrl($this->getParameter('renamedir_route')),
            'FILESLIST'=>           $this->generateUrl($this->getParameter('fileslist_route')),
            'UPLOAD'=>              $this->generateUrl($this->getParameter('upload_route')),
            'DOWNLOAD'=>            $this->generateUrl($this->getParameter('download_route')),
            'DOWNLOADDIR'=>         $this->generateUrl($this->getParameter('downloaddir_route')),
            'DELETEFILE'=>          $this->generateUrl($this->getParameter('deletefile_route')),
            'MOVEFILE'=>            $this->generateUrl($this->getParameter('movefile_route')),
            'COPYFILE'=>            $this->generateUrl($this->getParameter('copyfile_route')),
            'RENAMEFILE'=>          $this->generateUrl($this->getParameter('renamefile_route')),
            'GENERATETHUMB'=>       $this->generateUrl($this->getParameter('generatethumb_route')),
            'DEFAULTVIEW'=>         $this->getParameter('defaultview'),
            'FORBIDDEN_UPLOADS'=>   $this->getParameter('forbidden_uploads'),
            'ALLOWED_UPLOADS'=>     $this->getParameter('allowed_uploads'),
            'FILEPERMISSIONS'=>     $this->getParameter('filepermissions'),
            'DIRPERMISSIONS'=>      $this->getParameter('dirpermissions'),
            'LANG'=>                $this->getParameter('lang'),
            'DATEFORMAT'=>          $this->getParameter('dateformat'),
            'OPEN_LAST_DIR'=>       $this->getParameter('open_last_dir')
        ));

        return $response;
    }

    private function getParameter($parameter){
        return $this->container->getParameter('elendev_roxyfileman.conf.' . $parameter);
    }
}
