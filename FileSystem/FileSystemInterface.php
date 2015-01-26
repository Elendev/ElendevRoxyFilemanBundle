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


interface FileSystemInterface {

    /**
     * Return the directory tree in the form of a list
     * @return DirectoryInterface[]
     */
    public function getDirectoryTreeList();


    /**
     * @param $path
     * @param $directoryName
     * @return StandardResponseInterface
     */
    public function createDirectory($path, $directoryName);

    /**
     * @param $path of the directory to remove
     * @return StandardResponseInterface
     */
    public function deleteDirectory($path);

    /**
     * @param $origin Path of the origin directory
     * @param $destinationDirectoryPath Destination directory withouth directory name
     * @return StandardResponseInterface
     */
    public function moveDirectory($origin, $destinationDirectoryPath);

    /**
     * @param $origin directory
     * @param $destination directory
     * @return StandardResponseInterface
     */
    public function copyDirectory($origin, $destination);

    /**
     * @param $origin
     * @param $newName of the directory
     * @return StandardResponseInterface
     */
    public function renameDirectory($origin, $newName);

    /**
     * @param $directory
     * @param string $type generally one of image|files|pdf
     * @return FileInterface[]
     */
    public function getFilesList($directory, $type = null);

    /**
     * @param $destinationDirectory
     * @param $files array of \SplFileInfo
     * @return StandardResponseInterface
     */
    public function upload($destinationDirectory, $files);

    /**
     * @param $file path
     * @return DownloadableFileInterface
     */
    public function download($file);

    /**
     * @param $directory
     * @return DownloadableFileInterface zip of the directory content
     */
    public function downloadDirectory($directory);

    /**
     * @param $file
     * @return StandardResponseInterface
     */
    public function deleteFile($file);

    /**
     * @param $origin file path
     * @param $destination new file path
     * @return StandardResponseInterface
     */
    public function moveFile($origin, $destination);

    /**
     * @param $origin file path
     * @param $destinationDirectory destination directory path
     * @return StandardResponseInterface
     */
    public function copyFile($origin, $destinationDirectory);

    /**
     * @param $file
     * @param $newName new filename
     * @return StandardResponseInterface
     */
    public function renameFile($file, $newName);

    /**
     * @param $file path
     * @param $width of the generated thumbnail
     * @param $height of the generated thumbnail
     * @return DownloadableFileInterface
     */
    public function thumbnail($file, $width, $height);
}