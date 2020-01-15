<?php namespace System\Form\Validation;

use System\Users\User;

/**
 * Class LoginValidator
 * @package System\Form\Validation
 */
class LoginValidator implements Validator
{
    private $errors = [];
    private $user, $password, $active;

    /**
     * LoginValidator constructor.
     *
     * @param User $user
     * @param string $password
     * @param string $active
     */

    public function __construct(User $user, string $password, $active)
    {
        $this->user = $user;
        $this->password = $password;
        $this->active = $active;
    }
    /**
     * Validate the data
     */

    public function validate(): void
    {
        //Go on if we got an user (which means email is correct)
        if (!empty($this->user->email)) {
            //Validate password
            if (!password_verify($this->password, $this->user->password)) {
                $this->errors[] = "Je wachtwoord is onjuist!";
            }
        } else {
            $this->errors[] = "Email bestaat niet!";
        }

        if(!$this->user->active == NULL){
            $this->errors[] = "Je account is nog niet geactiveerd, activeer uw account eerst!";
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}