<?php namespace System\Handlers;


use System\Databases\Database;
use System\Availabilities\Availability;
use System\Availabilities\AvailabilitiesCollection;
use System\Utils\Date;

class CalendarHandler extends BaseHandler
{
    /**
     * @var \PDO
     */
    private $db, $availability, $date;

    private $adminTools = false;

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

}