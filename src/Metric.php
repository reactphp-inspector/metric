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
     * @var Measurements
     */
    private $measurements;

    /**
     * @param Config       $config
     * @param Tags         $tags
     * @param Measurements $measurements
     * @param float        $time
     */
    public function __construct(Config $config, Tags $tags, Measurements $measurements, ?float $time = null)
    {
        $this->config = $config;
        $this->tags = $tags;
        $this->measurements = $measurements;
        $this->time = $time ?? \microtime(true);
    }

    public function __toString(): string
    {
        return (string)$this->config . '%' . (string)$this->tags . '%' . (string)$this->measurements . '%' . $this->time;
    }

    public static function fromString(string $string): Metric
    {
        [$config, $tags, $measurements, $time] = \explode('%', $string);

        return new Metric(Config::fromString($config), Tags::fromString($tags), Measurements::fromString($measurements), (float)$time);
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
     * @return Measurements
     */
    public function measurements(): Measurements
    {
        return $this->measurements;
    }
}
