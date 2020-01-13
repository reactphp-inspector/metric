<?php declare(strict_types=1);

namespace ReactInspector\Tests;

use ReactInspector\Tag;
use ReactInspector\Tags;
use WyriHaximus\TestUtilities\TestCase;

/**
 * @internal
 */
final class TagsTest extends TestCase
{
    /**
     * @test
     */
    public function toAndFromString(): void
    {
        $tagA = new Tag('a', 'b');
        $tagC = new Tag('c', 'd');
        $tags = new Tags($tagA, $tagC);

        self::assertSame('a=b,c=d', (string)Tags::fromString((string)$tags));
    }
}
