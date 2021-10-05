<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    use HasFactory;

    protected $table = "resources";

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'title', 'link', 'description'
    ];

}
