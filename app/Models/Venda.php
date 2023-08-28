<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_da_venda',
        'produto_id',
        'cliente_id'
    ];

    // refere-se que essa venda pertece ao um produto
    public function produto() {
        return $this->belongsTo(Produto::class);
    }

    // refere-se que essa venda pertence ao um cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function getVendasPesquisarIndex(string $search = '') {
        $venda = $this->where(function($query) use ($search) {
            if($search) {
                $query->where('numero_da_venda', $search);
                $query->orWhere('numero_da_venda', 'LIKE', "%{$search}%");
            }
        })->get();

        return $venda;
    }
}
