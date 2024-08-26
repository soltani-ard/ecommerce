<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductVariation;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function store($variations, $attributeId, $product): void
    {
        $this->storeVariations($variations, $product, $attributeId);
    }

    public function change($variations, $attributeId, $product): void
    {
        // delete old variations
        ProductVariation::where('product_id', $product->id)->delete();

        // set new
        $this->storeVariations($variations, $product, $attributeId);
    }

    public function update($variation_values): void
    {
        foreach ($variation_values as $key => $variationValue) {
            ProductVariation::where('id', $key)->update([
                'price' => $variationValue['price'],
                'quantity' => $variationValue['quantity'],
                'sku' => $variationValue['sku'],
                'sale_price' => $variationValue['sale_price'],
                'date_on_sale_from' => Verta::parse($variationValue['date_on_sale_from'])->datetime(),
                'date_on_sale_to' => Verta::parse($variationValue['date_on_sale_to'])->datetime(),
            ]);
        }
    }

    /**
     * @param $variations
     * @param $product
     * @param $attributeId
     * @return void
     */
    public function storeVariations($variations, $product, $attributeId): void
    {
        $variationCount = count($variations['value']);
        for ($i = 0; $i < $variationCount; $i++) {
            ProductVariation::create([
                'product_id' => $product->id,
                'attribute_id' => $attributeId,
                'value' => $variations['value'][$i],
                'price' => $variations['price'][$i],
                'quantity' => $variations['quantity'][$i],
                'sku' => $variations['sku'][$i],
                'sale_price' => $variations['sale_price'][$i],
                'date_on_sale_from' => Verta::parse($variations['date_on_sale_from'][$i])->datetime(),
                'date_on_sale_to' => Verta::parse($variations['date_on_sale_to'][$i])->datetime(),
            ]);
        }
    }
}
