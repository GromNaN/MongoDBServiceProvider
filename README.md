LExpress / MongoServiceProvider
===============================

Parameters
-------------

 * **mongodb.servers**: Servers to connect. 
   Example: `localhost:27017,localhost:27018` for 2 servers.

 * **mongodb.options**: (optional) Array of [MongoDB options](http://www.php.net/manual/en/mongoclient.construct.php)

 * **mongodb.readPreference**: (optional) Read preference as [documented](http://docs.mongodb.org/manual/core/read-preference/#read-preference-modes).


Using multiple connections
--------------------------

You can use many MongoDB connections by registering the service provider multiple times
with a different prefix passed to the constructor.

    use LExpress\Silex\MongoServiceProvider;

    $app->register(new MongoServiceProvider('db1'), [
        'db1.options' => [ /* configuration for db1 */ ]
    ]);

    $app->register(new MongoServiceProvider('db2'), [
        'db2.options' => [ /* configuration for db2 */ ]
    ]);

That will register 2 services: `db1` and `db2`.
