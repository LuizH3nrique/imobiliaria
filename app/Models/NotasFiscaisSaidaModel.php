<?php

namespace App\Models;

use CodeIgniter\Model;

class NotasFiscaisSaidaModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'notas_fiscais_saida';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'tomador_id',
        'prestador_id',
        'payment_id',
        'servico_id',
        'valor',
        'data_pagamento',
        'documento_fiscal_saida',
        'documento_type_name_origin',
        'documento_type',
        'payment_status',
        'tipo_pagamento',
        'descricao',
        'deleted_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];

    // Callbacks
    protected $beforeInsert   = [];
    protected $beforeUpdate   = [];

    public function list(){
        return $this->
        select('notas_fiscais_saida.id, notas_fiscais_saida.documento_fiscal_saida,empresa.nome_empresarial, prestador.nome as prestador_nome, tipo_servico.descricao as servico_nome, payment_tipo.descricao as tipo_nome, valor, payment_status.descricao as status_nome')->
        join('empresa', 'empresa.id = tomador_id')->
        join('prestador', 'prestador.id = prestador_id')->
        join('tipo_servico', 'tipo_servico.id = servico_id')->
        join('payment_tipo', 'payment_tipo.id = tipo_pagamento')->
        join('payment_status', 'payment_status.id = payment_status')->
        findAll();
    }
}
