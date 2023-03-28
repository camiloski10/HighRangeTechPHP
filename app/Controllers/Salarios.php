<?php
namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\SalariosModel;
use App\Models\EmpleadosModel;

class Salarios extends BaseController
{
    protected $salarios;
    protected $empleados;

    public function __construct()
    {
        $this-> salarios = new SalariosModel();
        $this -> empleados = new EmpleadosModel();
    }
    public function index()
    {
        $salarios = $this->salarios->obtenerSalarios();
        $empleados= $this-> empleados->findAll(); 
        $data = ['titulo' => 'Salarios', 'nombre' => 'Camilo Castillo', 'salarios' => $salarios, 'empleados'=>$empleados]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
        echo view('/principal/header', $data);
        echo view('/salarios/salarios', $data);

        //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
    }

    public function buscar_Salarios($id)
    {
        $returnData = array();
        $salarios_ = $this->salarios->traer_Salarios($id);
        if (!empty($salarios_)) {
            array_push($returnData, $salarios_);
        }
        echo json_encode($returnData);
    }

    public function insertarSalarios()
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->salarios->save([
                    'id_empleado' => $this->request->getPost('empleado'),
                    'periodo' => $this->request->getPost('periodo'),
                    'sueldo' => $this->request->getPost('sueldo'),
                ]);

            } else {
                $this->salarios->update($this->request->getPost('id'), [
                    'id_empleado' => $this->request->getPost('empleado'),
                    'periodo' => $this->request->getPost('periodo'),
                    'sueldo' => $this->request->getPost('sueldo'),
                ]);

            }
            return redirect()->to(base_url('/salarios'));
        }
    }

    public function eliminados()
    {
        $salarios = $this->salarios->eliminados_salarios();
        $data = ['titulo' => 'Salarios Eliminados', 'titulo' => 'High Range Tech', 'nombre' => 'Camilo Castillo', 'salarios' => $salarios];
        if (!$salarios) {
            echo view('/errors/html/no_eliminados');
        }else{
        echo view('/principal/header', $data);
        echo view('/salarios/eliminados', $data);
        }
    }

    public function eliminar($id, $estado)
    {
        $salarios_ = $this->salarios->eliminarSalarios($id, $estado);
        return redirect()->to(base_url('/salarios'));
    }

    public function eliminarS($id, $estado)
    {
        $this->salarios->eliminarSalarios($id, $estado);
        return redirect()->to(base_url('/salarios/eliminados'));
    }

}