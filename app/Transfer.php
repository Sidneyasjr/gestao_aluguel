<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'enrollment',
        'contract',
        'owner',
        'value',
        'due_at',
        'status'
    ];


    public function contractObject()
    {
        return $this->hasOne(Contract::class, 'id', 'contract');
    }

    public function ownerObject()
    {
        return $this->hasOne(Owner::class, 'id', 'owner');
    }

    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }


//    public function getDueAtAttribute($value)
//    {
//        if (empty($value)) {
//            return null;
//        }
//
//        return date('d/m/Y', strtotime($value));
//    }
//
//    public function setDueAtAttribute($value)
//    {
//        $this->attributes['due_at'] = (!empty($value) ? $this->convertStringToDate($value) : null);
//    }

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
