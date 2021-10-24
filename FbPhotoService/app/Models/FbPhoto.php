<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FbPhoto
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FbPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FbPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FbPhoto query()
 * @mixin \Eloquent
 */
class FbPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'picture',
        'user_id',
    ];
}
