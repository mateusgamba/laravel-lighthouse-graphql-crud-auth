<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RecordSignature;

class Post extends Model
{
    use HasFactory;
    use RecordSignature;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
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
        'title' => 'string',
        'content' => 'string',
        'created_by' => 'int',
        'updated_by' => 'int',
    ];

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return hasMany
     */
    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }
}
