<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#PaisModal">Agregar</button>
    <button type="button" class="btn btn-secondary">Eliminados</button>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
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
              <button class="btn btn-primary"><i class="bi bi-pen"></i></button></button>
              <button class="btn btn-danger">
              <i class="bi bi-recycle"></i>
              </button>
            </th>

          </tr>
        <?php } ?>
  </tbody>
</table>
</div>

  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('/cargos/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="modal fade" id="PaisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Cargo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="validationCustom01" required>
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