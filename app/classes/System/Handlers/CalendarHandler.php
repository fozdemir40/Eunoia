<?php namespace System\Handlers;


use System\Children\AllChildren;
use System\Children\Child;
use System\Databases\Database;
use System\Availabilities\Availability;
use System\Availabilities\AvailabilitiesCollection;
use System\Form\Data;
use System\Form\Validation\BookingValidator;
use System\Utils\Date;

class CalendarHandler extends BaseHandler
{
    /**
     * @var \PDO
     */
    private $db, $availability, $date, $hulpvraag, $verwachting, $belangrijke_zaken, $for_child;


    private $adminTools = false;

    private $formData;

    private $dayLabel;

    private $insertAvailabilityInDays = [];


    /**
     * AccountHandler constructor.
     *
     * @param $templateName
     * @throws \ReflectionException
     */
    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }

    protected function index()
    {

        if ($this->session->keyExists('admin')) {
            $this->adminTools = true;
        }

        $currentDate = new Date();

        $month = $currentDate->getCurrentDate()->format("m");
        $year = $currentDate->getCurrentDate()->format("Y");
        $monthName = $currentDate->getCurrentDate()->format('F');

        if(isset($_GET['m']) && isset($_GET['y'])){
            $m = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING);
            $y = filter_input(INPUT_GET, 'y', FILTER_SANITIZE_STRING);

            $month = $m;
            $year = $y;

            try {
                $ot = new \DateTime($year . $month . '01');
                $monthName = $ot->format('F');
            } catch (\Exception $e) {
                $this->logger->error($e);
            }


        }

        $availableCollection = new AvailabilitiesCollection();


        try {
            $availableCollection->add(Availability::getByMonthAndYear($this->db, $month, $year));
            $availabilities = $availableCollection->get();

            foreach ($availabilities as $key => $this->availability) {
                $this->date = new \DateTime($this->availability['date']);
                $this->dayLabel = $this->date->format('D');

                $availableData = array(
                    'id' => $this->availability['reservation_id'],
                    'date' => $this->availability['date'],
                    'start_at' => $this->availability['start_at'],
                    'end_at' => $this->availability['end_at'],
                    'taken' => $this->availability['taken']
                );


                  $this->insertAvailabilityInDays[$this->dayLabel][] = $availableData;

            }



        } catch (\Exception $e) {
            $this->logger->error($e);
        }


        $this->renderTemplate([
            'availabilities' => $this->insertAvailabilityInDays ?? false,
            'monthName' => $monthName ?? false,
            'month' => $month ?? false,
            'year' => $year ?? false,
            'adminTools' => $this->adminTools,
            'errors' => $this->errors
        ]);

    }

    /**
     * @throws \Exception
     */
    protected function book(){
        if($this->session->keyExists('user')){
            $user = $this->session->get('user');

            $allChildren = new AllChildren();
            $allChildren->add(Child::getByParenId($user->user_id, $this->db));

            try{
                $this->formData = new Data($_POST);

                if(filter_input(INPUT_POST, 'book-availability')){
                    $this->hulpvraag = $this->formData->getPostVar('hulpvraag');
                    $this->verwachting = $this->formData->getPostVar('verwachting');
                    $this->belangrijke_zaken = $this->formData->getPostVar('belangrijke_zaken');
                    $this->for_child = $this->formData->getPostVar('for_child');
                }

                $validator = new BookingValidator($this->hulpvraag, $this->verwachting, $this->belangrijke_zaken, $this->for_child);
                $validator->validate();
                $this->errors = $validator->getErrors();


                if (isset($this->formData) && empty($this->errors)){
                    $this->availability = Availability::getById($_GET['id'], $this->db);
                    $query = "UPDATE reservations SET hulpvraag = :hulpvraag, verwachting = :verwachting, 
                            belangrijke_zaken = :belangrijke_zaken, for_child = :for_child, taken = :taken, taken_by = :taken_by
                            WHERE reservation_id = :id";
                    $taken = 1;
                    $user_id = $this->session->get('user')->user_id;

                    $stmt = $this->db->prepare($query);
                    $stmt->execute([
                        ':hulpvraag' => $this->hulpvraag,
                        ':verwachting' => $this->verwachting,
                        ':belangrijke_zaken' => $this->belangrijke_zaken,
                        ':for_child' => $this->for_child,
                        ':taken' => $taken,
                        ':taken_by' => $user_id,
                        ':id' => $this->availability->reservation_id,
                    ]);

                    if($stmt->rowCount() == 1){
                        $body = "Uw afspraak staat vast!"
                            . " Dit email is verstuurt ter bevestiging van uw reservering"
                            . "Afspraak informatie:\n\n";
                        $body .= "Start tijd: " . $this->availability->start_time."\n\n";
                        $body .= "Datum: " .$this->availability->date . "\n\n";
                        $body .= "Bedankt voor het reservering bij Eunoia!";
                        $user_email = $this->session->get('user')->email;

                        mail($user_email, 'Afspraak bevestiging', $body, 'From: ' . INFO_EMAIL);

                        unset($stmt);
                        unset($this->db);
                        header('Location: '. BASE_PATH . 'calendar?booking=success');
                        exit;
                    } else {
                        $this->logger->error(new \Exception("DB error: {$this->db->errorInfo()}"));
                        $this->errors[] = "Er is een probleem opetreden tijdens het reserveren van uw afspraak, probeer het later opnieuw";
                    }
                }



            } catch (\Exception $e) {
                $this->logger->error($e);
                $this->errors[] = "Whoops: " . $e->getMessage();
                $pageTitle = 'Beschikbaarheid bestaat niet!';
            }

        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'Afspraak reserveren',
            'children' => $allChildren->get(),
            'errors' => $this->errors
        ]);
    }

}