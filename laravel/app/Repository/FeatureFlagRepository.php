<?php

namespace App\Repository;

use App\Repository\Contracts\FeatureFlagInterface;
use App\Models\FeatureFlagModel;

class FeatureFlagRepository implements FeatureFlagInterface
{
    public function isEnabled(string $key): bool
    {
        return (bool) FeatureFlagModel::where('key', $key)
            ->value('enabled') ?? false;
    }
    
    public function getValue(string $key, mixed $default = null): mixed
    {
        $flag = FeatureFlagModel::where('key', $key)->first();
        return $flag ? $flag->value : $default;
    }
}