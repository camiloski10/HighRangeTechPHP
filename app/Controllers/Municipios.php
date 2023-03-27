<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\PaisesModel;
use App\Models\DepartamentosModel;

class Municipios extends BaseController
{
    protected $municipios, $eliminados;
    protected $pais;
    protected $departamentos;
    public function __construct()
    {
        $this->municipios = new MunicipiosModel();
        $this->pais = new PaisesModel();
        $this->departamentos = new DepartamentosModel();
    }
    public function index()
    {
        $municipios = $this->municipios->obtenerMunicipios();
        $pais = $this->pais->obtenerPaises();
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $data = ['titulo' => ' Municipios', 'nombre' => 'Camilo', 'datos' => $municipios, 'paises' => $pais, 'departamentos' => $departamentos];
        echo view('/principal/header', $data);
        echo view('/municipios/municipios', $data);
    }
    public function eliminados() //Mostrar vista de Municipios Eliminados
    {
        $eliminados = $this->municipios->obtenerMunicipiosEliminados();

        if (!$eliminados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => ' Municipios Eliminados', 'nombre' => 'Camilo', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/municipios/eliminados', $data);
        }
    }
    public function obtenerDepartamentosPais($id)
    {
        $dataArray = array();
        $departamentos = $this->departamentos->obtenerDepartamentosPais($id);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($departamentos);
    }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) { //tp 1 = Guardar
                $this->municipios->save([
                    'id_dpto' => $this->request->getPost('departamento'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else { //tp 2 = actualizar
                $this->municipios->update($this->request->getPost('id'), [
                    'id_pais' => $this->request->getPost('pais'),
                    'id_dpto' => $this->request->getPost('departamento'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            }
            return redirect()->to(base_url('/municipios'));
        }
        
    }
    public function buscar_municipio($id) //Funcion para buscar un municipio en especifico y devolverlo 
    {
        $returnData = array();
        $municipios_ = $this->municipios->traer_municipio($id);
        if (!empty($muncipios_)) {
            array_push($returnData, $municipios_);
        }
        echo json_encode($municipios_);
    }
    public function cambiarEstado($id, $estado)
    {
        $municipio_ = $this->municipios->cambiar_Estado($id, $estado);

        if (
            $estado == 'I'
        ) {
            return redirect()->to(base_url('/municipios'));
        } else {
            return redirect()->to(base_url('/municipios/eliminados'));
        }
    }
    public function Restaurar() //Restaurar municipio cambiando el estado
    {
        $this->municipios->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/municipios/eliminados'));
    }
}
