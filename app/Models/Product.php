<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 *
 * @property string name
 * @property int views
 */
class Product extends Model
{
    use HasFactory;

    public const FIELD_NAME = 'name';
    public const FIELD_VIEWS = 'views';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_VIEWS,
    ];
}
