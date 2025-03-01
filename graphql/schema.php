<?php
require_once '../config/db_connect.php';  // Database connection
require_once '../vendor/autoload.php';    // Autoloader for composer dependencies
require_once 'types/QueryType.php';       // Correct the path to QueryType

use GraphQL\Type\Schema;
use Types\QueryType;

// Define the schema and pass the connection object
$schema = new Schema([
    'query' => new QueryType($conn)  // Pass the database connection to QueryType
]);

return $schema;
?>
