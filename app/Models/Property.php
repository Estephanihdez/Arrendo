<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'city',
        'state',
        'postal_code',
        'rental_rate',
        'availability', //Available, Not Available
        'total_bathrooms',
        'total_rooms',
        'total_m2',
        'have_parking', // 1 = Yes, 0 = No
        'accept_mascots',
        'property_price',
        'property_details',
        'property_photos_path',
        'owner_user_id',
        'zone_id',
    ];

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'id');
    }

    public function validateAvailability(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'availability' => [
                'required',
                Rule::in(['Available', 'Not Available']),
            ],
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}


