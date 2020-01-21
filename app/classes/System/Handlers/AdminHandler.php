<?php namespace System\Handlers;

use Composer\Autoload\ClassLoader;


class AdminHandler extends BaseHandler
{



    protected function dashboard()
    {
        if($this->session->keyExists('admin')){


        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'Admin Dashboard',
            'errors' => $this->errors,
        ]);
    }
}