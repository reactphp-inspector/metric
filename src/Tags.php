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

    public function add(Tag ...$tags)
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
