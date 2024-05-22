<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionsPagesModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'permissions_pages';
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

    public function listPages()
    {
        return $this->where("deleted_at", null)->findAll();
    }
    public function permissionsPages()
    {
        return $this->select('permissions_pages.name as pages, GROUP_CONCAT(permissions.name) as permissions')
            ->join('auth_permissions_pages', 'permissions_pages.id = auth_permissions_pages.page', 'left')
            ->join('permissions', 'auth_permissions_pages.group = permissions.id', 'left')
            ->groupBy('permissions_pages.id')
            ->findAll();
    }

}
