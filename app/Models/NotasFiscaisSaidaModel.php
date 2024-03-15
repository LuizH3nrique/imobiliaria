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
        'documento_fiscal_saida',
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
        return $this->findAll();
    }
}
