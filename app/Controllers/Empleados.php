<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;
use App\Models\SalariosModel;

class Empleados extends BaseController
{
    protected $empleados, $eliminados;
    protected $municipios;
    protected $cargos;
    protected $salarios;

    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->eliminados = new EmpleadosModel();
        $this->municipios = new MunicipiosModel();
        $this->cargos = new CargosModel();
        $this->salarios = new SalariosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $municipios = $this->municipios->obtenerMunicipios();
        $cargos = $this->cargos->obtenerCargos();

        $data = ['titulo' => 'Administrar Empleados', 'nombre' => 'Camilo', 'datos' => $empleados, 'municipios' => $municipios, 'cargos' => $cargos];
        
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    public function eliminados() //Mostrar vista de Empleados Eliminados
    {
        $eliminados = $this->eliminados->obtenerEmpleadosEliminados();

        if (!$eliminados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => 'Administrar Empleados Eliminados', 'nombre' => 'Camilo', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/empleados/eliminados', $data);
        }
    }
    public function cambiarEstado() //Eliminar el empleado cambiando el estado = Borrado Logico
    {
        $this->empleados->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/empleados'));
    }

    public function Restaurar() //Restaurar pais cambiando el estado
    {
        $this->empleados->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/empleados/eliminados'));
    }
    public function buscar_Emp($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $empleados_ = $this->empleados->traer_Emp($id);
        if (!empty($empleados_)) {
            array_push($returnData, $empleados_);
        }
        echo json_encode($returnData);
    }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->empleados->save([
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'nacimiento' => $this->request->getPost('nacimiento'),
                    'id_municipio' => $this->request->getPost('municipio'),
                    'id_cargo' => $this->request->getPost('cargo')
                ]);

                $id = $this->empleados->obtenerUltimo();

                $this->salarios->save([
                    'id_empleado' => $id,
                    'sueldo' => $this->request->getPost('salario'),
                    'periodo' => $this->request->getPost('periodo')
                ]);
            } else {
                $this->empleados->update($this->request->getPost('id'), [
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'nacimiento' => $this->request->getPost('nacimiento'),
                    'id_municipio' => $this->request->getPost('municipio'),
                    'id_cargo' => $this->request->getPost('cargo')
                ]);

                $id = $this->empleados->obtenerUltimo();

                $this->salarios->update($this->request->getPost('salario_id'), [
                    'sueldo' => $this->request->getPost('salario'),
                    'periodo' => $this->request->getPost('periodo')
                ]);
            }
            return redirect()->to(base_url('/empleados'));
        }
    }
    public function traer($id)
    {
        $returnData = array();
        $salarios_ = $this->salarios->traer($id);
        if (!empty($salarios_)) {
            array_push($returnData, $salarios_);
        }
        echo json_encode($returnData);
    }
    // public function buscar_Emp($id)
    // {
    //     $returnData = array();
    //     $empleados_ = $this->empleados->traer_Emp($id);
    //     if (!empty($empleados_)) {
    //         array_push($returnData, $empleados_);
    //     }
    //     echo json_encode($returnData);
    // }

}
