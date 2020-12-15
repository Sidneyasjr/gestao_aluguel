<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Contract
 * @package App
 */
class Contract extends Model
{
    /**
     * @var string[]
     */
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


    public function ownerObject(): HasOne
    {
        return $this->hasOne(Owner::class, 'id', 'owner');
    }

    /**
     * @return HasOne
     */
    public function propertyObject(): HasOne
    {
        return $this->hasOne(Property::class, 'id', 'property');
    }

    /**
     * @return HasOne
     */
    public function customerObject(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer');
    }

    /**
     * @return HasMany
     */
    public function transfer(): HasMany
    {
        return $this->hasMany(Transfer::class, 'contracts', 'id');
    }

    /**
     * @return HasMany
     */
    public function rent(): HasMany
    {
        return $this->hasMany(Rent::class, 'contracts', 'id');
    }


    /**
     * Scopes
     * @param $query
     * @return mixed
     */

    public function scopePendent($query)
    {
        return $query->where('status', 'pendent');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getRentPriceAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    /**
     * @param $value
     */
    public function setRentPriceAttribute($value)
    {
        $this->attributes['rent_price'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getTributeAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    /**
     * @param $value
     */
    public function setTributeAttribute($value)
    {
        $this->attributes['tribute'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getAdmFeeAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    /**
     * @param $value
     */
    public function setAdmFeeAttribute($value)
    {
        $this->attributes['adm_fee'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getCondominiumAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    /**
     * @param $value
     */
    public function setCondominiumAttribute($value)
    {
        $this->attributes['condominium'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }


    /**
     * @param $param
     * @return string|string[]|null
     */
    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }

    /**
     * @param $param
     * @return string|null
     * @throws \Exception
     */
    private function convertStringToDate($param): ?string
    {
        if(empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
