<?php declare(strict_types=1);

namespace ReactInspector;

final class Metric
{
    /**
     * @var Config
     */
    private $config;

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
     * @param Config        $config
     * @param Tag[]         $tags
     * @param Measurement[] $measurements
     * @param float         $time
     * @param string        $type
     */
    public function __construct(Config $config, array $tags, array $measurements, ?float $time = null, ?string $type = 'counter')
    {
        $this->config = $config;
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
        $this->time = $time ?? \microtime(true);
    }

    public function config(): Config
    {
        return $this->config;
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
