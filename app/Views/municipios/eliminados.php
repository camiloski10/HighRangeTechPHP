<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center color:#0D6EFD"><?php echo $titulo ?></h1>
  </div>
  <div>
    <a href="<?php echo base_url('/municipios'); ?>" class="btn btn-outline-primary regresar_Btn">Regresar</a>
  </div>

  <br>
  <div class="table-responsive">
  <table class="table table-bordered border-primary">
  <thead class="table-light">
    <tr style="color:#0D6EFD;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Nombre</th>
          <th>Departamento</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
  </thead>
  <tbody>
     <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center"><?php echo $valor['Departamento']; ?></th>
            <th class="text-center"><?php echo $valor['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">
              <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#Restaurar" onclick="Restaurar(<?php echo $valor['id'] ?>);"><i class="bi bi-arrow-clockwise"></i></button>
            </th>
            <!-- <td title="Activar Registro" data-bs-toggle="modal" data-bs-target="#Restaurar" href="#" data-href="<?php echo base_url('/municipios/eliminados') . '/' . $valor['id'] . '/' . 'A'; ?>"><i class="bi bi-arrow-clockwise"></i></td> -->

          </tr>
        <?php } ?>
  </tbody>
</table>
</div>

  <form method="POST" action="<?php echo base_url('/municipios/Restaurar'); ?>" class="form-check-inline">
    <div class="modal fade" id="Restaurar" tabindex="-1" aria-labelledby="Restaurar" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Desea Restaurar este Municipio?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span>
              <h3 class="text-center" id="MunicipioRestaurar"></h3>
            </span>
            <input type="text" id="id" name="id" hidden>
            <input type="text" id="estado" name="estado" hidden>
          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url('/municipios/eliminados') ?>"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></a>

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
    dataURL = "<?php echo base_url('/municipios/buscar_municipio'); ?>" + "/" + id;
    
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {

        console.log(rs)
        $("#id").val(rs['id'])
        $("#estado").val('A')
        $("#MunicipioRestaurar").text(rs['nombre']);
        $("#Restaurar").modal("show");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        console.log(status);
        console.log(error);
      }
    });
  }
</script>