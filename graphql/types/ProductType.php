<?php
// File: types/ProductType.php

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Product',
            'fields' => [
                'id' => ['type' => Type::string()],
                'name' => ['type' => Type::string()],
                "in_stock" => ['type' => Type::int()],
                "description" => ['type' => Type::string()],
                "category_id" => ['type' => Type::int()],
                "brand" => ['type' => Type::string()],
            ]
        ]);
    }
}
?>
