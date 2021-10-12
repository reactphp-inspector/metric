<?php

declare(strict_types=1);

namespace ReactInspector;

use function explode;
use function implode;
use function Safe\ksort;

final class Tags
{
    /** @var array<string, Tag> */
    private array $tags = [];

    /**
     * @param array<int, Tag> $tags
     */
    public function __construct(Tag ...$tags)
    {
        $this->add(...$tags);
    }

    public function __toString(): string
    {
        ksort($this->tags);

        return implode(',', $this->tags);
    }

    public static function fromString(string $string): Tags
    {
        $tags = [];

        foreach (explode(',', $string) as $tag) {
            $tags[] = Tag::fromString($tag);
        }

        return new Tags(...$tags);
    }

    public function add(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            $this->tags[$tag->key()] = $tag;
        }
    }

    /**
     * @return array<string, Tag>
     */
    public function get(): array
    {
        return $this->tags;
    }
}
