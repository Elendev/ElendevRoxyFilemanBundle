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


interface FileInterface {

    /**
     * @return file path with name and extension
     */
    public function getPath();

    /**
     * @return file size in bytes
     */
    public function getSize();

    /**
     * @return last modification timestamp
     */
    public function getLastModificationTimestamp();

    /**
     * @return if it's an image, its height, 0 otherwise
     */
    public function getHeight();

    /**
     * @return if it's an image, its width, 0 otherwise
     */
    public function getWidth();
}