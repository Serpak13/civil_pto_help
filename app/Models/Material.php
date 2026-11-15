<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\Material\Unit;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $name
 * @property string $grade
 * @property string $standard
 * @property Unit $unit
 * @property string $manufacturer
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Material extends Model
{
    use HasUuids;

    protected $table = 'materials';

    protected $fillable = [
        'name',
        'grade',
        'standard',
        'unit',
        'manufacturer',
        'description',
    ];

    protected $casts = [
        'unit' => Unit::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function qualityDocuments():BelongsToMany
    {
        return $this->belongsToMany(QualityDocument::class, 'material_quality_document', 'material_id', 'quality_document_id')
            ->withTimestamps();
    }

}
