<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    // public function index()
    // {
    //     //$products = $this->product->paginate(10);
    //     $products = $this->product->all();

    //     return response()->json($products);
    // }

    public function index(Request $request)
    {
        $products = $this->product;

        if($request->has('fields')){
            $fields = $request->get('fields');
            $products = $products->selectRaw($fields);
        }

        if($request->has('conditions')){
            $expressions = explode(';', $request->get('conditions'));

            foreach($expressions as $e){
                $exp = explode(':', $e);
                $products = $products->where($exp[0], $exp[1], $exp[2]);
            }

        }

        return response()->json($products->paginate(10));
    }

    public function show($id)
    {
        $product = $this->product->find($id);

        return response()->json($product);
    }

    public function save(ProductRequest $request)
    {
        $data = $request->all();
        $product = $this->product->create($data);

        return response()->json($product);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $product = $this->product->find($data['id']);
        $product->update($data);
        
        return response()->json($product);
    }

    public function excluir($id)
    {
        $product = $this->product->find($id);
        $product->delete();

        return response()->json(['data' => ['msg' => 'Produto foi removido com sucesso!']]);
    }
}
