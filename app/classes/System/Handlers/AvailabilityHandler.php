<?php namespace System\Handlers;


use System\Databases\Database;
use System\Form\Data;
use System\Availabilities\Availability;
use System\Availabilities\AvailabilitiesCollection;
use System\Form\Validation\BookingHistoryValidator;

class AvailabilityHandler extends BaseHandler
{
    use AvailabilityFillAndValidate;
    /**
     * @var \PDO
     */
    private $db;

    private $formData;

    private $allReserveTypes = [];

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
        if (!$this->session->keyExists('admin')) {
            header('Location: notfound');
            exit;
        }

        $this->availability = new Availability();
        $this->executePostHandler();

        if (isset($this->formData) && empty($this->errors)) {
            if (Availability::add($this->availability, $this->db)) {
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
        if (!$this->session->keyExists('admin')) {
            header('Location: notfound');
            exit;
        }

        try {
            $this->availability = Availability::getById($_GET['id'], $this->db);
            $this->executePostHandler();

            if (isset($this->formData) && empty($this->errors)) {
                if ($this->availability->update($this->db)) {
                    header('Location: calendar');
                    $_SESSION['msg'] = 'Beschikbaarheid is succesvol gewijzigd!';
                    exit;
                } else {
                    $this->logger->error(new \Exception("DB Error: {$this->db->errorInfo()}"));
                    $this->errors[] = "Whoops! Een server probleem is ontstaan";
                }
            }


        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = "Whoops: " . $e->getMessage();
            $pageTitle = 'Availability does\'t exist';
        }

        $this->renderTemplate([
            'pageTitle' => 'Beschikbaarheid bewerken',
            'availability' => $this->availability ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function complete()
    {
        if (!$this->session->keyExists('admin')) {
            header('Location: notfound');
            exit;
        }

        try {
            $availability = Availability::getById($_GET['id'], $this->db);

            $query = "SELECT * FROM reserv_type";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $this->allReserveTypes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($availability) {


                if (filter_input(INPUT_POST, 'complete-booking')) {
                    $this->formData = new Data($_POST);

                    $message = $this->formData->getPostVar('message');
                    $reserv_type = $this->formData->getPostVar('reserv_type');

                    $validator = new BookingHistoryValidator($message, $reserv_type);
                    $validator->validate();
                    $this->errors = $validator->getErrors();

                    if (isset($this->formData) && empty($this->errors)) {
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
                        $query = "INSERT INTO reservation_history (message, reserv_type_id, reservation_id) VALUES (:message, :reserv_type_id, :reservation_id)";
                        $stmt = $this->db->prepare($query);
                        $stmt->execute([
                            ':message' => $message,
                            ':reserv_type_id' => $reserv_type,
                            ':reservation_id' => $id
                        ]);
                        $availability->complete($this->db);

                        if($stmt->rowCount() == 1){
                            unset($stmt);
                            unset($this->db);
                            header('Location: ' . BASE_PATH . 'admin/dashboard?booking=completed');
                            exit;
                        }
                    }
                }


            }

        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = "Whoops: " . $e->getMessage();
        }

        $this->renderTemplate([
            'pageTitle' => 'Afspraak afronden',
            'availability' => $this->availability ?? false,
            'allReserveTypes' => $this->allReserveTypes,
            'errors' => $this->errors
        ]);
    }

    protected function delete()
    {
        if (!$this->session->keyExists('admin')) {
            header('Location: notfound');
            exit;
        }

        try {
            $availability = Availability::getById($_GET['id'], $this->db);

            if ($availability) {
                $availability->delete($this->db);

                header('Location: calendar');
                exit;

            }

        } catch (\Exception $e) {
            $this->logger->error($e);
            header('Location: ' . BASE_PATH);
            exit;
        }
    }
}