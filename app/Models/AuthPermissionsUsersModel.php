<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthPermissionsUsersModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'auth_permissions_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'user_id',
        'permission',
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

    public function userPermission($userId)
    {
        return $this->select('permission')
            ->where('user_id', $userId)
            ->get();
    }

    public function new($dados)
    {
        $data = [
            "user_id" => $dados["usuario"],
            "permission" => $dados["permissao"],
        ];

        return $this->insert($data);
    }
}
