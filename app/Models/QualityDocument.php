<?php

namespace App\Models;

use App\Enums\QualityDocument\Type;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property integer $type
 * @property string $number
 * @property Carbon|null $date_from
 * @property Carbon|null $date_to
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class QualityDocument extends Model
{
    use HasUuids;

    protected $table = 'quality_documents';

    protected $fillable = [
        'type',
        'number',
        'date_from',
        'date_to',
        'description',
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
        'type' => Type::class,
    ];
}
