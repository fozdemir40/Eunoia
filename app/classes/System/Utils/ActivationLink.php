<?php namespace System\Utils;

class ActivationLink
{

    public $email, $active, $username;

    /**
     * @param $email
     * @param \PDO $db
     * @return bool
     */
    static public function send($email, \PDO $db): bool
    {
        $active = substr(sha1(uniqid(rand())), -32);
        $query = "UPDATE users SET active = :active "
            . "WHERE email = :email limit 1";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':active' => $active,
            ':email' => $email
        ]);
        if ($stmt->rowCount() == 1) {
            $body = "To activate your account, please click on this link:\n\n";
            $body .= BASE_URL . 'activate?x=' . urlencode($email) . '&y=' . $active;
            mail($email, 'Registration Confirmation', $body, 'From: ' . INFO_EMAIL);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param $email
     * @param \PDO $db
     * @param $username
     * @return array|bool
     */
    static public function is_exist($email, \PDO $db, $username)
    {
        $query = "SELECT email, active FROM users";
        if(!$username){
            $query .=" WHERE email = :email";
        } else {
            $query .= "WHERE username = :username";
        }
        $query .= " limit 1";
        $stmt = $db->prepare($query);
        $stmt->execute([
           ':email' => $email,
           ':username' => $username
        ]);

        list($e, $active) = $stmt->fetch(\PDO::FETCH_NUM);
        if($stmt->fetchColumn() == 1){
            if($username){
                return array(TRUE, $active, $email);
            }
            return array(TRUE, $active);
        }
        return FALSE;
    }

    /**
     * @param $email
     * @param \PDO $db
     * @param $username
     * @return array|bool
     */
    static public function send_activation_link($email, \PDO $db, $username)
    {
        $result = self::is_exist($email, $db, $username);
        if ($result[0]) { // record exist!
            if ($result[1] != NULL) { // account is not active
                $id = $username ? $result[2] : $email;
                if (ActivationLink::send($id, $db)) {
                    $_SESSION['msg'] = '<p>A confirmation email has been sent to your e-mail address'
                        . 'Please click on the link in that email in order to activate your account'
                        . '</p>';
                    header('Location:' . BASE_URL . 'activate');
                    exit();
                } else {
                    $_SESSION['msg'] = '<p>System error occured, We apologize for any inconvenience.</p>';
                }
            } else {
                $_SESSION['msg'] = '<p>Your account is already activated!</p>';
            }
        } else {
            $_SESSION['msg'] = '<p>Please try again. There is no such record with this username/e-mail!</p>';
        }
    }

}