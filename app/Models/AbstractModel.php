<?php

namespace App\Models;

abstract class AbstractModel
{
    public function toJson(): string
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }

    public function toArray(): array
    {
        return json_decode($this->toJson(), 1);
    }

    abstract public static function fromArray(array $array);
}
