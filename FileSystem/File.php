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


class File implements FileInterface {

    private $path;

    private $size;

    private $lastModificationTimestamp;

    private $height;

    private $width;

    public function __construct($path = null, $size = null, $lastModificationTimestamp = null, $height = null, $width = null){
        $this->path = $path;
        $this->size = $size;
        $this->lastModificationTimestamp = $lastModificationTimestamp;
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @return file path with name and extension
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return file size in bytes
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return last modification timestamp
     */
    public function getLastModificationTimestamp()
    {
        return $this->lastModificationTimestamp;
    }

    /**
     * @return if it's an image, its height, 0 otherwise
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return if it's an image, its width, 0 otherwise
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param mixed $lastModificationTimestamp
     */
    public function setLastModificationTimestamp($lastModificationTimestamp)
    {
        $this->lastModificationTimestamp = $lastModificationTimestamp;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }


}