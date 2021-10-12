<?php

declare(strict_types=1);

namespace ReactInspector;

use function explode;

final class Config
{
    private string $name;

    private string $type;

    private string $description;

    public function __construct(string $name, string $type, string $description)
    {
        $this->name        = $name;
        $this->type        = $type;
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->name . '*' . $this->type . '*' . $this->description;
    }

    public static function fromString(string $string): Config
    {
        [$name, $type, $description] = explode('*', $string, 3);

        return new Config($name, $type, $description);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }
}
