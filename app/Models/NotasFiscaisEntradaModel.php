<?php

namespace App\Models;

use CodeIgniter\Model;

class NotasFiscaisEntradaModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'notas_fiscais_entrada';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'empresa_id',
        'cliente_id',
        'tipo_servico',
        'tipo_pagamento',
        'valor',
        'data_pagamento',
        'descricao',
        'chave_pix',
        'documento_fiscal_entrada',
        'documento_type_name_origin',
        'documento_type',
        'payment_entrada_id',
        'payment_status',
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

    public function list()
    {
        return $this->select('notas_fiscais_entrada.id, notas_fiscais_entrada.data_pagamento, notas_fiscais_entrada.documento_fiscal_entrada, empresa.nome_empresarial as empresa_nome, cliente.nome_cliente, tipo_servico.descricao as servico_nome, payment_tipo.descricao as tipo_nome, valor, payment_status.descricao as status_nome')
            ->join('empresa', 'empresa.id = notas_fiscais_entrada.empresa_id', 'left')
            ->join('cliente', 'cliente.id = notas_fiscais_entrada.cliente_id', 'left')
            ->join('tipo_servico', 'tipo_servico.id = notas_fiscais_entrada.tipo_servico', 'left')
            ->join('payment_tipo', 'payment_tipo.id = notas_fiscais_entrada.tipo_pagamento', 'left')
            ->join('payment_status', 'payment_status.id = notas_fiscais_entrada.payment_status', 'left')
            ->orderBy('notas_fiscais_entrada.id', 'DESC')
            ->findAll();
    }

    public function sumEntrada()
    {
        return $this->selectSum('valor', 'total_gastos')->first();
    }

    public function listEntradaPorServico()
    {
        return $this->select('tipo_servico.descricao')
            ->selectSum('valor', 'total_entrada')
            ->join('tipo_servico', 'tipo_servico.id = notas_fiscais_entrada.tipo_servico')
            ->groupBy('tipo_servico.descricao')
            ->findAll();
    }

    public function mesAnoGastos()
    {
        return $this->select("MONTH(data_pagamento) as mes, YEAR(data_pagamento) as ano, MONTHNAME(data_pagamento) as nome_mes")->distinct("MONTH(data_pagamento) as mes, YEAR(data_pagamento) as ano")
            ->orderBy('data_pagamento', 'ASC')
            ->findAll();
    }

    public function listaGastosPorMes($mes, $ano)
    {
        return $this->select('tipo_servico, tipo_servico.descricao, SUM(valor) as total_entradas')
            ->join('tipo_servico', 'tipo_servico.id = notas_fiscais_entrada.tipo_servico')
            ->where('MONTH(data_pagamento)', $mes)
            ->where('YEAR(data_pagamento)', $ano)
            ->groupBy('tipo_servico, tipo_servico.descricao')
            ->findAll();
    }

    public function getInfoEntradaPorMesAno($mes, $ano)
    {
        return $this->select('notas_fiscais_entrada.id, notas_fiscais_entrada.data_pagamento, notas_fiscais_entrada.documento_fiscal_entrada, empresa.nome_empresarial as empresa_nome, cliente.nome_cliente, tipo_servico.descricao as servico_nome, payment_tipo.descricao as tipo_nome, valor, payment_status.descricao as status_nome')
            ->where('MONTH(data_pagamento)', $mes)
            ->where('YEAR(data_pagamento)', $ano)
            ->join('empresa', 'empresa.id = notas_fiscais_entrada.empresa_id', 'left')
            ->join('cliente', 'cliente.id = notas_fiscais_entrada.cliente_id', 'left')
            ->join('tipo_servico', 'tipo_servico.id = notas_fiscais_entrada.tipo_servico', 'left')
            ->join('payment_tipo', 'payment_tipo.id = notas_fiscais_entrada.tipo_pagamento', 'left')
            ->join('payment_status', 'payment_status.id = notas_fiscais_entrada.payment_status', 'left')
            ->orderBy('notas_fiscais_entrada.id', 'DESC')
            ->findAll();
    }

    public function getInfoEntradaSomaPorMesAno($mes, $ano){
        return $this->selectSum('valor')
        ->where('MONTH(data_pagamento)', $mes)
        ->where('YEAR(data_pagamento)', $ano)
        ->first();
    }
}
