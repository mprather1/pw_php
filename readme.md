## Purple Wave PHP Project

### Synopsis

CRUD w/ PHP

### Usage

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