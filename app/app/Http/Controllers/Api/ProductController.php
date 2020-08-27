<?php

namespace App\Http\Controllers\Api {

    use App\Http\Controllers\Controller;
    use App\Product;
    use http\Env\Response;
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
            //$data = ['data' => $this->product->all()];
            /*
             * Fazer uma pagina com os dados vindo da API
             */

            $data = ['data'=> $this->product->paginate(5)];
            return response()->json($data);

        }

        public function show(Product $id)
        {
            $data = ['data' => $id];
            return response()->json($data);
        }
    }
}
