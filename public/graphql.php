<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once '../vendor/autoload.php';
require_once '../graphql/schema.php';

use GraphQL\GraphQL;

header('Content-Type: application/json');

try {
    // Read the raw input from the request
    $rawInput = file_get_contents('php://input');

    // Log raw input to debug (make sure data is coming through)
    file_put_contents('php://stderr', "Raw Input: $rawInput\n");

    // Decode the input from JSON to an associative array
    $input = json_decode($rawInput, true);

    // Log the decoded input (check the structure of the input)
    file_put_contents('php://stderr', "Decoded Input: " . print_r($input, true) . "\n");

    // Check if query is provided in the input
    if (empty($input['query'])) {
        throw new Exception('No query provided');
    }

    // Extract the query from the input
    $query = $input['query'];

    // Execute the query against the schema
    $result = GraphQL::executeQuery($schema, $query);

    // Convert the result to an array and send it as JSON
    $output = $result->toArray();

} catch (\Exception $e) {
    // Catch any exceptions and return the error message
    $output = ['error' => $e->getMessage()];
}

// Return the response as JSON
echo json_encode($output);
?>
