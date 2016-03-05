<?php

namespace WyriHaximus\React\Tests\Inspector;

use Phake;
use React\EventLoop\LoopInterface;
use React\EventLoop\StreamSelectLoop;
use React\EventLoop\Timer\TimerInterface;
use WyriHaximus\React\Inspector\InfoProvider;
use WyriHaximus\React\Inspector\LoopDecorator;

class InfoProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var InfoProvider
     */
    protected $infoProvider;

    public function setUp()
    {
        parent::setUp();
        $this->loop = new LoopDecorator(new StreamSelectLoop());
        $this->infoProvider = new InfoProvider($this->loop);
    }

    public function tearDown()
    {
        $this->infoProvider = null;
        $this->loop = null;
        parent::tearDown();
    }

    public function testFutureTick()
    {
        $counters = $this->infoProvider->getCounters();
        $this->assertSame(0, $counters['ticks']['future']['current']);
        $this->assertSame(0, $counters['ticks']['future']['total']);
        $this->assertSame(0, $counters['ticks']['future']['ticks']);

        $this->loop->futureTick(function () {});

        $counters = $this->infoProvider->getCounters();
        $this->assertSame(1, $counters['ticks']['future']['current']);
        $this->assertSame(1, $counters['ticks']['future']['total']);
        $this->assertSame(0, $counters['ticks']['future']['ticks']);

        $this->loop->run();

        $counters = $this->infoProvider->getCounters();
        $this->assertSame(0, $counters['ticks']['future']['current']);
        $this->assertSame(1, $counters['ticks']['future']['total']);
        $this->assertSame(1, $counters['ticks']['future']['ticks']);
    }

    public function testNextTick()
    {
        $counters = $this->infoProvider->getCounters();
        $this->assertSame(0, $counters['ticks']['next']['current']);
        $this->assertSame(0, $counters['ticks']['next']['total']);
        $this->assertSame(0, $counters['ticks']['next']['ticks']);

        $this->loop->nextTick(function () {});

        $counters = $this->infoProvider->getCounters();
        $this->assertSame(1, $counters['ticks']['next']['current']);
        $this->assertSame(1, $counters['ticks']['next']['total']);
        $this->assertSame(0, $counters['ticks']['next']['ticks']);

        $this->loop->run();

        $counters = $this->infoProvider->getCounters();
        $this->assertSame(0, $counters['ticks']['next']['current']);
        $this->assertSame(1, $counters['ticks']['next']['total']);
        $this->assertSame(1, $counters['ticks']['next']['ticks']);
    }
}
