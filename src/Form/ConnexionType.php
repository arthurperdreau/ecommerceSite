<?php

namespace App\Form;

use Core\Form\FormType;
use Core\Form\FormParam;

class ConnexionType extends FormType
{
    public function __construct()
    {
        $this->build();
    }
    public function build(): void
    {
        $this->add(new FormParam("username", "string"));
        $this->add(new FormParam("password", "string"));
    }
}