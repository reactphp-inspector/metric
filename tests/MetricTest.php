<?php declare(strict_types=1);

namespace ReactInspector\Tests;

use ReactInspector\Measurement;
use ReactInspector\Metric;
use ReactInspector\Tag;
use ReactInspector\UnexpectedValueException;
use WyriHaximus\TestUtilities\TestCase;

/**
 * @internal
 */
final class MetricTest extends TestCase
{
    /**
     * @test
     */
    public function throwExceptionOnNonTagsInTagArray(): void
    {
        self::expectException(UnexpectedValueException::class);
        self::expectExceptionMessageMatches('#Tag#');

        new Metric('name', [new Measurement(0.0)], []);
    }

    /**
     * @test
     */
    public function throwExceptionOnNonMeasurementsInMeasurementArray(): void
    {
        self::expectException(UnexpectedValueException::class);
        self::expectExceptionMessageMatches('#Measurement#');

        new Metric('name', [new Tag('key', 'value')], [new Tag('key', 'value')]);
    }

    /**
     * @test
     */
    public function expectedBehaviorGetters(): void
    {
        $tags = [new Tag('key', 'value')];
        $measurements = [new Measurement(0.0, new Tag('key', 'value'))];

        $metric = new Metric('name', $tags, $measurements);

        self::assertSame('name', $metric->name());
        self::assertSame($tags, $metric->tags());
        self::assertSame('key', $metric->tags()[0]->key());
        self::assertSame('value', $metric->tags()[0]->value());
        self::assertSame($measurements, $metric->measurements());
        self::assertSame(0.0, $metric->measurements()[0]->value());
        self::assertSame('key', $metric->measurements()[0]->tags()[0]->key());
        self::assertSame('value', $metric->measurements()[0]->tags()[0]->value());
        self::assertIsFloat( $metric->time());
    }
}
