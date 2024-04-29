<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestadorModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'prestador';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'documento',
        'nome',
        'tipo_pessoa',
        'telefone',
        'email',
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

    public function listPrestador()
    {
        return $this->select('prestador.id, prestador.documento, prestador.nome, prestador.telefone, prestador.email, tipo_pessoa.tipo')
            ->join('tipo_pessoa', 'tipo_pessoa.id = prestador.tipo_pessoa')
            ->findAll();
    }

    public function listPrestadorId($id)
    {
        return $this->select('*')->where('prestador.id', $id)->first();
    }
}
