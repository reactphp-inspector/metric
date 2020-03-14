<?php declare(strict_types=1);

namespace ReactInspector;

use function explode;

final class Measurement
{
    private float $value;

    private Tags $tags;

    public function __construct(float $value, Tags $tags)
    {
        $this->value = $value;
        $this->tags  = $tags;
    }

    public function __toString(): string
    {
        return $this->value . '#' . $this->tags();
    }

    public static function fromString(string $string): Measurement
    {
        [$value, $tags] = explode('#', $string);

        return new Measurement((float) $value, Tags::fromString($tags));
    }

    public function value(): float
    {
        return $this->value;
    }

    public function tags(): Tags
    {
        return $this->tags;
    }
}
