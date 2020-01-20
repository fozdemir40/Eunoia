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