<?php
/**
 * This file is part of the Roxyfileman Bundle
 *
 * (c) Jonas Renaudot <jonas.renaudot@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this code source
 */

namespace Elendev\RoxyFilemanBundle\FileSystem;


interface DownloadableFileInterface {

    /**
     * @return string content type (image/jpg, ...)
     */
    public function getContentType();

    /**
     * @return string filename
     */
    public function getFilename();

    /**
     * @return function used as callback in a StreamedResponse
     */
    public function getCallback();

}