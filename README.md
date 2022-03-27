# Task Manager App
 
A very simple application to manage projects and tasks.

Minimum system requirements -
1. Composer 2.2.7 or higher
2. Node Js 14.16.0 or higher
3. XAMPP 8.1.4 or higher

Steps for local installation -
1. Download the repository.
2. Extract the task-manager-app-main.zip file using WinRAR.
3. Copy the extracted content to the C:\xampp\htdocs folder.
4. Open the XAMPP control panel and start apache and MySQL.
5. Go to localhost and then phpMyAdmin from your web browser and create a new database. For eg. task_manager
6. Rename ".env.example" file to ".env"
7. Change database credentials in the .env file.

    - For Mysql Database
        - DB_CONNECTION=mysql
        - DB_HOST=127.0.0.1
        - DB_PORT=3306
        - DB_DATABASE=task_manager
        - DB_USERNAME=root
        - DB_PASSWORD=YOUR_PASSWORD

    - For Postgres Database
        - DB_CONNECTION=pgsql
        - DB_HOST=localhost
        - DB_PORT=5432
        - DB_DATABASE=task_manager
        - DB_USERNAME=postgres
        - DB_PASSWORD=YOUR_PASSWORD

Note: Change default connection value in cofig/database.php
    For mysql - 'default' => env('DB_CONNECTION', 'mysql'),
    For pgsql - 'default' => env('DB_CONNECTION', 'pgsql'),

8. Open the command prompt in your project folder and run "composer update" to download all project packages and dependencies.
9. Run "php artisan migrate" and "php artisan key:generate" to generate the key and migrate all the tables in the database.
10. Run "php artisan optimize" and "php artisan serve" to start your application at http://127.0.0.1:8000/
11. That's it.
12. Enjoy!

