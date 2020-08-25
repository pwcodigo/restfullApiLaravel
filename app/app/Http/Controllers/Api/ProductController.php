<?php

namespace App\Http\Controllers\Api {

    use App\Http\Controllers\Controller;
    use App\Product;
    use Illuminate\Http\Request;


    class ProductController extends Controller
    {

        /**
         * ProductController constructor.
         * @var Product
         */

        private $product;

        public function __construct(Product $product)
        {
            $this->product = $product;
        }

        public function index()
        {
            return $this->product->all();
        }

        public function show(Product $id)
        {
            return $id;
        }
    }
}
