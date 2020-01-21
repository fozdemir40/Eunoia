<?php namespace System\Form\Validation;


class BookingValidator implements Validator
{
    private $errors = [];
    private $hulpvraag, $verwachting, $belangrijke_zaken, $for_child;

    /**
     * BookingValidator constructor.
     * @param $hulpvraag
     * @param $verwachting
     * @param $belangrijke_zaken
     * @param $for_child
     */
    public function __construct($hulpvraag, $verwachting, $belangrijke_zaken, $for_child)
    {
        $this->hulpvraag = $hulpvraag;
        $this->verwachting = $verwachting;
        $this->belangrijke_zaken = $belangrijke_zaken;
        $this->for_child = $for_child;
    }


    public function validate(): void
    {
        if ($this->hulpvraag == "") {
            $this->errors[] = 'Veld hulpvraag mag niet leeg zijn';
        }

        if ($this->verwachting == "") {
            $this->errors[] = 'Veld verwachting mag niet leeg zijn';
        }

        if ($this->belangrijke_zaken == "") {
            $this->errors[] = 'Veld belangrijke zaken mag niet leeg zijn';
        }

        if ($this->for_child == "") {
            $this->errors[] = 'Veld voor uw kind mag niet leeg zijn';
        }

    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}