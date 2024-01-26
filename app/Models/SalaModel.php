<?php

namespace App\Models;

use CodeIgniter\Model;

class SalaModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'sala';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'predio',
        'numero_sala',
        'tamanho_m2',
        'locatario',
        'valor_ajustado',
        'calcao',
        'contrato',
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

    public function listSala()
    {
        return $this->select('
        sala.id, numero_sala, predio.nome, cliente.nome_cliente')
            ->where('sala.deleted_at', null)
            ->join('predio', 'predio.id = sala.predio', 'left')
            ->join('cliente', 'cliente.id = sala.locatario', 'left')
            ->findAll();
    }
}
