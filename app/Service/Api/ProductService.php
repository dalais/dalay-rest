<?php

namespace App\Service\Api;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * @var Request $request
     */
    public $request;

    /**
     * ProductService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function list()
    {
        if ($this->request->query('category_id')) {
            $products = Product::with(['category:id,name,description'])
                ->where('category_id', '=', $this->request->query('category_id'))
                ->paginate(10, ['id', 'name', 'short_description', 'price', 'category_id']);
            return ['products' => $products->toArray()];
        }
        $products = Product::with(['category:id,name,description'])
            ->paginate(10, ['id', 'name', 'short_description', 'price', 'category_id']);
        return ['products' => $products->toArray()];
    }

    /**
     * @param $id
     * @return array
     */
    public function one($id)
    {
        $product = Product::with([
            'category:id,name,description',
            'reviews'
        ])->select([
                'id',
                'name',
                'short_description',
                'description',
                'price',
                'average_rating',
                'category_id'
            ])
            ->findOrFail($id);
        $reviews = [];
        foreach ($product->reviews as $review) {
            $reviews[] = [
                'id' => $review->id,
                'user' => $review->user()->get(['id', 'name']),
                'review' => $review->review,
                'rating' => $review->rating
            ];
        }
        $product->unsetRelation('reviews');
        $product->setAttribute('reviews', $reviews);
        return $product->toArray();
    }
}
