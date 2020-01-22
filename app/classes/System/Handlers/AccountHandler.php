<?php namespace System\Handlers;

use System\Databases\Database;
use System\Form\Data;
use System\Form\Validation\LoginValidator;
use System\Form\Validation\RegisterValidator;
use System\Form\Validation\ResetPassValidator;
use System\Users\User;
use System\Utils\ActivationLink;

class AccountHandler extends BaseHandler
{
    /**
     * @var Database
     */
    private $db, $user, $user_level, $email, $username;

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

    protected function login()
    {
        if ($this->session->keyExists('user')) {
            header('Location: dashboard' );
            exit;
        } elseif($this->session->keyExists('admin')){
            header('Location: admin/dashboard');
            exit;
        }

        if (isset($_POST['submit'])) {
            $formData = new Data($_POST);

            $email = $formData->getPostVar('email');
            $password = $formData->getPostVar('password');


            try {
                $this->user = User::getByEmail($email, $this->db);
            } catch (\Exception $e) {
                echo "Hoi!";
            }

            $validator = new LoginValidator($this->user, $password, $this->user->active);
            $validator->validate();
            $this->errors = $validator->getErrors();

            $this->user_level = $this->user->user_level;

        }

        if (isset($formData) && empty($this->errors)) {

            if ($this->user_level == 0){
                $this->session->set('user', $this->user);
                header('Location: dashboard');
                exit;
            } else {
                $this->session->set('admin', $this->user);
                header('Location:  admin/dashboard');
                exit;
            }

        }


        $this->renderTemplate([
            'pageTitle' => 'Login',
            'email' => $email ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function register()
    {
        if ($this->session->keyExists('user')) {
            header('Location: ' . BASE_URL);
            exit;
        }

        if (filter_input(INPUT_POST, 'register')) {
            $formData = new Data($_POST);

            $un = $formData->getPostVar('username');
            $e = $formData->getPostVar('email');
            $fn = $formData->getPostVar('first_name');
            $ln = $formData->getPostVar('last_name');
            $p = $formData->getPostVar('password');
            $cp = $formData->getPostVar('cpassword');
            $tel = $formData->getPostVar('phone');
            $address = $formData->getPostVar('address');
            $city = $formData->getPostVar('city');
            $date = $formData->getPostVar('birthdate');

            $validator = new RegisterValidator($fn, $ln, $e, $p, $cp, $tel, $address, $city, $date);
            $validator->validate();
            $this->errors = $validator->getErrors();

            if ($formData) {
                $out = User::getByEmailAndUsername($e, $un, $this->db);

                $cun = $out['cun'];
                $ce = $out['ce'];

                if ($un == $cun) {
                    $this->taken = TRUE;
                    $this->errors[] = 'Sorry, this username is already registered'
                        . ',if you forgot your password click here '
                        . '<a href="' . BASE_PATH . 'reset_password.php">Reset Password</a>';
                }
                if ($e == $ce) {
                    $this->taken = TRUE;
                    $this->errors[] = 'Sorry, this email is already registered,'
                        . 'if you forgot your password click here '
                        . '<a href="' . BASE_PATH . 'reset_password.php">Reset Password</a>';
                }

                if (!$this->taken){
                    $active = substr(sha1(uniqid(rand())), -32);
                    $user = new User();
                    $user->username = $un;
                    $user->email = $e;
                    $user->first_name = $fn;
                    $user->last_name = $ln;
                    $user->active = $active;
                    $user->password = password_hash($p, PASSWORD_ARGON2I);
                    $user->phone = $tel;
                    $user->address = $address;
                    $user->city = $city;
                    $user->birthdate = $date;

                    if (User::add($user, $this->db)){
                        $body = "Thank you for registering at Eunoia."
                            . "To activate your account, please click on this link:\n\n";
                        $body .= BASE_URL . 'activate?x=' . urldecode($e) . '&y=' . $active;
                        mail($e, 'Registration Confirmation', $body, 'From: ' . INFO_EMAIL);
                    }

                    if(isset($formData) && empty($this->errors)){
                        header('Location: login?newuser=success');
                        exit;
                    }



                }

            }

        }

        $this->renderTemplate([
            'pageTitle' => 'Register',
            'errors' => $this->errors
        ]);
    }

    protected function logout()
    {
        $this->session->destroy();
        header('Location: login');
        exit();
    }

    protected function activate(){
        /**
         * Database connection
         */

        if ($this->session->keyExists('user')) {
            header('Location: ' . BASE_URL);
            exit;
        }


        $x = filter_input(INPUT_GET, 'x', FILTER_VALIDATE_EMAIL);
        $y = filter_input(INPUT_GET, 'y', FILTER_SANITIZE_STRING);

        if ($x && strlen($y) == 32) {
            $formData = new Data($_GET);

            $this->email = $x;
            $query = "SELECT active FROM users"
                . " WHERE email = :email limit 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':email' => $this->email
            ]);
            if ($stmt->rowCount() == 1) {
                $a = $stmt->fetch(\PDO::FETCH_ASSOC);
                $active = $a['active'];
                if ($active == $y) {
                    $query = "UPDATE users SET active = NULL WHERE email = :email limit 1";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([
                        ':email' => $this->email
                    ]);
                    if ($stmt->rowCount() == 1) {
                        $this->errors[] = '<p>Your account is now active. You may now <a href="' . BASE_PATH . 'login">Log in.</a></p>';
                        $this->display_form = FALSE;
                    } else {
                        $this->errors[] = '<p>Your account could not be activated. #1'
                            . 'Please re-check the link or contact the system administrator.</p>';
                    }
                } else if ($active == NULL) {
                    $this->errors[] = '<p>Your account is already activated!</p>';
                } else {
                    $this->errors[] = '<p>Your account could not be activated. #2'
                        . 'Please re-check the link or contact the system administrator.</p>';
                }
            } else {
                $this->errors[] = '<p>Your account could not be activated. #3'
                    . 'Please re-check the link or contact the system administrator.</p>';
            }
        } elseif (filter_input(INPUT_POST, 'activate')) {
            $formData = new Data($_POST);

            $id = $formData->getPostVar(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));

            if (filter_var($id, FILTER_VALIDATE_EMAIL) && strlen($id) <= 80) {
                ActivationLink::send_activation_link($id, $this->db, FALSE);
            } else if (Data::between($id, 5, 50)){
                ActivationLink::send_activation_link($id, $this->db, TRUE);
            } else {
                $this->errors[] = '<p>Vul een geldig email in. </p>';
                unset($this->db);
            }

        }

        $this->renderTemplate([
            'pageTitle' => 'Activate',
            'display_form' => $this->display_form,
            'errors' => $this->errors
        ]);
    }

    protected function reset_password(){


        if ($this->session->keyExists('user')) {
            header('Location: ' . BASE_URL);
            exit;
        }

        if (filter_input(INPUT_POST, 'reset-request-submit')) {
            try {
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);

                $url = BASE_URL . "create_new_password?s=" . $selector . "&v=" . bin2hex($token);


                $formData = new Data($_POST);
                $e = $formData->getPostVar('email');

                $validator = new ResetPassValidator($e);
                $validator->validate();
                $this->errors = $validator->getErrors();

                if ($formData) {
                    $ce = User::checkEmailExistence($e, $this->db);

                    if ($e == $ce) {
                        $query = "DELETE FROM pwdReset WHERE pwdResetEmail = :email";
                        if (!$stmt = $this->db->prepare($query)) {
                            $this->errors[] = '<div class="alert alert-danger">There was an error! #1</div>';
                        } else {
                            $stmt->execute([
                                ':email' => $e
                            ]);
                        }

                        $query = "INSERT INTO pwdReset"
                            . "(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpire)"
                            . "VALUES"
                            . "(:email,:selector,:token,:expires);";
                        if (!$stmt = $this->db->prepare($query)) {
                            $this->errors[] = '<div class="alert alert-danger">There was an error! #2</div>';
                        } else {
                            $expires = date("U") + 1800;
                            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                            $stmt->execute([
                                ':email' => $e,
                                ':selector' => $selector,
                                ':token' => $hashedToken,
                                ':expires' => $expires
                            ]);

                            if($stmt->rowCount() == 1){
                                $to = $e;
                                $subject = 'Password reset for your Eunoia account';
                                $message = 'You have requested a password reset. To reset your password'
                                    . 'please click on this link: \n\n'
                                    . $url;
                                $headers = "From: Eunoia " . "<" . ADMIN_EMAIL . ">\r\n";
                                $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
                                $headers .= "Content-type: text/html\r\n";

                                mail($to, $subject, $message, $headers);

                                $_SESSION['msg'] = '<div class="alert alert-success" role="alert"> '
                                    . 'Request succesfully handled! '
                                    . 'A mail has been sent to your e-mail address. '
                                    . 'Further instructions will be explained in the mail.</div>';

                                unset($stmt);
                                unset($this->db);
                                header('Location:' . BASE_PATH . 'reset_password');
                                exit;
                            }  else {
                                $this->errors[] = '<div class="alert alert-danger" role="alert"> '
                                    . 'System error occured, '
                                    . 'The request couldn\d be registered at this time, we apologize '
                                    . 'for the inconvenience.</div>' . $stmt->errorInfo();
                            }
                        }
                    }

                    $this->errors[] = '<div class="alert alert-warning" role="alert">We were not able to find this email in our records</div>';
                    unset($stmt);
                    unset($this->db);

                }

            } catch (\Exception $e) {
                $this->errors[] = '<div class="alert alert-danger" role="alert"> '
                    . 'System error occured, '
                    . 'The request couldn\d be registered at this time, we apologize '
                    . 'for the inconvenience.</div>';

                echo $e->getMessage();
            }
        }

        $this->renderTemplate([
            'pageTitle' => 'Reset Password',
            'errors' => $this->errors
        ]);
    }

    protected function create_new_password(){
        if ($this->session->keyExists('user')) {
            header('Location: ' . BASE_URL);
            exit;
        }

        if (filter_input(INPUT_POST, 'reset-password-submit')) {

            $formData = new Data($_POST);
            $selector = $formData->getGetVar('s');
            $tokenValidator = $formData->getGetVar('v');
            $password = $formData->getPostVar('password');
            $cpassword = $formData->getPostVar('cpassword');

            if (empty($password) || empty($cpassword)) {
                header("Location: create_new_password");
                exit;
            } else if ($password != $cpassword) {
                header("Location: create_new_password");
                exit;
            }

            $currentDate = date("U");

            $query = "SELECT * FROM pwdReset WHERE pwdResetSelector = :selector AND pwdResetExpire >= :currentDate";
            if (!$stmt = $this->db->prepare($query)) {
                $this->errors[] = '<div class="alert alert-danger">There was an error! #cp_1</div>';
                exit;
            } else {
                $stmt->execute([
                    ':selector' => $selector,
                    ':currentDate' => $currentDate
                ]);
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (!$row = $result) {
                    $this->errors[] = '<div class="alert alert-danger">You need to re-submit your reset request #cp_2</div>';
                    exit;
                } else {
                    $tokenBin = hex2bin($tokenValidator);
                    $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

                    if ($tokenCheck == FALSE) {
                        $this->errors[] = '<div class="alert alert-danger">You need to re-submit your reset request #cp_3</div>';
                        exit;
                    } elseif ($tokenCheck == TRUE) {
                        $tokenEmail = $row['pwdResetEmail'];

                        $query = "SELECT * FROM users WHERE email = :email;";

                        if (!$stmt = $this->db->prepare($query)) {
                            $this->errors[] = '<div class="alert alert-danger">There was an error! #cp_4</div>';
                            exit;
                        } else {
                            $stmt->execute([':email' => $tokenEmail]);
                            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                            if (!$row = $result) {
                                $this->errors[] = '<div class="alert alert-danger">There was an error! #cp_5</div>';
                                exit;
                            } else {
                                $newPwdHash = password_hash($password, PASSWORD_ARGON2I);
                                $query = "UPDATE users SET password = :newP WHERE email = :email;";

                                $stmt = $this->db->prepare($query);
                                $stmt->execute([
                                    ':newP' => $newPwdHash,
                                    ':email' => $tokenEmail
                                ]);

                                $query = "DELETE FROM pwdReset WHERE pwdResetEmail = :email;";
                                $stmt = $this->db->prepare($query);
                                $stmt->execute([':email' => $tokenEmail]);

                                unset($stmt);
                                unset($this->db);
                                header('Location: ' . BASE_PATH . 'login?newpwd=passwordupdated');
                                exit;

                            }
                        }
                    }
                }
            }
        }

        $this->renderTemplate([
            'pageTitle' => 'Create new password',
            'display_form' => $this->display_form,
            'errors' => $this->errors
        ]);
    }




}