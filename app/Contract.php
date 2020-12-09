<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'property',
        'owner',
        'customer',
        'rent_price',
        'adm_fee',
        'tribute',
        'condominium',
        'start_at',
        'end_at',
        'status'
    ];

    /**
     * Relacionamentos
     */

    public function ownerObject()
    {
        return $this->hasOne(Owner::class, 'id', 'owner');
    }

    public function propertyObject()
    {
        return $this->hasOne(Property::class, 'id', 'property');
    }

    public function customerObject()
    {
        return $this->hasOne(Customer::class, 'id', 'customer');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'contracts', 'id');
    }
    public function rent()
    {
        return $this->hasMany(Rent::class, 'contracts', 'id');
    }


    /**
     * Scopes
     */

    public function scopePendent($query)
    {
        return $query->where('status', 'pendent');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }

    public function getRentPriceAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setRentPriceAttribute($value)
    {
        $this->attributes['rent_price'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getTributeAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setTributeAttribute($value)
    {
        $this->attributes['tribute'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getAdmFeeAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setAdmFeeAttribute($value)
    {
        $this->attributes['adm_fee'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getCondominiumAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setCondominiumAttribute($value)
    {
        $this->attributes['condominium'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
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
