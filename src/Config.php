<?php declare(strict_types=1);

namespace ReactInspector;

final class Config
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @param string $name
     * @param string $type
     * @param string $description
     */
    public function __construct(string $name, string $type, string $description)
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->name . '*' . $this->type . '*' . $this->description;
    }

    public static function fromString(string $string): Config
    {
        [$name, $type, $description] = \explode('*', $string, 3);

        return new Config($name, $type, $description);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }
}
