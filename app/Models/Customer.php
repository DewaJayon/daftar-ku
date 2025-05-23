<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Customer extends Model
{
    use Sluggable;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
