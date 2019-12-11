<?php declare(strict_types=1);

namespace ReactInspector;

final class Measurement
{
    /**
     * @var float
     */
    private $value;

    /**
     * @var Tag[]
     */
    private $tags = [];

    /**
     * @param float $value
     * @param Tag[] $tags
     */
    public function __construct(float $value, Tag ...$tags)
    {
        $this->value = $value;
        $this->tags = $tags;
    }

    public function value(): float
    {
        return $this->value;
    }

    /**
     * @return Tag[]
     */
    public function tags(): array
    {
        return $this->tags;
    }
}
