<?php declare(strict_types=1);

namespace ReactInspector;

final class Tags
{
    /** @var Tag[] */
    private $tags = [];

    /**
     * @param Tag[] $tags
     */
    public function __construct(Tag ...$tags)
    {
        $this->add(...$tags);
    }

    public function __toString(): string
    {
        \ksort($this->tags);

        return \implode(',', $this->tags);
    }

    public static function fromString(string $string): Tags
    {
        $tags = [];

        foreach (\explode(',', $string) as $tag) {
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

    public function get(): array
    {
        return $this->tags;
    }
}
