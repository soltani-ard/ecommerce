<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function store($product, $attributes): void
    {
        foreach ($attributes as $key => $attributeValue) { // key = attribute id
            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $key,
                'value' => $attributeValue
            ]);
        }
    }

    public function update($attribute_values): void
    {
        foreach ($attribute_values as $key => $attributeValue) {
            $productAttribute = ProductAttribute::where('attribute_id', $key)->first();
            $productAttribute->update([
                'value' => $attributeValue,
            ]);
        }
    }

    public function change($product, $attributes): void
    {
        // delete old attributes
        ProductAttribute::where('product_id', $product->id)->delete();

        // set new attributes
        foreach ($attributes as $key => $attributeValue) { // key = attribute id
            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $key,
                'value' => $attributeValue
            ]);
        }
    }
}
