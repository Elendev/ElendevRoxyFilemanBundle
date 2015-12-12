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
    public function confAction($profile = null)
    {
        $response = new JsonResponse();

        $response->setData(array(
            'FILES_ROOT'=>          $this->getProfileParameter($profile, 'files_root'),
            'RETURN_URL_PREFIX'=>   $this->getProfileParameter($profile, 'return_url_prefix'),
            'SESSION_PATH_KEY'=>    $this->getProfileParameter($profile, 'session_path_key'),
            'THUMBS_VIEW_WIDTH'=>   $this->getProfileParameter($profile, 'thumbs_view_width'),
            'THUMBS_VIEW_HEIGHT'=>  $this->getProfileParameter($profile, 'thumbs_view_height'),
            'PREVIEW_THUMB_WIDTH'=> $this->getProfileParameter($profile, 'preview_thumb_width'),
            'PREVIEW_THUMB_HEIGHT'=>$this->getProfileParameter($profile, 'preview_thumb_height'),
            'MAX_IMAGE_WIDTH'=>     $this->getProfileParameter($profile, 'max_image_width'),
            'MAX_IMAGE_HEIGHT'=>    $this->getProfileParameter($profile, 'max_image_height'),
            'INTEGRATION'=>         $this->getProfileParameter($profile, 'integration'),
            'DIRLIST'=>             $this->generateUrl($this->getProfileParameter($profile, 'dirlist_route'), array('profile' => $profile)),
            'CREATEDIR'=>           $this->generateUrl($this->getProfileParameter($profile, 'createdir_route'), array('profile' => $profile)),
            'DELETEDIR'=>           $this->generateUrl($this->getProfileParameter($profile, 'deletedir_route'), array('profile' => $profile)),
            'MOVEDIR'=>             $this->generateUrl($this->getProfileParameter($profile, 'movedir_route'), array('profile' => $profile)),
            'COPYDIR'=>             $this->generateUrl($this->getProfileParameter($profile, 'copydir_route'), array('profile' => $profile)),
            'RENAMEDIR'=>           $this->generateUrl($this->getProfileParameter($profile, 'renamedir_route'), array('profile' => $profile)),
            'FILESLIST'=>           $this->generateUrl($this->getProfileParameter($profile, 'fileslist_route'), array('profile' => $profile)),
            'UPLOAD'=>              $this->generateUrl($this->getProfileParameter($profile, 'upload_route'), array('profile' => $profile)),
            'DOWNLOAD'=>            $this->generateUrl($this->getProfileParameter($profile, 'download_route'), array('profile' => $profile)),
            'DOWNLOADDIR'=>         $this->generateUrl($this->getProfileParameter($profile, 'downloaddir_route'), array('profile' => $profile)),
            'DELETEFILE'=>          $this->generateUrl($this->getProfileParameter($profile, 'deletefile_route'), array('profile' => $profile)),
            'MOVEFILE'=>            $this->generateUrl($this->getProfileParameter($profile, 'movefile_route'), array('profile' => $profile)),
            'COPYFILE'=>            $this->generateUrl($this->getProfileParameter($profile, 'copyfile_route'), array('profile' => $profile)),
            'RENAMEFILE'=>          $this->generateUrl($this->getProfileParameter($profile, 'renamefile_route'), array('profile' => $profile)),
            'GENERATETHUMB'=>       $this->generateUrl($this->getProfileParameter($profile, 'generatethumb_route'), array('profile' => $profile)),
            'DEFAULTVIEW'=>         $this->getProfileParameter($profile, 'defaultview'),
            'FORBIDDEN_UPLOADS'=>   $this->getProfileParameter($profile, 'forbidden_uploads'),
            'ALLOWED_UPLOADS'=>     $this->getProfileParameter($profile, 'allowed_uploads'),
            'FILEPERMISSIONS'=>     $this->getProfileParameter($profile, 'filepermissions'),
            'DIRPERMISSIONS'=>      $this->getProfileParameter($profile, 'dirpermissions'),
            'LANG'=>                $this->getProfileParameter($profile, 'lang'),
            'DATEFORMAT'=>          $this->getProfileParameter($profile, 'dateformat'),
            'OPEN_LAST_DIR'=>       $this->getProfileParameter($profile, 'open_last_dir')
        ));

        return $response;
    }

    protected function getProfileParameter($profile, $parameter){
        if ($profile === null) {
            return $this->container->getParameter('elendev_roxyfileman.conf.' . $parameter);
        }
        return $this->container->getParameter('elendev_roxyfileman.'. $profile .'.conf.' . $parameter);
    }
}
