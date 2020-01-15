<?php namespace System\Handlers;


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
            'errors' => $this->errors
        ]);
    }
}