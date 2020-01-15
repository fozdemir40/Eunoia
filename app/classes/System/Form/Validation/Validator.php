<?php namespace System\Form\Validation;


/**
 * Interface Validator
 * @package System\Form\Validator
 */
interface Validator
{
    /**
     * Validator
     */
    public function validate(): void;


    /**
     * @return array
     */
    public function getErrors(): array;



}