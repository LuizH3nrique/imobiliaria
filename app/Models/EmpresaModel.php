<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'empresa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'numero_inscricao',
        'data_abertura',
        'nome_empresarial',
        'nome_fantasia',
        'porte',
        'codigo_atividade',
        'descricao_atividade',
        'codigo_natureza_juridica',
        'descricao_natureza_juridica',
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'bairro',
        'municipio',
        'uf',
        'endereco_eletronico',
        'telefone',
        'situacao_cadastral',
        'data_situacao_cadastral'
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

    public function readCompany()
    {
        return $this->select('*')->where('deleted_at', null)->findAll();
    }
}
