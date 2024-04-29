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

    public function list(){
        return $this->findAll();
    }
}
