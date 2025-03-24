<?php

namespace App\Form;

use Core\Form\FormType;
use Core\Form\FormParam;

class CommandeType extends FormType
{
    public function __construct()
    {
        $this->build();
    }
    public function build(): void
    {
        $this->add(new FormParam("creditCard", "integer"));
        $this->add(new FormParam("adresse", "integer"));
    }
}