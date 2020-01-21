<?php namespace System\Availabilities;

/**
 * Class Availability
 * @package System\Availabilities
 */
class Availability
{

    public $reservation_id, $date, $start_time, $end_time;

    /**
     * @param Availability $availability
     * @param \PDO $db
     * @return bool
     */
    static public function add(Availability $availability, \PDO $db): bool
    {
        $query = "INSERT INTO reservations(date, start_at, end_at)
                    VALUES (:date, :start_time, :end_time)";

        $stmt = $db->prepare($query);
        return $stmt->execute([
           ':date' => $availability->date,
           ':start_time' => $availability->start_time,
           ':end_time' => $availability->end_time
        ]);
    }

    /**
     * @param \PDO $db
     * @return array
     */
    static public function getAll(\PDO $db): array
    {
        return $db->query("SELECT * FROM reservations")->fetchAll(\PDO::FETCH_CLASS, "System\\Availabilities\\Availability");
    }

    /**
     * @param \PDO $db
     * @param $month
     * @param $year
     * @return Availability
     * @throws \Exception
     */
    static public function getByMonthAndYear(\PDO $db, $month, $year): array
    {
        $query = "SELECT reservation_id, date, start_at, end_at, taken FROM reservations WHERE MONTH(date) = :m AND YEAR(date) = :y ";
        $stmt = $db->prepare($query);
        $stmt->execute([
           ':m' => $month,
            ':y' => $year
        ]);

        if(($available = $stmt->fetchAll()) == false){
            throw new \Exception("No records found");
        }

        return $available;
    }


    /**
     * @param \PDO $db
     * @return bool
     */
    public function delete(\PDO $db): bool
    {

        $query = "DELETE FROM reservations
                  WHERE reservation_id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([':id' => $this->reservation_id]);
    }
}