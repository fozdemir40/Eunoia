<?php namespace System\Handlers;


use System\Form\Data;
use System\Form\Validation\ChildValidator;

/**
 * Trait ChildFillAndValidate
 * @package System\Handlers
 */
trait ChildFillAndValidate
{
    public function executePostChild(): void
    {
        if(filter_input(INPUT_POST, 'add-child')){
            $this->formData = new Data($_POST);

            $this->child->child_name = $this->formData->getPostVar('child-name');
            $this->child->birthdate = $this->formData->getPostVar('birthdate');
            $this->child->development = $this->formData->getPostVar('development');

            $validator = new ChildValidator($this->child);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }

}