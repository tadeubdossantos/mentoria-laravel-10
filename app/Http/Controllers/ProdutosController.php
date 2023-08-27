<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
use App\Models\Produto;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Componentes;


class ProdutosController extends Controller
{
    public function __construct(Produto $produto) {
        $this->produto = $produto;
    }
    public function index(Request $request) {
        $pesquisar = $request->pesquisar;
        $findProduto = $this->produto->getProdutosPesquisIndex(search: $pesquisar ?? '');
        return view('pages.produtos.paginacao', compact('findProduto'));
    }
    
    public function delete(Request $request) {
        $id = $request->id;
        $buscaRegistro = Produto::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarProduto(FormRequestProduto $request) {
        // se a requisição é do tipo 'POST'
        if($request->method() == "POST") {
            $data = $request->all();
            //no campo valor trocamos a virgula por ponto para ser gravado no banco
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            Produto::create($data);

            Toastr::success("Gravado com sucesso!");
            return redirect()->route('produto.index');
        }
        // requisição do tipo 'GET', somente mostra os dados
        return view('pages.produtos.create');    
    }

    public function atualizarProduto(FormRequestProduto $request, $id) {
            // se a requisição é do tipo 'PUT'
            if($request->method() == "PUT") {
                //atualiza os dados
                $data = $request->all();
                //no campo valor trocamos a virgula por ponto para ser gravado no banco
                $componentes = new Componentes();
                $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
                
                //busca o registro e atualiza-o
                $buscaRegistro = Produto::find($id);
                $buscaRegistro->update($data);
                return redirect()->route('produto.index');
            }
        
        //consulta dos dados do registro
        $findProduto = Produto::where('id', '=', $id)->first();
        //passa a variável '$findProduto para à view'
        return view('pages.produtos.atualiza', compact('findProduto'));
    }
}
