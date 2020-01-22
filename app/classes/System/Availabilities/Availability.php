<?php namespace System\Availabilities;

/**
 * Class Availability
 * @package System\Availabilities
 */
class Availability
{

    public $reservation_id, $date, $start_time, $end_time;

    /**
     * @param \PDO $db
     * @return array
     */
    static public function getAll(\PDO $db): array
    {
        return $db->query("SELECT * FROM reservations")->fetchAll(\PDO::FETCH_CLASS, "System\\Availabilities\\Availability");
    }


    /**
     * Get a specific availability by its ID
     *
     * @param int $id
     * @param \PDO $db
     * @return Availability
     * @throws \Exception
     */
    static public function getById(int $id, \PDO $db): Availability
    {
        $statement = $db->prepare("SELECT * FROM reservations WHERE reservation_id = :id");
        $statement->execute([':id' => $id]);

        if (($album = $statement->fetchObject("System\\Availabilities\\Availability")) === false) {
            throw new \Exception("Availability ID {$id} is not available in the database");
        }

        return $album;
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
     * @return array
     */
    static public function getAllTaken(\PDO $db): array
    {
        $query = "SELECT users.first_name, users.last_name, users.email, reservations.reservation_id,reservations.date, reservations.start_at, reservations.end_at, reservations.for_child, reservations.completed
                    FROM users INNER JOIN reservations ON reservations.taken_by = users.user_id 
                    WHERE taken = 1";;
        $stmt = $db->prepare($query);
        $taken = 1;
        $stmt->execute([
           ':taken' => $taken
        ]);

        $result = $stmt->fetchAll(\PDO::FETCH_CLASS,"System\\Availabilities\\Availability");

        return $result;
    }

    /**
     * @param \PDO $db
     * @return array
     */
    static public function getAllCompleted(\PDO $db): array
    {
        $query = "SELECT users.first_name, users.last_name, users.email, reservations.date, 
                    reservations.start_at, reservations.end_at, reservations.for_child, reservations.completed, reservation_history.message, reserv_type.type
                    FROM users 
                    INNER JOIN reservations ON reservations.taken_by = users.user_id 
                    INNER JOIN reservation_history ON reservation_history.reservation_id = reservations.reservation_id
                    INNER JOIN reserv_type ON reservation_history.reserv_type_id = reserv_type.reserv_type_id
                    WHERE taken = :taken AND completed = :completed";
        $stmt = $db->prepare($query);
        $taken = 1;
        $completed = 1;
        $stmt->execute([
            ':taken' => $taken,
            ':completed' => $completed
        ]);

        $result = $stmt->fetchAll(\PDO::FETCH_CLASS,"System\\Availabilities\\Availability");

        return $result;
    }

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
    public function update(\PDO $db): bool
    {
        $query = "UPDATE reservations SET date = :dateP, start_at = :start_at, end_at = :end_at WHERE reservation_id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([
            ':dateP' => $this->date,
            ':start_at' => $this->start_time,
            ':end_at' => $this->end_time,
            ':id' => $this->reservation_id
        ]);
    }

    /**
     * @param \PDO $db
     * @return bool
     */
    public function complete(\PDO $db): bool
    {
        $query = "UPDATE reservations SET completed = :completed WHERE reservation_id = :id";
        $completed = 1;
        $stmt = $db->prepare($query);
        return $stmt->execute([
            ':completed' => $completed,
            ':id' => $this->reservation_id
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