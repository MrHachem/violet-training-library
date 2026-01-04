<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'personal_picture',
        'birth_date',
        'death_date',
    ];

    public function full_name(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
