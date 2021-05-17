# Simple PHP CRUD made in MVC style

For this project you will need Composer https://getcomposer.org/

Next you need to run following: 

```bash
composer install
```

Then you need to rename .env.example to .env and enter your DB credentials.

For migrations and seeding we are using robmorgan/phinx.

To create phinx.php config file run:

```bash
vendor/bin/phinx init
```

In phinx.php under development environments add you DB credentials.

Next you need to run following command to migrate DB:

```bash
php vendor/bin/phinx migrate
```

and then to seed admin and users run:

```bash
php vendor/bin/phinx seed:run
```

now cd to public dir and run

```bash
php -S 127.0.0.1:8000
```

Now in your browser you can run the 127.0.0.1:8000 url and start the app.