## Purple Wave PHP Project

### Synopsis

CRUD w/ PHP

### Usage

Note: All examples use curl. Results may differ using postman or httpie.

### PHP

#### Create env.php

    touch env.php
    
#### env.php example

    <?php
      putenv('DB_NAME=database');
      putenv('DB_HOST=localhost');
      putenv('DB_USER=user');
      putenv('DB_PASSWORD=password');
    ?>
    
#### Start php server

    php -S <host>:<port>
    
#### GET all

    curl http://<host>/index.php
    
#### GET/:id

    curl http://<host>/index.php?id=<id>

#### POST

    curl -X POST http://<host>/index.php -d name=<name> -d attribute=<attribute>
    
#### PUT

    curl -X PUT http://<host>/index.php -d name=<string> -d attribute=<integer>
    
#### DELETE

    curl -X DELETE http://<host>/index.php?id=<id>
    
### index.js

#### Start server

    SERVER=http://<host>:<port> PORT=<port> node index.js
    
#### GET

    http http://<host>

#### GET/:id

    http http://<host>?id=<id>
    
#### POST

    http -f POST http://<host> name=<name> attribute=<attribute>
    
#### PUT

    http PUT http://<host>?id=<id> name=<name> attribute=<attribute>
    
#### DELETE

    http DELETE http://<host>?id=<id>
