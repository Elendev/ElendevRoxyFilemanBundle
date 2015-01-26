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


class StandardResponse implements StandardResponseInterface {

    private $success;

    private $errorMessage;

    public function __construct($success = true, $errorMessage = null){
        $this->success = $success;
        $this->errorMessage = $errorMessage;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}