<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\RegistroPontoModel;
use App\Models\UsuarioModel;

class RegistroPontoController extends BaseController
{
    public function index()
    {
        $empresa_model = new EmpresaModel();
        $data['empresa'] = $empresa_model->populaEmpresaSelect();

        $usuario_model = new UsuarioModel();
        $data['supervisor'] = $usuario_model->lista_usuarios();

        $data['content'] = view('registro-ponto/index', $data);

        return view('layouts/template_padrao', $data);
    }

    public function registrar()
    {
        // Obtendo dados do POST
        $foto = $this->request->getPost('foto');
        $data['funcionario'] = $this->request->getPost('funcionario');
        $data['lat'] = $this->request->getPost('localizacao_lat');
        $data['log'] = $this->request->getPost('localizacao_log');
        $data['predio'] = $this->request->getPost('predio');
        $data['supervisor'] = $this->request->getPost('supervisor');

        $registro_ponto_model = new RegistroPontoModel();
        $retorno_verifica_registro = $registro_ponto_model->verificar_se_funcionario_ja_registrou($data);
        // Verificando se já fez o registro do dia
        if ($retorno_verifica_registro['dados'] != null) {
            if ($retorno_verifica_registro['dados']['foto_saida'] != null && $retorno_verifica_registro['dados']['foto_entrada'] != null) {
                return $this->response->setJSON(body: [
                    'status' => false,
                    'message' => 'Esse funcionário já registrou sua entrada e saída de hoje!'
                ]);
            }
        }

        // Verificando se já registrou o ponto
        if ($retorno_verifica_registro['status'] === true) {
            // Registro de saída
            $registro_saida = [
                'supervisor_saida' => $data['supervisor'],
                'foto_saida' => $foto,
                'localizacao_lat_saida' => $data['lat'],
                'localizacao_log_saida' => $data['log'],
            ];

            if ($registro_ponto_model->set($registro_saida)->where('id', $retorno_verifica_registro['dados']['id'])->update()) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Registro de Ponto de Saída  realizado com Sucesso!',
                    'tipo' => 'saida'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Erro ao realizar o Registro de Ponto!'
                ]);
            }
        }

        if ($retorno_verifica_registro['status'] === false) {
            // Registro de entrada
            $registro_entrada = [
                'funcionario_id' => $data['funcionario'],
                'predio_id' => $data['predio'],
                'supervisor_entrada' => $data['supervisor'],
                'foto_entrada' => $foto,
                'localizacao_lat_entrada' => $data['lat'],
                'localizacao_log_entrada' => $data['log'],
            ];

            if ($registro_ponto_model->insert($registro_entrada)) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Registro de Ponto de Entrada realizado com Sucesso!',
                    'tipo' => 'entrada'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Erro ao realizar o Registro de Ponto!'
                ]);
            }
        }
    }

    public function consultar()
    {
        $registro_ponto_model = new RegistroPontoModel();
        $data['registro_ponto'] = $registro_ponto_model->listar_registro_ponto()->paginate(10);
        $data['pager'] = $registro_ponto_model->pager;

        $data['content'] = view('registro-ponto/consultar', $data);

        return view('layouts/template_padrao', $data);
    }

    public function consultar_detalhes()
    {
        $id = $this->request->getGet('id');

        $registro_ponto_model = new RegistroPontoModel();
        $data = $registro_ponto_model->consultar_registro_por_id($id);

        return json_encode($data);
    }
}
