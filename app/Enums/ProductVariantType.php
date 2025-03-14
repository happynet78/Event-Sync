<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum ProductVariantType: string
{
    case RANGE = 'Range';

    case COLOR = 'Color';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => Str::title($case->name)])
            ->all();
    }
}
