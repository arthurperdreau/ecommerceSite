<?php

namespace App\Form;

use Core\Form\FormType;
use Core\Form\FormParam;

class LivraisonType extends FormType
{
    public function __construct()
    {
        $this->build();
    }
    public function build(): void
    {
        $this->add(new FormParam("fullName", "string"));
        $this->add(new FormParam("address", "string"));
        $this->add(new FormParam("city", "string"));
        $this->add(new FormParam("postalCode", "string"));
    }
}