<?php namespace System\Handlers;

/**
 * Class HomeHandler
 * @package System\Handlers
 */
class HomeHandler extends BaseHandler
{
    protected function index(){

        if ($this->session->keyExists('user')){
            header('Location: dashboard');
            exit;
        } elseif ($this->session->keyExists('admin')){
            header('Location: admin/dashboard');
        }

        $this->renderTemplate([
            'pageTitle' => 'Home',
            'errors' => $this->errors
        ]);
    }
}