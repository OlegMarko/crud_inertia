<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property $created_at
 * @property $updated_at
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
}
