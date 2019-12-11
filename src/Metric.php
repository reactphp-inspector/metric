<?php declare(strict_types=1);

namespace ReactInspector;

final class Metric
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $time;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * @var Measurement[]
     */
    private $measurements;

    /**
     * @param string        $name
     * @param Tag[]         $tags
     * @param Measurement[] $measurements
     * @param float         $time
     */
    public function __construct(string $name, array $tags, array $measurements, ?float $time = null)
    {
        $this->name = $name;
        foreach ($tags as $tag) {
            if (!($tag instanceof Tag)) {
                throw UnexpectedValueException::expectedTag($tag);
            }
        }
        $this->tags = $tags;
        foreach ($measurements as $measurement) {
            if (!($measurement instanceof Measurement)) {
                throw UnexpectedValueException::expectedMeasurement($measurement);
            }
        }
        $this->measurements = $measurements;
        $this->time = $time ?? \hrtime(true) * 1e-9;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function time(): float
    {
        return $this->time;
    }

    /**
     * @return Tag[]
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * @return Measurement[]
     */
    public function measurements(): array
    {
        return $this->measurements;
    }
}
