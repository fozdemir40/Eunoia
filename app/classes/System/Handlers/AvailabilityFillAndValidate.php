<?php namespace System\Handlers;

use System\Form\Data;
use System\Form\Validation\AvailabilityValidator;

/**
 * Class AvailabilityFillAndValidate
 * @package System\Handlers
 */
trait AvailabilityFillAndValidate
{
    public function executePostHandler(): void
    {
        if(filter_input(INPUT_POST, 'add-availability')){
            $this->formData = new Data($_POST);

            $this->availability->date = $this->formData->getPostVar('date');
            $this->availability->start_time = $this->formData->getPostVar('start-time');
            $this->availability->end_time = $this->formData->getPostVar('end-time');

            $validator = new AvailabilityValidator($this->availability);
            $validator->validate();
            $this->errors = $validator->getErrors();



        }
    }

}