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

use Elendev\RoxyFilemanBundle\FileSystem\FileSystemInterface;
use Elendev\RoxyFilemanBundle\FileSystem\LocalFileSystem;
use Elendev\RoxyFilemanBundle\FileSystem\StandardResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DirectoryController extends Controller
{
    public function dirListAction()
    {
        $directories = $this->getFileSystem()->getDirectoryTreeList();

        $output = array();

        foreach($directories as $directory){
            $output[] = array(
                'p' => $directory->getPath(),
                'f' => $directory->getFilesQuantity(),
                'd' => $directory->getSubdirectoriesQuantity()
            );
        }

        $response = new JsonResponse($output);
        return $response;
    }

    public function createDirAction(Request $request)
    {
        $path = $request->query->get('d');
        $directoryName = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->createDirectory($path, $directoryName)
        );
    }

    public function deleteDirAction(Request $request)
    {
        $path = $request->query->get('d');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->deleteDirectory($path)
        );

    }

    public function moveDirAction(Request $request)
    {
        $origin = $request->query->get('d');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->moveDirectory($origin, $destination)
        );
    }

    public function copyDirAction(Request $request)
    {
        $origin = $request->query->get('d');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->copyDirectory($origin, $destination)
        );
    }

    public function renameDirAction(Request $request)
    {
        $origin = $request->query->get('d');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->renameDirectory($origin, $destination)
        );
    }

    public function fileListAction(Request $request)
    {
        $files = $this->getFileSystem()->getFilesList($request->query->get('d'));

        $output = array();

        foreach($files as $file){
            $output[] = array(
                'p' => $file->getPath(),
                's' => $file->getSize(),
                't' => $file->getLastModificationTimestamp(),
                'w' => $file->getWidth(),
                'h' => $file->getHeight()
            );
        }

        $response = new JsonResponse($output);
        return $response;
    }

    public function uploadAction(Request $request)
    {
        $origin = $request->request->get('d');
        $files = $request->files->get('files');

        if(!is_array($files)){
            $files = array($files);
        }

        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->upload($origin, $files)
        );
    }

    public function downloadAction(Request $request)
    {
        $origin = $request->query->get('f');
        $result = $this->getFileSystem()->download($origin);

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $result->getContentType());
        $response->headers->set('Content-Disposition', ResponseHeaderBag::DISPOSITION_ATTACHMENT . '; filename=' . $result->getFilename());
        $response->setCallback($result->getCallback());

        return $response;
    }

    public function downloadDirAction(Request $request)
    {
        $origin = $request->query->get('d');
        $result = $this->getFileSystem()->downloadDirectory($origin);

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $result->getContentType());
        $response->headers->set('Content-Disposition', ResponseHeaderBag::DISPOSITION_ATTACHMENT . '; filename=' . $result->getFilename());
        $response->setCallback($result->getCallback());

        return $response;
    }

    public function deleteFileAction(Request $request)
    {
        $origin = $request->query->get('f');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->deleteFile($origin)
        );
    }

    public function moveFileAction(Request $request)
    {
        $origin = $request->query->get('f');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->moveFile($origin, $destination)
        );
    }

    public function copyFileAction(Request $request)
    {
        $origin = $request->query->get('f');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->copyFile($origin, $destination)
        );
    }

    public function renameFileAction(Request $request)
    {
        $origin = $request->query->get('f');
        $destination = $request->query->get('n');
        return $this->standardResponseToHTTPResponse(
            $this->getFileSystem()->renameFile($origin, $destination)
        );
    }

    public function generateThumbAction(Request $request)
    {
        $fileName = $request->query->get('f');
        $width = $request->query->get('width', 200);
        $height = $request->query->get('height', 200);

        $downloadableFile = $this->getFileSystem()->thumbnail($fileName, $width, $height);

        $response = new StreamedResponse($downloadableFile->getCallback());
        $response->headers->set('Content-Type', $downloadableFile->getContentType());

        return $response;
    }


    /**
     * @return FileSystemInterface
     */
    private function getFileSystem() {
        //$fileSystem = new LocalFileSystem('/var/www/tmpArticles', '/tmpArticles');

        return $this->get('elendev_roxy_fileman.file_system');
    }

    private function standardResponseToHTTPResponse(StandardResponse $response){
        $data = array(
            'res' => $response->isSuccess() ? 'ok' : 'error',
            'msg' => $response->getErrorMessage()
        );

        return new JsonResponse($data);
    }
}
