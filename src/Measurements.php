<?php declare(strict_types=1);

namespace ReactInspector;

final class Measurements
{
    /** @var Measurement[] */
    private $measurements = [];

    /**
     * @param Measurement[] $measurements
     */
    public function __construct(Measurement ...$measurements)
    {
        $this->add(...$measurements);
    }

    public function __toString(): string
    {
        return \implode(';', $this->measurements);
    }

    public static function fromString(string $string): Measurements
    {
        $measurements = [];

        foreach (\explode(';', $string) as $tag) {
            $measurements[] = Measurement::fromString($tag);
        }

        return new Measurements(...$measurements);
    }

    public function add(Measurement ...$measurements): void
    {
        $this->measurements = \array_merge($this->measurements, $measurements);
    }

    public function get(): array
    {
        return $this->measurements;
    }
}
