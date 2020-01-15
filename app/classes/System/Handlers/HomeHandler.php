<?php namespace System\Handlers;

/**
 * Class HomeHandler
 * @package System\Handlers
 */
class HomeHandler extends BaseHandler
{
    protected function index(){
        $this->renderTemplate([
            'pageTitle' => 'Home',
            'errors' => $this->errors
        ]);
    }
}