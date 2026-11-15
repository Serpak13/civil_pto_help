<?php
declare(strict_types=1);

namespace App\Enums\Material;

enum Unit: string
{
    case CUBIC_METER = 'm3';
    case KILOGRAM = 'kg';
    case LITER = 'l';
    case SQUARE_METER = 'm2';
    case TON = 'ton';
    case METER = 'meter';
    case PIECE = 'pcs';

    /**
     * @param string $value
     * @return string
     */
    public static function getName(string $value): string
    {
        return match ($value) {
            self::CUBIC_METER->value => __('material.unit.cubic_meter'),
            self::KILOGRAM->value => __('material.unit.kilogram'),
            self::LITER->value => __('material.unit.liter'),
            self::SQUARE_METER->value => __('material.unit.square_meter'),
            self::TON->value => __('material.unit.ton'),
            self::METER->value => __('material.unit.meter'),
            self::PIECE->value => __('material.unit.piece'),
            default => __('material.unit.unknown')
        };
    }
}
