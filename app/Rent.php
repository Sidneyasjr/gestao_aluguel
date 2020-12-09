<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'enrollment',
        'contract',
        'customer',
        'value',
        'due_at',
        'status'
    ];


    public function contractObject()
    {
        return $this->hasOne(Owner::class, 'id', 'contract');
    }

    public function customerObject()
    {
        return $this->hasOne(Customer::class, 'id', 'customer');
    }



    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }


    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }

    private function convertStringToDate($param)
    {
        if(empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
