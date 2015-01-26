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


class Directory implements DirectoryInterface{

    private $path;

    private $filesQuantity;

    private $subdirectoriesQuantity;

    public function __construct($path = null, $filesQuantity = null, $subdirectoriesQuantity = null){
        $this->path = $path;
        $this->filesQuantity = $filesQuantity;
        $this->subdirectoriesQuantity = $subdirectoriesQuantity;
    }

    /**
     * @return Path of the directory
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return Number of files in the directory
     */
    public function getFilesQuantity()
    {
        return $this->filesQuantity;
    }

    /**
     * @return Number of subdirectories in the directory
     */
    public function getSubdirectoriesQuantity()
    {
        return $this->subdirectoriesQuantity;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param mixed $filesQuantity
     */
    public function setFilesQuantity($filesQuantity)
    {
        $this->filesQuantity = $filesQuantity;
    }

    /**
     * @param mixed $subdirectoriesQuantity
     */
    public function setSubdirectoriesQuantity($subdirectoriesQuantity)
    {
        $this->subdirectoriesQuantity = $subdirectoriesQuantity;
    }

}