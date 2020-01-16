<?php declare(strict_types=1);

namespace ReactInspector;

final class Measurement
{
    /**
     * @var float
     */
    private $value;

    /**
     * @var Tags
     */
    private $tags;

    /**
     * @param float $value
     * @param Tags  $tags
     */
    public function __construct(float $value, Tags $tags)
    {
        $this->value = $value;
        $this->tags = $tags;
    }

    public function __toString(): string
    {
        return $this->value . '#' . (string)$this->tags();
    }

    public static function fromString(string $string): Measurement
    {
        [$value, $tags] = \explode('#', $string);

        return new Measurement((float)$value, Tags::fromString($tags));
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
