<?php declare(strict_types=1);

namespace App\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Feedback extends Model
{
    protected $table = "feedback";

    protected $fillable = [
        'customerName', 'description'
    ];

}
