<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'funcionario';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'cpf',
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

    public function listar_funcionarios()
    {
        return $this->select('*')->findAll();
    }

    public function consultar_funcionario_por_id($id)
    {
        return $this->where('id', $id)->first();
    }

    public function verificar_cpf_do_funcionario($cpf)
    {
        $data = $this->where('cpf', $cpf)->first();

        if (!empty($data)) {
            return [
                'status' => true,
                'data' => $data
            ];
        }

        return [
            'status' => false,
            'data' => null
        ];
    }
}
