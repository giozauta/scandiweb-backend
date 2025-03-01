<?php
// File: types/QueryType.php

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType {
    public function __construct($conn) {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(new ProductType()),
                    'resolve' => function() use ($conn) {
                        $result = $conn->query("SELECT id, name, in_stock, description, category_id, brand FROM products");
                        $products = [];
                        while ($row = $result->fetch_assoc()) {
                            $products[] = $row;
                        }
                        return $products;
                    }
                ]
            ]
        ]);
    }
}

?>
