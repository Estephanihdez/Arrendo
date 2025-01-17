<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Appoinment extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'user_id',
        'request_date',
        'status',
        'confirmation_date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    //status: Pending, Confirmed, Rejected
    public function validateStatus(array $attributes)
    {
        $validator = Validator::make($attributes, [
            'status' => [
                'required',
                Rule::in(['Pending', 'Confirmed', 'Rejected']),
            ],
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}
