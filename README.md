LExpress / MongoDBServiceProvider
===============================

Parameters
-------------

 * **mongodb.server**: (optional) Server to connect.
   Example: `'mongodb.server' => 'mongodb://127.0.0.1:27017,127.0.0.1:27018'`

 * **mongodb.options**: (optional) Array of [MongoDB options](http://www.php.net/manual/en/mongoclient.construct.php)
   Example: `'mongodb.options' => array(
        'db'         => 'cards',
        'username'   => 'toto',
        'password'   => 'isAwesome',
        'replicaSet' => 'rs0',
    )`

Using multiple connections
--------------------------

You can use many MongoDB connections by registering the service provider multiple times
with a different prefix passed to the constructor.

    use LExpress\Silex\MongoDBServiceProvider;

    $app->register(new MongoDBServiceProvider('db1'));

    $app->register(new MongoDBServiceProvider('db2'));

That will register 2 services: `mongodb.db1` and `mongodb.db2`.
