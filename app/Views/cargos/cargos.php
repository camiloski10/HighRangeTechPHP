<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center" style="color:#0D6EFD;"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#PaisModal">Agregar</button>
    <a href="<?php echo base_url('/eliminados_cargos'); ?>"><button type="button" class="btn btn-outline-secondary">Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-outline-primary regresar_Btn">Regresar</a>
  </div>

  <br>
  <div class="table-responsive">
  <table class="table table-bordered border-primary">
  <thead class="table-light">
    <tr style="color:#0D6EFD;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
  </thead>
  <tbody>
   <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center "><?php echo $valor['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">
            <button class="btn btn-outline-primary" onclick="seleccionarCargo(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#PaisModal">

                <i class="bi bi-pen"></i>

              </button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#EmpleadoModalElimiar" onclick="EliminarValid(<?php echo $valor['id'] ?>);"><i class="bi bi-recycle"></i></button>
            </th>

          </tr>
        <?php } ?>
  </tbody>
</table>
</div>
<!--   Modal eliminar   --->
<form method="POST" action="<?php echo base_url('/cargos/cambiarEstado'); ?>" class="form-check-inline">
    <div class="modal fade" id="EmpleadoModalElimiar" tabindex="-1" aria-labelledby="EmpleadoModalElimiar" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Estás seguro de eliminar este cargo?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span>
              <h3 class="text-center" id="EmpleadoEliminar"></h3>
            </span>
            <input type="text" id="idE" name="id" hidden>
            <input type="text" id="estado" name="estado" hidden>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('/cargos/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="modal fade" id="PaisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Cargo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <input hidden type="text" class="form-control" name="tp" id="tp" required>
              <input hidden type="text" class="form-control" name="id" id="id" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
  function seleccionarCargo(id, tp) {
  if (tp == 2) {
    
    dataURL = "<?php echo base_url('/cargos/buscar_Cargo'); ?>" + "/" + id;
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {
        console.log(rs)
        $("#tp").val(2);
        $("#id").val(rs[0]['id']);
        $("#nombre").val(rs[0]['nombre']);
        $("#btn_Guardar").text('Actualizar');
        $("#tituloModal").text('Actualizar el cargo ' + rs[0]['nombre']);
        $("#PaisModal").modal("show");
      }
    })
  } else {
    console.log("Else")
    $("#tp").val(1);
    $("#id").val("");
    $("#nombre").val("");
    $("#estado").val("");

    $("#btn_Guardar").text('Guardar');
    $("#tituloModal").text('Agregar Nuevo Cargo');
    $("#modalAgregar").modal("show");
  }
};

  function EliminarValid(id) {
    dataURL = "<?php echo base_url('/cargos/buscar_Cargo'); ?>" + "/" + id;
    console.log(id)
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {
        $("#idE").val(rs[0]['id'])
        $("#estado").val('I');
        $("#empleadosEliminar").text(rs[0]['nombre']);
        $("#EmpleadoModalElimiar").modal("show");
      }
    })
  }
</script>