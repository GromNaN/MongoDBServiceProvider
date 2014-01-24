<?php

namespace LExpress\Silex\Tests;

use LExpress\Silex\MongoServiceProvider;

class MongoServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithIncorrectPrefix()
    {
        $app = new Application();
        $app->register(new MongoServiceProvider(''));
    }

    public function testRegistration()
    {
        $app = new Application();
        $app->register(new MongoServiceProvider(), array(
            'mongodb.options' = array(
                'servers' => array(
                    array('host' => 'localhost'),
                ),
                ''
            ),
        ));

        $this->assertInstanceOf('MongoClient', $app['mongodb']);
    }
}