<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PostValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required|min:5',
            'body' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required|min:10',
            'body' => 'required',
        ]
    ];

    // protected $messages = [
    //     'required' => 'The :attribute field is required.',
    //     'email.required' => 'We need to know your e-mail address!',
    // ];
}
