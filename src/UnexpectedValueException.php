<?php declare(strict_types=1);

namespace ReactInspector;

final class UnexpectedValueException extends \UnexpectedValueException
{
    /** @var string */
    private $expectedType;

    /** @var string */
    private $receivedType;

    public static function expectedMeasurement($received): self
    {
        $self = new self('Items in rags array must be instanceof Measurement');
        $self->expectedType = Measurement::class;
        $self->receivedType = \is_object($received) ? \get_class($received) : \gettype($received);

        return $self;
    }
}
