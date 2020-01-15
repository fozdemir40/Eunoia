<?php namespace System\Databases;

/**
 * Class Database
 * @package System\Databases
 */
class Database
{
    /**
     * @var \PDO
     */
    protected $connection;
    private $host, $username, $password, $database;

    /**
     * Database constructor.
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     * @throws \Exception
     */
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    /**
     * @throws \Exception
     */
    private function connect(): void
    {
        try {
            $this->connection = new \PDO("mysql:dbname=$this->database;host=$this->host",
                $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            throw new \Exception("DB Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }


}