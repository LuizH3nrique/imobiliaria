<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthPermissionsPagesModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'auth_permissions_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'page',
        'group',
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

    public function pagesPermission($page)
    {
        return $this->select('group')
            ->where('page', $page)
            ->get();
    }

    public function new($dados = null)
    {
    }

    public function listPermissions($page)
    {
        return $this->select("name")
        ->where("page", $page)
        ->join("permissions", "permissions.id = auth_permissions_pages.group")
        ->findAll();
        
    }
}
