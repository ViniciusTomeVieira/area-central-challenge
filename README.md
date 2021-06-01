# areacentral-challenge
    A software to manage products and sales (CRUD) made with PHP and JQuery

# how-to-access-database

    This is how the software finds the database

    $mysqli = new mysqli('localhost', 'root', '', 'areacentral') or die(mysqli_error($mysqli));
 
    So create a database called 'areacentral' and execute the sql commands in app/db/areacentral.sql

# how-to-execute

    Move this project folder to htdocs folder in C:/xampp
    Open index.php and start using it :)
