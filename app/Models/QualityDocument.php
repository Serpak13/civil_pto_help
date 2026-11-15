<?php

namespace App\Models;

use App\Enums\QualityDocument\Type;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property Type $type
 * @property string $number
 * @property Carbon $date_from
 * @property Carbon|null $date_to
 * @property string|null $description
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
        'date_from' => 'date',
        'date_to' => 'date',
        'type' => Type::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function materials():BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_quality_document', 'quality_document_id', 'material_id')
            ->withTimestamps();
    }
}
