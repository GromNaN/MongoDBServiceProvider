LExpress / MongoDBServiceProvider
===============================

Parameters
----------

 * **mongodb.server**: (optional) Server to connect.
   Example: `'mongodb.server' => 'mongodb://127.0.0.1:27017,127.0.0.1:27018'`

 * **mongodb.options**: Array of [MongoDB options](http://www.php.net/manual/en/mongoclient.construct.php)
  * **db**: DB name (required)
  * **username**: Authentication user
  * **password**: Authentication password
  * **replicaSet**: ReplicaSet name

Services
--------

 * **mongodb**: Instance of [`MongoDB`](http://www.php.net/manual/en/class.mongodb.php)

Using multiple connections
--------------------------

You can use many MongoDB connections by registering the service provider multiple times
with a different prefix passed to the constructor.

    use LExpress\Silex\MongoDBServiceProvider;

    $app->register(new MongoDBServiceProvider('mongodb.db1'), array(
        'mongodb.db1.options' => array(
            'db' => 'articles',
            'replicaSet' => 'rs1',
        ),
    ));

    $app->register(new MongoDBServiceProvider('mongodb.db2'), array(
        'mongodb.db2.options' => array(
            'db' => 'users',
            'username' => 'bar',
            'password' => 'secret',
        ),
    ));

That will register 2 services: `mongodb.db1` and `mongodb.db2`.
