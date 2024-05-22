<?php

namespace App\Models;

use CodeIgniter\Model;

class ContratoModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'contrato';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'numero_contrato',
        'parte_envolvida_1',
        'parte_envolvida_2',
        'data_inicio',
        'data_termino',
        'valor_contrato',
        'termos_e_condicoes',
        'pdf_name_random',
        'pdf_name_origin',
        'pdf_type',
        'data_criacao',
        'status_contrato',
        'deleted_at'
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

    public function listContrato()
    {
        return $this->where("deleted_at", null)->findAll();
    }
}
