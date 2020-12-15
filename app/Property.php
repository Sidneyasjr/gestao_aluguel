<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Property
 * @package App
 */
class Property extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'owner',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'status'
    ];

    /**
     * Relacionamentos
     */

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner', 'id');
    }

    /**
     * @return HasOne
     */
    public function ownerObject(): HasOne
    {
        return $this->hasOne(Owner::class, 'id', 'owner');
    }

    /**
     * Scopes
     * @param $query
     * @return mixed
     */

    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    /**
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }

    /**
     * @param $value
     */
    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = (!empty($value) ? $this->clearField($value) : null);
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getZipcodeAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return substr($value, 0, 5) . '-' . substr($value, 5, 3);
    }

    /**
     * @param string|null $param
     * @return string|string[]|null
     */
    private function clearField(?string $param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
