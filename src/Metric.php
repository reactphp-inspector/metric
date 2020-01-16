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
     * @var Tags
     */
    private $tags;

    /**
     * @var Measurement[]
     */
    private $measurements;

    /**
     * @param Config        $config
     * @param Tags          $tags
     * @param Measurement[] $measurements
     * @param float         $time
     * @param string        $type
     */
    public function __construct(Config $config, Tags $tags, array $measurements, ?float $time = null, ?string $type = 'counter')
    {
        $this->config = $config;
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
     * @return Tags
     */
    public function tags(): Tags
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
