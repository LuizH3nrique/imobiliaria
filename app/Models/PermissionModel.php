<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\AuthPermissionsUsersModel;

class PermissionModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'description',
        'resource_name',
        'role_name',
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

    public function listPermission($id = null)
    {
        $this->select('id, name, created_at');

        if (!empty($id)) {
            return $this->where('permissions.id', $id)->first();
        } else {
            return $this->findAll();
        }
    }

    public function permissionUser()
    {
        return $this->select('permissions.name as permissions, GROUP_CONCAT(users.username) as users')
            ->join('auth_permissions_users', 'permissions.id = auth_permissions_users.permission', 'left')
            ->join('users', 'auth_permissions_users.user_id = users.id', 'left')
            ->groupBy('permissions.id')
            ->findAll();
    }

    public function listUserPermission($id, $verify = null)
    {
        

        if ($verify === "pages") {
            $pagesPermissionsModel = new AuthPermissionsPagesModel();
            $assignedPermissions = $pagesPermissionsModel->pagesPermission($id)->getResultArray();

            if (!empty($assignedPermissions)) {
                $assignedPermissionIds = array_column($assignedPermissions, 'group');

                return $this->select('id, name')
                    ->whereNotIn('id', $assignedPermissionIds)
                    ->findAll();
            } else {
                // Se não houver permissões atribuídas, retorna todas as permissões
                return $this->findAll();
            }
        } else {
            $userPermissionsModel = new AuthPermissionsUsersModel();
            $assignedPermissions = $userPermissionsModel->userPermission($id)->getResultArray();

            if (!empty($assignedPermissions)) {
                $assignedPermissionIds = array_column($assignedPermissions, 'permission');

                return $this->select('id, name')
                    ->whereNotIn('id', $assignedPermissionIds)
                    ->findAll();
            } else {
                // Se não houver permissões atribuídas, retorna todas as permissões
                return $this->findAll();
            }
        }
    }
}
