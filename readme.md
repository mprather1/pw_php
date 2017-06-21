## Purple Wave PHP Project

### Synopsis

CRUD w/ PHP

### Usage

Note: All examples use httpie. Results may differ using curl or postman.

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
    
#### /get.php

    http http://<host>/get.php
    
#### /get_one.php

    http http://<host>/get_one.php?id=<id>

#### /post.php

    http -f POST http://<host>/post.php name=<name> attribute=<attribute>
    
#### /update.php

    http -f POST http://<host>/update.php?id=<id> name=<name> attribute=<attribute>
    
#### /delete.php

    http -f POST http://<host>/delete.php id=<id>
    
### index.js

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
