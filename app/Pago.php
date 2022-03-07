<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public function getTipoVentaDescripcion(): string
    {
        switch ($this->tipo) {
        case 1:
            return 'B/V';
        case 2:
            return 'FACT.';
        case 3:
            return 'REC.';
        default:
            return '';
        }
    }
}
