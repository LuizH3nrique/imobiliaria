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

    public function listar_registro_ponto()
    {
        return $this->select('
            registro_ponto.id,
            registro_ponto.created_at,
            registro_ponto.updated_at,
            registro_ponto.foto_entrada,
            registro_ponto.foto_saida,
            registro_ponto.localizacao_lat_entrada,
            registro_ponto.localizacao_log_entrada,
            registro_ponto.localizacao_lat_saida,
            registro_ponto.localizacao_log_saida,
            funcionario.id as funcionario_id,
            funcionario.nome as funcionario_nome,
            funcionario.cpf as funcionario_cpf,
            predio.id as predio_id,
            predio.nome as predio_nome,
            supervisor_entrada.nome as supervisor_entrada_nome,
            supervisor_saida.nome as supervisor_saida_nome
        ')
            ->join('funcionario', 'funcionario.id = registro_ponto.funcionario_id')
            ->join('predio', 'predio.id = registro_ponto.predio_id')
            ->join('users as supervisor_entrada', 'supervisor_entrada.id = registro_ponto.supervisor_entrada')
            ->join('users as supervisor_saida', 'supervisor_saida.id = registro_ponto.supervisor_saida', 'left')
            ->orderBy('id', 'DESC');
    }

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

    public function consultar_registro_por_id($id)
    {
        return $this->select('
            registro_ponto.id,
            registro_ponto.created_at,
            registro_ponto.updated_at,
            registro_ponto.foto_entrada,
            registro_ponto.foto_saida,
            registro_ponto.localizacao_lat_entrada,
            registro_ponto.localizacao_log_entrada,
            registro_ponto.localizacao_lat_saida,
            registro_ponto.localizacao_log_saida,
            funcionario.id as funcionario_id,
            funcionario.nome as funcionario_nome,
            funcionario.cpf as funcionario_cpf,
            predio.id as predio_id,
            predio.nome as predio_nome,
            supervisor_entrada.nome as supervisor_entrada_nome,
            supervisor_saida.nome as supervisor_saida_nome
        ')
            ->where('registro_ponto.id', $id)
            ->join('funcionario', 'funcionario.id = registro_ponto.funcionario_id')
            ->join('predio', 'predio.id = registro_ponto.predio_id')
            ->join('users as supervisor_entrada', 'supervisor_entrada.id = registro_ponto.supervisor_entrada')
            ->join('users as supervisor_saida', 'supervisor_saida.id = registro_ponto.supervisor_saida', 'left')
            ->first();
    }
}
