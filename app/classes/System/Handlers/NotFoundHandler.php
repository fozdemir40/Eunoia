<?php namespace System\Handlers;

/**
 * Class NotFoundHandler
 * @package System\Handlers
 */
class NotFoundHandler extends BaseHandler
{
    protected function index()
    {
        $this->renderTemplate([
            'pageTitle' => "404 - Pagina niet gevonden"
        ]);
    }
}