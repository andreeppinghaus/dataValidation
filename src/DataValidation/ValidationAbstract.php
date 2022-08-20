<?php
namespace DataValidation;

class ValidationAbstract implements ValidationInterface
{

    public function verify()
    {
        echo "verificando";
    }

    public function validate()
    {
        echo "validando";
    }
}

