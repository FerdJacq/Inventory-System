<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'quantity', 'price', 'version'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeLockedForUpdate($query)
    {
        return $query->lockForUpdate();
    }

    public function incrementVersion()
    {
        $this->version++;
        $this->save();
    }
}
