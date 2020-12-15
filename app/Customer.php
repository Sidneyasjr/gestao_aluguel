<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Class Customer
 * @package App
 */
class Customer extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'telephone'
    ];

    /**
     * @return HasMany
     */
    public function rent(): HasMany
    {
        return $this->hasMany(Rent::class, 'customer', 'id');
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getTelephoneAttribute($value): ?string
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

    /**
     * @param $value
     */
    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = (!empty($value) ? $this->clearField($value) : null);
    }

    /**
     * @param string|null $param
     * @return string|string[]|null
     */
    private function clearField(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
