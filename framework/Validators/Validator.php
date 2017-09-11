<?php

namespace Framework\Validators;

use Framework\Factory\ValidatorFactory;
use Framework\Router\Request;

class Validator
{
    public $errors = array();

    private $validators = [
        "email"   => "Please provide a correct email.",
        "integer" => "Please insert a valid number.",
        "char"    => "This must be composed by letters"
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function options(array $options = [])
    {
        return $this;
    }

    public function validate(array $payload)
    {
        foreach($payload as $value => $rules)
        {
            $rules = explode("|", $rules);
            foreach($rules as $rule)
            {
                $validator = ValidatorFactory::build($rule);
                if($validator->validate($value) == false)
                {
                    $this->errors[$rule] = $this->validators[$rule];
                    continue;
                }
            }
        }
        $this->out();
    }

    public function validteObj(Request $request)
    {
        dd($request);
    }

    public function out()
    {
        dd($this->errors);
        return $this->errors;
    }
}
