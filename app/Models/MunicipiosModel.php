<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    protected $table = 'municipios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'estado', 'id_dpto', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerMunicipios()
    {
        $this->select('municipios.*, departamentos.nombre as Departamento');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->where('municipios.estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function traer_municipio($id)
    {
        $this->select('municipios.*, departamentos.nombre as Departamento, paises.nombre as Pnombre, paises.id as id_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->where('municipios.id', $id);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function obtenerMunicipiosEliminados()
    {
        $this->select('municipios.*, departamentos.nombre as Departamento');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->where('municipios.estado', 'I');
        $datos = $this->findAll();
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
}
