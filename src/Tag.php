<?php

declare(strict_types=1);

namespace ReactInspector;

use function explode;

final class Tag
{
    private string $key;

    private string $value;

    public function __construct(string $key, string $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->key . '=' . $this->value;
    }

    public static function fromString(string $string): Tag
    {
        return new Tag(...explode('=', $string));
    }

    public function key(): string
    {
        return $this->key;
    }

    public function value(): string
    {
        return $this->value;
    }
}
