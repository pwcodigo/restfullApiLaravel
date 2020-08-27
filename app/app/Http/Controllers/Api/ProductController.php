<?php

namespace App\Http\Controllers\Api {

    use App\API\ApiError;
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

            //$data = ['data'=> $this->product->paginate(5)];
            return response()->json($this->product->paginate(11));

        }

        public function show(Product $id)
        {
            $data = ['data' => $id];
            return response()->json($data);
        }

        public function store(Request $request)
        {
            //dd($request->all());
            // Aqui poderia fazer verificacoes das informacoes que vem do resquest depois aprendo fazer isso
            try{
                $productData = $request->all();
                $this->product->create($productData);
                return response()->json(['msg' => 'Produto criado com sucesso!'],201);
            } catch(\Exception $e){
                if(config('app.debug')){
                    return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                }
                    return response()->json(ApiError::errorMessage('Houve error ao realizar a operação', 1010));
            }


        }
    }
}
