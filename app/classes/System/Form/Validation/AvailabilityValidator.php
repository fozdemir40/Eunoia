<?php namespace System\Form\Validation;

use System\Form\Data;
use System\Availabilities\Availability;

class AvailabilityValidator implements Validator
{

    private $errors = [];
    private $availability;

    /**
     * AvailabilityValidator constructor.
     * @param Availability $availability
     */
    public function __construct(Availability $availability)
    {
        $this->availability = $availability;
    }

    public function validate(): void
    {
        if($this->availability->date == '' || $this->availability->start_time == '' || $this->availability->end_time == ''){
            $this->errors[] = 'Velden mogen niet leeg zijn';
        }

        if($this->availability->end_time <= $this->availability->start_time){
            $this->errors[] = 'Eind tijd mag niet lager zijn dan start tijd';
        }

        if($this->availability->start_time == $this->availability->end_time){
            $this->errors[] = 'Tijden mogen niet gelijk zijn';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }


}