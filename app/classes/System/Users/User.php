<?php namespace System\Users;


/**
 * Class User
 * @package System\Users
 */
class User
{
    public $id, $username, $email, $password, $first_name, $last_name, $active, $user_level;

    /**
     * @param User $user
     * @param \PDO $db
     * @return bool
     */
    static public function add(User $user, \PDO $db): bool
    {
        $query = "INSERT INTO users"
            . "(username, first_name, last_name, email, active, password, "
            . "registration_date)"
            . "VALUES"
            . "(:username,:first_name,:last_name,:email,:active,:password,UTC_TIMESTAMP())";
        $stmt = $db->prepare($query);
        return $stmt->execute([
           ':username' => $user->username,
           ':first_name' => $user->first_name,
           ':last_name' => $user->last_name,
            ':email' => $user->email,
            ':active' => $user->active,
            ':password' => $user->password
        ]);

    }

    /**
     * @param string $email
     * @param \PDO $db
     * @return User
     * @throws \Exception
     */
    static public function getByEmail(string $email, \PDO $db): User
    {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        if(($user = $stmt->fetchObject("System\\Users\\User")) == false){
            throw new \Exception("User email is not in the database");
        }

        return $user;
    }

    /**
     * @param string $email
     * @param \PDO $db
     * @return string
     */
    static public function checkEmailExistence(string $email, \PDO $db): string
    {
        $stmt = $db->prepare("SELECT email from users where email = :email");
        $stmt->execute([':email'=>$email]);
        $out = $stmt->fetchColumn();

        return $out;
    }


    static public function getByEmailAndUsername(string $email, $username, \PDO $db)
    {
        $stmt = $db->prepare("SELECT username, email FROM users WHERE username = :username || email = :email");
        $stmt->execute([
            ':email' => $email,
            ':username' => $username
        ]);

        $out = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $out;

    }
}