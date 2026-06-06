<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Container;

class ContainerTest extends TestCase
{
    private Container $container;

    protected function setUp(): void
    {
        $this->container = new Container();
    }

    public function test_it_binds_and_resolves_a_closure()
    {
        $this->container->bind('foo', function () {
            return new \stdClass();
        });

        $this->assertInstanceOf(\stdClass::class, $this->container->resolve('foo'));
    }

    public function test_it_binds_and_resolves_an_instance_via_closure()
    {
        $instance = new \stdClass();
        $instance->name = 'test';

        // Container doesn't have instance(), but we can bind a closure returning the instance
        $this->container->bind('std', function() use ($instance) { return $instance; });

        $resolved = $this->container->resolve('std');
        $this->assertSame($instance, $resolved);
        $this->assertEquals('test', $resolved->name);
    }

    public function test_it_resolves_singletons()
    {
        $this->container->singleton('random', function () {
            $obj = new \stdClass();
            $obj->val = rand(1, 10000);
            return $obj;
        });

        $obj1 = $this->container->resolve('random');
        $obj2 = $this->container->resolve('random');

        $this->assertSame($obj1, $obj2);
        $this->assertEquals($obj1->val, $obj2->val);
    }

    public function test_it_throws_exception_for_unbound_resolution()
    {
        $this->expectException(\Exception::class);
        $this->container->resolve('NonExistentClass');
    }
}
