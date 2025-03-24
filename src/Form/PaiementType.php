<?php

namespace App\Form;

use Core\Form\FormType;
use Core\Form\FormParam;

class PaiementType extends FormType
{
    public function __construct()
    {
        $this->build();
    }
    public function build(): void
    {
        $this->add(new FormParam("cardName", "string"));
        $this->add(new FormParam("cardNumber", "string"));
        $this->add(new FormParam("cardExpiry", "string"));
        $this->add(new FormParam("cardCvv", "string"));
    }
}