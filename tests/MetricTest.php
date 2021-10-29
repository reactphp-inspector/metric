<?php

declare(strict_types=1);

namespace ReactInspector\Tests;

use ReactInspector\Config;
use ReactInspector\Measurement;
use ReactInspector\Measurements;
use ReactInspector\Metric;
use ReactInspector\Tag;
use ReactInspector\Tags;
use WyriHaximus\TestUtilities\TestCase;

use function array_key_exists;

/** @internal */
final class MetricTest extends TestCase
{
    private Config $config;

    private Tags $tags;

    private Measurements $measurements;

    private Metric $metric;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = new Config('name', 'counter', 'A little help *explaining* the why for this metric');
        $this->tags   = new Tags(new Tag('key', 'value'));
        $this->tags->add(new Tag('ghi', 'jkl'));
        $this->measurements = new Measurements(new Measurement(12.34, new Tags(new Tag('key', 'value'))));
        $this->measurements->add(new Measurement(43.21, new Tags(new Tag('abd', 'def'))));

        $this->metric = Metric::create($this->config, $this->tags, $this->measurements);
    }

    /**
     * @test
     */
    public function expectedBehaviorGetters(): void
    {
        self::assertSame('name', $this->metric->config()->name());
        self::assertSame('counter', $this->metric->config()->type());
        self::assertSame('A little help *explaining* the why for this metric', $this->metric->config()->description());
        self::assertSame($this->tags, $this->metric->tags());
        self::assertTrue(array_key_exists('key', $this->metric->tags()->get()));
        self::assertSame('value', $this->metric->tags()->get()['key']->value());
        self::assertSame($this->measurements, $this->metric->measurements());
        self::assertSame(12.34, $this->metric->measurements()->get()[0]->value());
        self::assertTrue(array_key_exists('key', $this->metric->measurements()->get()[0]->tags()->get()));
        self::assertSame('value', $this->metric->measurements()->get()[0]->tags()->get()['key']->value());
        self::assertGreaterThan(0.0, $this->metric->time());
    }

    /**
     * @test
     */
    public function toAndFromStringConversion(): void
    {
        self::assertSame(
            'name*counter*A little help *explaining* the why for this metric%ghi=jkl,key=value%12.34#key=value;43.21#abd=def%' . $this->metric->time(),
            (string) Metric::fromString((string) $this->metric)
        );
    }
}
