<?php

namespace Queries;

class ProductQuery {
    const GET_PRODUCTS = "
        SELECT 
            products.id, 
            products.name, 
            products.in_stock, 
            products.description, 
            products.category_id, 
            products.brand, 
            product_gallery.image_url
        FROM products 
        JOIN product_gallery ON products.id = product_gallery.product_id;
    ";
}