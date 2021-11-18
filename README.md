# My Books

## Description

This application allows you to manage your book library.

You arrive on the page that references all your books. You can then add a book, by selecting various information. You can also add an author, a publisher, a category and a location if they are not already present. Once the book is added, you can consult its page which includes all the information about it. You can also modify a book or delete it. Finally you will find on the page referencing all the books a search bar for titles, a set of filters and a sorting function.

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```
4. Import *database.sql* in your SQL server, you can do it manually or use the *migration.php* script which will import a *database.sql* file.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this manage your library.

