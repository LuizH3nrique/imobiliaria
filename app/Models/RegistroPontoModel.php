<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroPontoModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = 'registro_ponto';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'funcionario_id',
        'predio_id',
        'supervisor_entrada',
        'supervisor_saida',
        'foto_entrada',
        'foto_saida',
        'localizacao_lat_entrada',
        'localizacao_log_entrada',
        'localizacao_lat_saida',
        'localizacao_log_saida',
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

    public function verificar_se_funcionario_ja_registrou($data)
    {
        $data_atual = date('Y-m-d');
        $hora_atual = date('H:i:s');

        $registro = $this
            ->where('funcionario_id', $data['funcionario'])
            ->where('predio_id', $data['predio'])
            ->where('foto_entrada !=', null)
            ->where('DATE(created_at) =', $data_atual)
            ->first();

        if (!empty($registro)) {
            return [
                'status' => true,
                'dados' => $registro,
                'data' => $data_atual,
                'hora' => $hora_atual
            ];
        }

        return [
            'status' => false,
            'dados' => $registro,
            'data' => $data_atual,
            'hora' => $hora_atual
        ];
    }
}
