<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct() {
        $this->response();
    }

    private function response() {
        return array(
            'Not found',
            404
        );
    }
}
