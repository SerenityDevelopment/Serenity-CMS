<?php

namespace Application\Form;

use Laminas\Form\Element;

class UserForm extends \Laminas\Form\Form
{
    public function __construct($name = 'user')
    {
        parent::__construct($name);
        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);
        $this->add([
            'name' => 'username',
            'type' => 'text',
            'options' => [
                'label' => 'Username'
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => 'text',
            'options' => [
                'label' => 'Email'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'saveUserForm'
            ]
        ]);
        
        // By default it's also POST
        $this->setAttribute('method', 'POST');
    }
}