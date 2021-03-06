<?php namespace System\Form\Validation;

use System\Form\Data;


class RegisterValidator implements Validator
{
    private $errors = [];
    private $firstname, $lastname, $email, $password, $cpassword, $tel, $address, $city, $date;

    /**
     * RegisterValidator constructor.
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $password
     * @param $cpassword
     * @param $tel
     * @param $address
     * @param $city
     * @param $date
     */
    public function __construct($firstname, $lastname, $email, $password, $cpassword, $tel, $address, $city, $date)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->cpassword = $cpassword;
        $this->tel = $tel;
        $this->address = $address;
        $this->city = $city;
        $this->date = $date;
    }


    public function validate(): void
    {

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email <= 80)) {
            $this->errors[] = "Graag een geldig email invullen";
        }

        if (!Data::between($this->firstname, 2, 20)) {
            $this->errors[] = 'Vul uw voornaam in tussen 2 en 20 karakters';
        }

        if (!Data::between($this->lastname, 2, 40)) {
            $this->errors[] = 'Please enter your last name, should be within 2-40 characters';
        }

        if (!Data::between($this->email, 5, 50)) {
            $errors['username'] = 'Please enter your username, should be within 5-50 characters';
        }

        if (!Data::between($this->password, 8, 20)) {
            $errors['password'] = 'Please enter your password, should be within 8-20 characters';
        }

        if (!$this->password == $this->cpassword) {
            $errors['cpassword'] = 'Please make sure to enter the same password';
        }

        if($this->tel || $this->date || $this->address || $this->city){
            $errors['phone'] = 'Veld mag niet leeg zijn';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }


}