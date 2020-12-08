<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'day_transfer'
    ];

    /**
     * Relacionamentos
     */

    public function properties()
    {
        return $this->hasMany(Property::class, 'owner', 'id');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'owner', 'id');
    }


    public function getTelephoneAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        if(strlen($value) < 11){
            return
                substr($value, 0, 0) . '(' .
                substr($value, 0, 2) . ')' .
                substr($value, 2, 4) . '-' .
                substr($value, 6, 10)
                ;
        }

        return
            substr($value, 0, 0) . '(' .
            substr($value, 0, 2) . ')' .
            substr($value, 2, 5) . '-' .
            substr($value, 7, 11)
            ;
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = (!empty($value) ? $this->clearField($value) : null);
    }

    private function clearField(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
