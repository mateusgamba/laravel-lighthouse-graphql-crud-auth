<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'post_id',
        'name',
        'email',
        'content',
    ];

    /**
     * @return array
     */
    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'content' => 'string',
    ];
}
