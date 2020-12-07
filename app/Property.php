<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner', 'id');
    }

    public function ownerObject()
    {
        return $this->hasOne(Owner::class, 'id', 'owner');
    }

    /**
     * Scopes
     */

    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = (!empty($value) ? $this->clearField($value) : null);
    }

    public function getZipcodeAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return substr($value, 0, 5) . '-' . substr($value, 5, 3);
    }

    private function clearField(?string $param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
