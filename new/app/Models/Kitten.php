<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitten extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'birth_date',
        'gender',
        'age',
        'breed_type',
        'character',
        'description',
        'tags',
        'features',
        'status',
        'gallery',
        'show_parents',
        'mother_title',
        'mother_name',
        'mother_breed',
        'mother_photo',
        'father_title',
        'father_name',
        'father_breed',
        'father_photo',
    ];

    protected $casts = [
        'tags' => 'array',
        'features' => 'array',
        'gallery' => 'array',
        'show_parents' => 'boolean',
        'birth_date' => 'date',
    ];
}
