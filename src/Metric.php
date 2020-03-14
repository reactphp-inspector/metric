<?php declare(strict_types=1);

namespace ReactInspector;

use function explode;
use function microtime;

final class Metric
{
    private Config $config;

    private float $time;

    private Tags $tags;

    private Measurements $measurements;

    public function __construct(Config $config, Tags $tags, Measurements $measurements, float $time)
    {
        $this->config       = $config;
        $this->tags         = $tags;
        $this->measurements = $measurements;
        $this->time         = $time;
    }

    public static function create(Config $config, Tags $tags, Measurements $measurements): self
    {
        return new self($config, $tags, $measurements, microtime(true));
    }

    public function __toString(): string
    {
        return $this->config . '%' . $this->tags . '%' . $this->measurements . '%' . $this->time;
    }

    public static function fromString(string $string): Metric
    {
        [$config, $tags, $measurements, $time] = explode('%', $string);

        return new Metric(Config::fromString($config), Tags::fromString($tags), Measurements::fromString($measurements), (float) $time);
    }

    public function config(): Config
    {
        return $this->config;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function tags(): Tags
    {
        return $this->tags;
    }

    public function measurements(): Measurements
    {
        return $this->measurements;
    }
}
