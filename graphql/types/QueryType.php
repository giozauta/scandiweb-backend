<?php

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
                    'args' => [
                        'category' => [
                            'type' => Type::string(),
                            'defaultValue' => null,  // Optional category filter
                        ],
                    ],
                    'resolve' => function ($root, $args) use ($conn) {
                        // Check if category is provided; if not, fetch all products
                        $category = isset($args['category']) ? $args['category'] : null;

                        // Start building the query
                        $query = "
                            SELECT
                                products.id,
                                products.name,
                                products.in_stock,
                                products.description,
                                products.category_id,
                                products.brand,
                                products.category,
                                product_gallery.image_url,
                                prices.amount AS price
                            FROM products
                            LEFT JOIN product_gallery ON products.id = product_gallery.product_id
                            LEFT JOIN prices ON products.id = prices.product_id";

                        if ($category) {
                            $query .= " WHERE products.category = '{$category}'";
                        }

                        $result = $conn->query($query);
                        $products = [];

                        while ($row = $result->fetch_assoc()) {
                            if (!isset($products[$row['id']])) {
                                $products[$row['id']] = [
                                    'id'          => $row['id'],
                                    'name'        => $row['name'],
                                    'in_stock'    => $row['in_stock'],
                                    'description' => $row['description'],
                                    'category_id' => $row['category_id'],
                                    'brand'       => $row['brand'],
                                    'category'    => $row['category'],
                                    'images'      => [],
                                    'price'       => $row['price']
                                ];
                            }

                            // Add image_url to the product if it's not empty
                            if (!empty($row['image_url'])) {
                                $products[$row['id']]['images'][] = $row['image_url'];
                            }

                            // Ensure we capture the price (only if it exists in the result)
                            if (!empty($row['price'])) {
                                $products[$row['id']]['price'] = $row['price'];
                            }
                        }

                        return array_values($products);
                    }
                ]
            ]
        ]);
    }
}
?>
