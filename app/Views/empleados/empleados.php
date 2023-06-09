<div class="container card my-4">
  <div>
    <h1 class="titulo_vista text-center" style="color:#0D6EFD;"><?php echo $titulo; ?></h1>

  </div>
  <div>
    <button type="button" class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalAgregar" onclick="seleccionarEmp(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
   <a href="<?php echo base_url('/eliminados_empleados'); ?>"> <button type="button" class="btn btn-outline-secondary">Eliminados</button></a>
  </div>

  <div id="layoutSidenav_content">

    <br>

    <div class="table-responsive">
    <table class="table table-bordered border-primary">
  <thead class="table-light">
    <tr style="font-family:Arial;font-size:12px; color:#0D6EFD" >
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Nacimiento</th>
            <th>Municipio</th> 
            <th>Cargo</th>
            <th>Salario</th>
            <th>Estado</th>
            <th colspan="2">Acciones</th>
     </tr>
  </thead>
  <tbody>
    <?php foreach ($datos as $x => $valor) { ?>
            <tr>
              <th class="text-center"><?php echo $valor['id']; ?></th>
              <th class="text-center"><?php echo $valor['nombres']; ?></th>
              <th class="text-center"><?php echo $valor['apellidos']; ?></th>
              <th class="text-center"><?php echo $valor['nacimiento']; ?></th>
              <th class="text-center"><?php echo $valor['NMuni']; ?></th>
              <th class="text-center"><?php echo $valor['NCargo']; ?></th>
              <th class="text-center">$ <?php echo $valor['salario']; ?></th>
              <th class="text-center"><?php echo $valor['estado']; ?></th>
              <th class="grid grid text-center" colspan="2">
                <button class="btn btn-outline-primary" onclick="seleccionarEmp(<?php echo $valor['id'] . ',' . 2 ?>);"><i class="bi bi-pen"></i></button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#EmpleadoModalElimiar" onclick="EliminarValid(<?php echo $valor['id'] ?>);"><i class="bi bi-recycle"></i></button>
              </th>

            </tr>
          <?php } ?>
  </tbody>
</table>
</div>
<!--   Modal eliminar   --->
<form method="POST" action="<?php echo base_url('/empleados/cambiarEstado'); ?>" class="form-check-inline">
    <div class="modal fade" id="EmpleadoModalElimiar" tabindex="-1" aria-labelledby="EmpleadoModalElimiar" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Estás seguro de eliminar este empleado?</h1>
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

    <!--   Modal agregar   --->
    <form method="POST" action="<?php echo base_url(); ?>/empleados/insertar" autocomplete="off">
      <div class="modal" tabindex="-1" role="dialog" id="modalAgregar">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Empleados</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="idcliente" class="col-form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
                <label for="nombrecliente" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                <div class="mb-3">
                  <label for="periodo" class="col-form-label">Nacimiento:</label>
                  <div class="flex ">
                    <select class="form-select" name="nacimiento" aria-label="periodo" id="nacimiento" required>
                      <option id="Seleccionado">-- Seleccionar Año --</option>
                      <?php $years = range(strftime("%Y", time()), 1940); ?>
                      <?php foreach ($years as $year) : ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
               

                <label for="nacimientoCliente" class="col-form-label">Municipio de Residencia</label>
                <select name="municipio" id="municipio" class="form-select form-select-lg mb-3" required>
                  <option id="MunicipioSeleccionado">-Seleccione un Municipio-</option>
                  <?php foreach ($municipios as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="municipio" id="municipio"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>
                <label for="cargo" class="col-form-label">Cargo</label>
                <select name="cargo" id="cargo" class="form-select form-select-lg mb-3" required>
                  <option id="CargoSeleccionado">-Seleccione un Cargo-</option>
                  <?php foreach ($cargos as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="cargo" id="cargo"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Salario $:</label>
                <div class="flex ">
                  <input type="number" name="salario" class="form-control" id="salario" required>

                </div>
              </div>
              <div class="mb-3">
                <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                <div class="flex ">
                  <select class="form-select" name="periodo" aria-label="periodo" id="periodo">
                    <option id="PeriodoSeleccionado">-- Seleccionar Año --</option>
                    <?php $years = range(strftime("%Y", time()), 1940); ?>
                    <?php foreach ($years as $year) : ?>
                      <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="text" id="salario_id" name="salario_id" hidden>
                  <input type="text" id="tp" name="tp" hidden>
                  <input type="text" id="id" name="id" hidden>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</div>



<script>
  function seleccionarEmp(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/empleados/buscar_Emp'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#codigo").val(rs[0]['codigo']);
          $("#nombres").val(rs[0]['nombres']);
          $("#apellidos").val(rs[0]['apellidos']);
          $("#MunicipioSeleccionado").val(rs[0]['id_municipio']);
          $("#MunicipioSeleccionado").text(rs[0]['NMuni']);
          $("#Seleccionado").text(rs[0]['nacimiento']);
          $("#Seleccionado").val(rs[0]['nacimiento']);
          $("#CargoSeleccionado").val(rs[0]['id_cargo']);
          $("#CargoSeleccionado").text(rs[0]['NCargo']);
          $("#salario").val(rs[0]['salario']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#salario_id").val(rs[0]['salario_id']);
          
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el país ' + rs[0]['nombre']);
          $("#modalAgregar").modal("show");
        }
      })
    } else {
      console.log("Else")
      $("#tp").val(1);
      $("#id").val("")
      $("#codigo").val("");
      $("#nombres").val("");
      $("#apellidos").val("");
      $("#MunicipioSeleccionado").val("");
      $("#Seleccionado").val("");
      $("#CargoSeleccionado").val("");
      $("#salario").val("");
      $("#PeriodoSeleccionado").val("");
      $("#salario_id").val("");
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo País');
      $("#PaisModal").modal("show");
    }
  };

  function EliminarValid(id) {
    dataURL = "<?php echo base_url('/empleados/buscar_Emp'); ?>" + "/" + id;
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
