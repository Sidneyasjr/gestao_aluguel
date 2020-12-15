<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Rent
 * @package App
 */
class Rent extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'enrollment',
        'contract',
        'customer',
        'value',
        'due_at',
        'status'
    ];


    /**
     * @return HasOne
     */
    public function contractObject(): HasOne
    {
        return $this->hasOne(Owner::class, 'id', 'contract');
    }

    /**
     * @return HasOne
     */
    public function customerObject(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer');
    }


    /**
     * @param $value
     * @return string|null
     */
    public function getValueAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
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
