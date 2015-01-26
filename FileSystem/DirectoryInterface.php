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


interface DirectoryInterface {

    /**
     * @return Path of the directory
     */
    public function getPath();

    /**
     * @return Number of files in the directory
     */
    public function getFilesQuantity();

    /**
     * @return Number of subdirectories in the directory
     */
    public function getSubdirectoriesQuantity();
}