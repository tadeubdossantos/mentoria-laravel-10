<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestVenda;
use App\Http\Controllers\Controller;
use App\Mail\ComprovanteDeVendaMail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Facades\Mail;


class VendaController extends Controller
{
    public function __construct(Venda $venda) {
        $this->venda = $venda;
    }

    public function index(Request $request) {
        $pesquisar = $request->pesquisar;
        $findVenda = $this->venda->getVendasPesquisarIndex(search: $pesquisar ?? '');
        return view('pages.vendas.paginacao', compact('findVenda'));
    }

    public function cadastrarVenda(FormRequestVenda $request) {
        $findNumeracao = Venda::max('numero_da_venda') + 1;
        $findProduto = Produto::all();
        $findCliente = Cliente::all();

        // se a requisição é do tipo 'POST'
        if($request->method() == "POST") {
            $data = $request->all();
            $data['numero_da_venda'] = $findNumeracao;
            Venda::create($data);
            Toastr::success("Gravado com sucesso!");
            return redirect()->route('venda.index');
        }
        
        //mostrar dados
        // requisição do tipo 'GET', somente mostra os dados
        return view('pages.vendas.create', compact('findNumeracao', 'findProduto', 'findCliente'));    
    }

    // parâmetro é o id da venda
    public function enviaComprovantePorEmail($id) {
        $buscaVenda = Venda::where('id', '=', $id)->first();
        $produtoNome = $buscaVenda->produto->nome;
        $clienteNome = $buscaVenda->cliente->nome;
        $clienteEmail = $buscaVenda->cliente->email;
        $sendMailData = [
            'produtoNome' => $produtoNome,
            'clienteNome' => $clienteNome
        ];
        // realiza o envio de e-mail passado o endereço de e-mail,
        // passa como parâmetro uma instancia do 'ComprovanteDeVendaEmail'
        // passando um array com informações que irá conter nesta mensagem de e-mail 
        Mail::to($clienteEmail)->send(new ComprovanteDeVendaMail($sendMailData));
        Toastr::success("Email Enviado com Sucesso!");
        return redirect()->route('venda.index');
    }
}
