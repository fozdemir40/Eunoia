<?php namespace System\Form\Validation;


use System\Children\Child;

class ChildValidator implements Validator
{

    private $errors = [];

    private $child;

    public function __construct(Child $child)
    {
        $this->child = $child;

    }

    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->child->child_name == "") {
            $this->errors[] = 'Veld naam mag niet leeg zijn';
        }
        if ($this->child->birthdate == "") {
            $this->errors[] = 'Veld geboortedatum mag niet leeg zijn';
        }
        if ($this->child->development == "") {
            $this->errors[] = 'Veld ontwikkeling mag niet leeg zijn';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}