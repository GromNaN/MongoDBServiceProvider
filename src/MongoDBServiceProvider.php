<?php

namespace LExpress\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use MongoClient;

/**
 * This provider configures a connection on db's mongo
 * The connection is stored in the application with a prefix (default: mongodb)
 *
 * @author Mehdy Dara <mdara@eleven-labs.com>
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class MongoDBServiceProvider implements ServiceProviderInterface
{
    protected $prefix;

    /**
     * @param string $prefix Prefix name used to register the service provider in Silex.
     */
    public function __construct($prefix = 'mongodb')
    {
        if (!$prefix) {
            throw new \InvalidArgumentException('The specified prefix is not valid.');
        }

        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $prefix = $this->prefix;

        $app["$prefix.server"] = MongoClient::DEFAULT_HOST.':'.MongoClient::DEFAULT_PORT;
        $app["$prefix.options"] = array();

        $app[$prefix] = $this->getProviderHandler($prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        // Nothing to do
    }

    /**
     * Returns the anonymous function that will be used by the service provider
     * to handle accesses to the root prefix.
     *
     * @param  string      $prefix
     * @return MongoClient
     */
    protected function getProviderHandler($prefix)
    {
        return Application::share(function ($app) use ($prefix) {

            $options = $app["$prefix.options"];

            if (empty($options['db'])) {
                throw new \LogicException("You must define a db name in $prefix.options.");
            }

            $db = $options['db'];

            $mongoClient = new MongoClient($app["$prefix.server"], $options);

            return $mongoClient->$db;
        });
    }
}
