<div class="container card my-4">
<div>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
</div>

<body>
<h1 class="titulo_Vista text-center" style="color:#0D6EFD;"><?php echo $titulo ?></h1>

  <div>
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#AgregarSalario" onclick="seleccionaSalarios(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
    <a href="<?php echo base_url('/salarios/eliminados'); ?>"><button type="button" class="btn btn-outline-secondary">Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-outline-primary regresar_Btn">Regresar</a>
  </div>
  <br>
  <div class="table-responsive">
  <table class="table table-bordered border-primary">
  <thead class="table-light">
  <tr style="color:#0D6EFD;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Empleado</th>
          <th>Periodo</th>
          <th>Sueldo</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
  </thead>
  <tbody>
    <?php foreach ($salarios as $dato) { ?>
          <tr>
           <th><?php echo $dato['id']; ?></th>
            <th><?php echo $dato['nombre_empleado']; ?></th>
            <th><?php echo $dato['periodo']; ?></th>
            <th>$<?php echo $dato['sueldo']; ?></th>
            <th><?php echo $dato['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">
             <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="btn_guardar" data-bs-target="#AgregarSalario" onclick="seleccionaSalarios(<?php echo $dato['id'] . ',' . 2 ?>);">
             <i class="bi bi-pen"></i></button>
              <button type="button" class="btn btn-outline-danger" href="#" data-href="<?php echo base_url('/salarios/eliminar') . '/' .$dato['id']. '/' .'E'; ?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma" ><i class="bi bi-recycle"></i></button>
            </th>
           
            
          </tr>
        <?php } ?>
  </tbody>
</table>
</div>
 

  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('/salarios/insertarSalarios'); ?> " autocomplete="off">

    <div class="modal fade" data-bs-backdrop="static" id="AgregarSalario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titulo">Agregar Salario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
        
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Empleado:</label>
                <input id="id" name="id" hidden>
                <input id="tp" name="tp" hidden>
                <select name="empleado" id="empleado" class="form-select">
                  <option selected value="">Seleccionar Empleado</option>
                  <?php foreach ($empleados as $dato) { ?>
                    <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombres']; ?></option>
                  <?php } ?>
                </select>
              </div>
                    
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Periodo:</label>
                <input type="text" name="periodo" class="form-control" id="periodo">
              </div>

              <div class="mb-3">
                <label for="message-text" class="col-form-label">Sueldo:</label>
                <input type="text" name="sueldo" class="form-control" id="sueldo">
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btn_Guardar">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal Confirma Eliminar -->
  <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
                <div style="text-align:center;" class="modal-header">
                    <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>
                   
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Eliminar éste Registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
       <!-- Modal Elimina -->
       <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
        <div style="text-align:center;" class="modal-header">
          <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="modal-confirma">Eliminación de Registro</h5>

        </div>
        <div style="text-align:center;font-weight:bold;" class="modal-body">
          <p>Seguro Desea Eliminar éste Registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <script>
    function seleccionaSalarios(id, tp) {
      if (tp == 2) {
        dataURL = "<?php echo base_url('/salarios/buscar_Salarios'); ?>" + "/" + id;
        $.ajax({
          type: "POST",
          url: dataURL,
          dataType: "json",
          success: function(rs) {
            $("#tp").val(2);
            $("#id").val(id);
            $("#empleado").val(rs[0]['id_empleado']);
            $("#periodo").val(rs[0]['periodo']);
            $("#sueldo").val(rs[0]['sueldo']);
            $("#btn_Guardar").text('Actualizar');
            $("#titulo").text('Editar Salario');
            $("#AgregarSalario").modal("show");
          }
        })
      } else {
        $("#tp").val(1);
        $("#id").val('');
        $("#empleado").val('');
        $("#periodo").val('');
        $("#sueldo").val('');
        $("#btn_Guardar").text('Guardar');
        $("#titulo").text('Agregar Salario');
      }
    };
  </script>

<script>
    $('#modal-confirma').on('show.bs.modal', function(e){
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    })

  </script>

</body>