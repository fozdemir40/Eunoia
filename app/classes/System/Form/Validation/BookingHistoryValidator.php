<?php namespace System\Form\Validation;


class BookingHistoryValidator implements Validator
{

    private $errors = [];
    private $message, $type;

    /**
     * BookingHistoryValidator constructor.
     * @param $message
     * @param $type
     */
    public function __construct($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
    }


    public function validate(): void
    {
        if ($this->message == "") {
            $this->errors[] = 'Veld bericht mag niet leeg zijn';
        }

        if ($this->type == "") {
            $this->errors[] = 'Veld reserverin type mag niet leeg zijn';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}