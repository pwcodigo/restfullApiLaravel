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
            return response()->json($this->product->paginate(10));

        }

        public function show(Product $id)
        {
            $data = ['data' => $id];
            return response()->json($data);
        }

        public function store(Request $request)
        {
            //dd($request->all());
            // Aqui poderia fazer verificações das informações que vem do request depois aprendo fazer isso
            try{
                $productData = $request->all();
                $this->product->create($productData);
                $datamsg = ['data' => ['msg' => 'Produto Criado com sucesso !']];
                return response()->json($datamsg,201);
            } catch(\Exception $e){
                if(config('app.debug')){
                    return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                }
                    return response()->json(ApiError::errorMessage('Houve error ao criar', 1010));
            }
        }

        public function update(Request $request, $id)
        {

            try {
                $productData = $request->all();
                $product = $this->product->find($id);
                $product->update($productData);

                $damasks = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
                return response()->json($damasks, 201);

            } catch (\Exception $e) {
                if(config('app.debug')){
                    return response()->json(ApiError::errorMessage($e->getMessage(),1011));
                }
                    return response()->json(ApiError::errorMessage('Houve um erro ao realizar ao atualizar', 1011));
            }
        }
        /*
         *  Product $id isso é chamado de indução de tipo
         */
        public function delete(Product $id)
        {
            try{
                $id->delete();
                return response()->json(['data' => ['msg' => 'Produto:'.$id->name.' removido com sucesso!']],200);
            }catch (\Exception $e){
                if(config('app.config'))
                {
                    return response()->json(ApiError::errorMessage($e->getMessage(),1012));
                }
                    return response()->json(ApiError::errorMessage('Houve erro ao deletar',1012));
            }
        }
    }
}
