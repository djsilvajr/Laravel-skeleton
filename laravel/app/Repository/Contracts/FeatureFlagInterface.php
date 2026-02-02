<?php

namespace App\Repository\Contracts;

interface FeatureFlagInterface
{
    public function isEnabled(string $key): bool;
    public function getValue(string $key, mixed $default = null): mixed;
}