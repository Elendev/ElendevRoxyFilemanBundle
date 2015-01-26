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


class DownloadableFile implements DownloadableFileInterface {

    private $contentType;

    private $filename;

    private $callback;

    public function __construct($callback = null, $contentType = 'text/plain', $filename = null) {
        $this->callback = $callback;
        $this->contentType = $contentType;
        $this->filename = $filename;
    }

    /**
     * @return string content type (image/jpg, ...)
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return function used as callback in a StreamedResponse
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param null $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }
}