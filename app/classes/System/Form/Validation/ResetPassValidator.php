<?php namespace System\Form\Validation;

use System\Form\Data;

class ResetPassValidator implements Validator
{
    private $errors = [];
    private $email;

    /**
     * ResetPassValidator constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    public function validate(): void
    {
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email) <= 80 ){
            $this->errors[] = '<div class="alert alert-warning" role="alert">Vul een geldig email in!</div>';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }


}