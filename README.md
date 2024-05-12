# nette-doctrine-shop-2.0

## EN
We will start the entire project using the command `make up` in the terminal within the folder where the `Makefile` is located (in our case, in the `nette-doctrine-shop-20` folder).

It is necessary to have the ports `80`, `8080`, and `3306` available (if they are not available, they need to be released or adjusted as needed in the `docker-compose.yml` file).

If everything goes well, the following output will be displayed in the terminal:

```bash
make up
docker-compose up -d --build --force-recreate --remove-orphans
Building php
Recreating nette-doctrine-shop-20_db_1 ... done
Recreating nette-doctrine-shop-20_adminer_1 ... done
Recreating nette-doctrine-shop-20_php_1     ... done
Recreating nette-doctrine-shop-20_web_1     ... done
@stats:{cmd:"make up" sys:0.31s usr:1.93s cpu:19% wall:11.638s mem:43k}
```

If an error occurs, it is necessary to identify the cause and resolve it.

The web server is accessible at [http://localhost:80](http://localhost:80).
Adminer is accessible at [http://localhost:8080](http://localhost:8080).
The login credentials for Adminer are:
- System: MySQL
- Server: db
- Username: root
- Password: toor
- Database: mydb

Using `docker exec -it --user www-data nette-doctrine-shop-20_php_1 bash`, we can enter the container to run additional commands.
