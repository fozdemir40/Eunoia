<?php namespace System\Handlers;


use System\Databases\Database;
use System\Form\Data;
use System\Availabilities\Availability;
use System\Availabilities\AvailabilitiesCollection;

class AvailabilityHandler extends BaseHandler
{
    use AvailabilityFillAndValidate;
    /**
     * @var \PDO
     */
    private $db;

    private $formData;

    private $availability;

    /**
     * AvailabilityHandler constructor.
     * @param $templateName
     * @throws \ReflectionException
     */
    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }

    protected function add()
    {
        if(!$this->session->keyExists('admin')){
            header('Location: notfound');
            exit;
        }

        $this->availability = new Availability();
        $this->executePostHandler();

        if(isset($this->formData) && empty($this->errors)){
            if(Availability::add($this->availability, $this->db)){
                $success = "Nieuwe datum toegevoegd";
                $this->availability = new Availability();
            } else {
                $this->logger->error(new \Exception("DB error: {$this->db->errorInfo()}"));
                $this->errors[] = "There was an error with adding the new availability";
            }
        }

        $this->renderTemplate([
            'pageTitle' => 'Beschikbaarheid toevoegen',
            'availability' => $this->availability ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit()
    {
        if(!$this->session->keyExists('admin')){
            header('Location: notfound');
            exit;
        }

        try{
            $this->availability = Availability::getById($_GET['id'], $this->db);
            $this->executePostHandler();

            if(isset($this->formData) && empty($this->errors)){
                if($this->availability->update($this->db)){
                    header('Location: calendar');
                    $_SESSION['msg'] = 'Beschikbaarheid is succesvol gewijzigd!';
                    exit;
                } else {
                    $this->logger->error(new \Exception("DB Error: {$this->db->errorInfo()}"));
                    $this->errors[] = "Whoops! Een server probleem is ontstaan";
                }
            }


        } catch (\Exception $e){
            $this->logger->error($e);
            $this->errors[] = "Whoops: " . $e->getMessage();
            $pageTitle = 'Album does\'t exist';
        }

        $this->renderTemplate([
            'pageTitle' => 'Beschikbaarheid bewerken',
            'availability' => $this->availability ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete()
    {
        if(!$this->session->keyExists('admin')){
            header('Location: notfound');
            exit;
        }

        try{
            $availability = Availability::getById($_GET['id'], $this->db);

            if($availability){
                $availability->delete($this->db);

                header('Location: calendar');
                exit;

            }

        } catch (\Exception $e){
            $this->logger->error($e);
            header('Location: '. BASE_PATH);
            exit;
        }
    }
}