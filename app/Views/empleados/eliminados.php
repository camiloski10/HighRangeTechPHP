<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <a href="<?php echo base_url('/paises'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
  </div>

  <br>
  <div class="table-responsive">
  <table class="table table-bordered border-primary">
  <thead class="table-light">
  <tr style="color:#0D6EFD;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
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
              <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#PaisRestaurar" onclick="Restaurar(<?php echo $valor['id'] ?>);"><i class="bi bi-arrow-clockwise"></i></button>
            </th>

          </tr>
        <?php } ?>
  </tbody>
</table>
</div>

  <form method="POST" action="<?php echo base_url('/empleados/Restaurar'); ?>" class="form-check-inline">
    <div class="modal fade" id="Restaurar" tabindex="-1" aria-labelledby="Resturar" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Desea Restaurar este empleado?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span>
              <h3 class="text-center" id="EmpleadosRestaurar"></h3>
            </span>
            <input type="text" id="idR" name="id" hidden>
            <input type="text" id="estado" name="estado" hidden>
          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url('/empleados/eliminados') ?>"><button type="button close" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></a>

            <!-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button> -->
            <button type="submit" class="btn btn-outline-success">Restaurar</button>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>

<script>
  function Restaurar(id) {
    dataURL = "<?php echo base_url('/empleados/buscar_Emp'); ?>" + "/" + id;
    console.log(id)
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {
        $("#idR").val(rs[0]['id'])
        $("#estado").val('A')
        $("#empleadosRestaurar").text(rs[0]['nombre']);
        $("#Restaurar").modal("show");
      }
    })
  }
</script>