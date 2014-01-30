<?php

namespace LExpress\Silex\Tests;

use Silex\Application;
use LExpress\Silex\MongoDBServiceProvider;

class MongoDBServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithIncorrectPrefix()
    {
        $app = new Application();
        $app->register(new MongoDBServiceProvider(''));
    }

    public function testRegistration()
    {
        $app = new Application();
        $app->register(new MongoDBServiceProvider(), array(
            'mongodb.options' => array(
                'db' => 'test',
            ),
            'mongodb.server' => 'mongodb://172.26.7.74:27017/'
        ));

        $this->assertInstanceOf('MongoDB', $app['mongodb']);
    }
}
