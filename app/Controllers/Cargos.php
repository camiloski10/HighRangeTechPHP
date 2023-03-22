<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargosModel;

class Cargos extends BaseController
{
    protected $cargos, $eliminados;
    public function __construct()
    {
        $this->cargos = new CargosModel();
    }
    public function index()
    {
        $cargos = $this->cargos->obtenerCargos();

        $data = ['titulo' => 'Administrar Cargos', 'nombre' => 'Camilo', 'datos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/cargos/cargos', $data);
    }
    public function buscar_Cargo($id) //Funcion para buscar un cargo en especifico y devolverlo 
    {
        $returnData = array();
        $cargos_ = $this->cargos->traer_Cargo($id);
        if (!empty($cargos_)) {
            array_push($returnData, $cargos_);
        }
        echo json_encode($returnData);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post") {

            $this->cargos->save([
                'nombre' => $this->request->getPost('nombre')
            ]);
            return redirect()->to(base_url('/cargos'));
        }
    }
    public function eliminados() //Mostrar vista de Cargos Eliminados
    {
        $eliminados = $this->cargos->obtenerCargosEliminados();

        if (!$eliminados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => ' Cargos Eliminados', 'nombre' => 'Camilo', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/cargos/eliminados', $data);
        }
    }
    public function cambiarEstado() //Eliminar el cargo cambiando el estado = Borrado Logico
    {
        $this->cargos->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/cargos'));
    }
    public function Restaurar() //Restaurar cargo cambiando el estado
    {
        $this->cargos->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/cargos/eliminados'));
    }
}
