<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Componentes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormRequestCliente;

class ClientesController extends Controller
{
    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }
    public function index(Request $request) {
        $pesquisar = $request->pesquisar;
        $findCliente = $this->cliente->getClientesPesquisIndex(search: $pesquisar ?? '');
        return view('pages.clientes.paginacao', compact('findCliente'));
    }
    
    public function delete(Request $request) {
        $id = $request->id;
        $buscaRegistro = Cliente::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarCliente(FormRequestCliente $request) {
        // se a requisição é do tipo 'POST'
        if($request->method() == "POST") {
            $data = $request->all();
            Cliente::create($data);

            Toastr::success("Gravado com sucesso!");
            return redirect()->route('cliente.index');
        }
        // requisição do tipo 'GET', somente mostra os dados
        return view('pages.clientes.create');    
    }

    public function atualizarCliente(FormRequestCliente $request, $id) {
            // se a requisição é do tipo 'PUT'
            if($request->method() == "PUT") {
                //atualiza os dados
                $data = $request->all();
                //no campo valor trocamos a virgula por ponto para ser gravado no banco
                $componentes = new Componentes();
                $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
                
                //busca o registro e atualiza-o
                $buscaRegistro = Cliente::find($id);
                $buscaRegistro->update($data);
                return redirect()->route('cliente.index');
            }
        
        //consulta dos dados do registro
        $findCliente = Cliente::where('id', '=', $id)->first();
        //passa a variável '$findCliente para à view'
        return view('pages.clientes.atualiza', compact('findCliente'));
    }
}
