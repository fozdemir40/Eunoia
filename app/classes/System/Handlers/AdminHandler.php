<?php namespace System\Handlers;

use Composer\Autoload\ClassLoader;
use System\Availabilities\AvailabilitiesCollection;
use System\Availabilities\Availability;
use System\Databases\Database;


class AdminHandler extends BaseHandler
{

    private $db;

    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }


    protected function dashboard()
    {
        if($this->session->keyExists('admin')){
            $allBookings = new AvailabilitiesCollection();
            $allBookings->add(Availability::getAllTaken($this->db));


        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'Admin Dashboard',
            'bookings' => $allBookings->get(),
            'errors' => $this->errors,
        ]);
    }

    protected function history()
    {

    }
}