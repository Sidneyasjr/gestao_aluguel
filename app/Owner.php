<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Owner
 * @package App
 */
class Owner extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'day_transfer'
    ];

    /**
     * Relacionamentos
     */


    /**
     * @return HasMany
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'owner', 'id');
    }

    /**
     * @return HasMany
     */
    public function transfer(): HasMany
    {
        return $this->hasMany(Transfer::class, 'owner', 'id');
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
