<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'username',
        'nome',
        'cpf',
        'rg',
        'status',
        'supervisor',
        'supervisor_senha',
        'status_message',
        'active',
        'last_active',
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

    public function listUser($id = null)
    {
        $this->select('*');
        $this->join('auth_identities', 'auth_identities.user_id = users.id');

        if (!empty($id)) {
            return $this->where('users.id', $id)->first();
        } else {
            return $this->where('deleted_at', null)->findAll();
        }
    }

    public function lista_usuarios(){
        return $this->select('id, username')->findAll();
    }

    public function verifica_supervisor($supervisor)
    {
        $data = $this->select()->where('id', $supervisor)->where('supervisor !=', null)->first();

        return !empty($data);
    }

    public function validar_senha($id, $senha){
        $data = $this->where('id', $id)->where('supervisor_senha', $senha)->first();

        return !empty($data);
    }
}
