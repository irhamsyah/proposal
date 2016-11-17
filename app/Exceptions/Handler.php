<?php namespace app\Exceptions;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler {

    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException)
        {
            // Custom logic for model not found...
        }

        return parent::render($request, $e);
    }

}
