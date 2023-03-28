<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center" style="color:#0D6EFD;"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" onclick="seleccionaMunicipio(<?php echo 1 . ',' . 1 ?>);"  class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#MuniModal">Agregar</button>
    <a href="<?php echo base_url('/municipios/eliminados'); ?>"><button type="button" class="btn btn-outline-secondary">Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-outline-primary regresar_Btn">Regresar</a>
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
    <?php foreach ($datos as $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center"><?php echo $valor['Departamento']; ?></th>
            <th class="text-center"><?php echo $valor['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">
            <button class="btn btn-outline-primary" onclick="seleccionaMunicipio(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#MuniModal">
              <i class="bi bi-pen"></i></button>

              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/municipios/cambiarEstado') . '/' . $valor['id'] . '/' . 'I'; ?>"><i class="bi bi-recycle"></i></button>
              </button>
            </th>

          </tr>
        <?php } ?>
  </tbody>
</table>
</div>

<!-- Modal Confirma Eliminar -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div style="text-align:center;" class="modal-header">
          <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>

        </div>
        <div style="text-align:center;font-weight:bold;" class="modal-body">
          <p>Seguro Desea Eliminar éste Registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary close" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-outline-danger btn-ok">Confirmar</a>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="<?php echo base_url('/municipios/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="modal fade" id="MuniModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Municipio</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Pais:</label>
              <select name="pais" class="form-select form-select-lg mb-3" id="selectPais">
                <option selected>-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                  <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                <?php } ?>
              </select>
              <label for="nombre" class="col-form-label">Departamento:</label>
              <select name="departamento" id="selectDepartamento" class="form-select form-select-lg mb-3">
                <option selected>-Seleccione un Departamento</option>
               

              </select>
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <input type="text" id="tp" name="tp" hidden>
              <input type="text" id="id" name="id" hidden>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btn_Guardar">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>

<script>
  $('#modal-confirma').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  
  $(document).ready(function() {
    //Cambio del select paises
    $('#selectPais').on('change', () => {
      console.log("Inicio la funcion")
      pais = $('#selectPais').val()
      $.ajax({
        url: "<?php echo base_url('municipios/obtenerDepartamentosPais/'); ?>" + pais,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          //console.log(res)
          var cadena
          cadena = `<option selected> ---Seleccionar Departamento---</option>`
          for (let i = 0; i < res.length; i++) {
            cadena += `<option value='${res[i].id}'>${res[i].nombre} </option>`
          }
          cadena += `</select>`
          $('#departamento').html(cadena)
        }
      })
    })
  })
  function seleccionarDepartamento(pais, id_dpto){
    $.ajax({
      url: "<?php echo base_url('municipios/obtenerDepartamentosPais/'); ?>" + pais,
      type: 'POST',
      dataType: 'json',
      succes: function(res){
        $('#selectDepartamento').empty();
        //console.log(res)
        var cadena
        cadena= `<select name="departamento" id="departamento" class="form-select">
        <option value="">Seleccionar Departamento</option></option>`
        for (let i = 0; i < res.length; i++) {
                  cadena+= `<option value="${res[i].id}">${res[i].nombre} </option>`
      }
      cadena += `</select>`
      $('#departamento').html(cadena)
      $('#departamento').val(id_dpto)
    }
    })
  }
  $("#selectPais").on('change', function(){
    pais = $("#selectPais").val();
    llenar_Select(pais, "selectDepartamento", 0)
  });
  function llenar_Select(id, name, id_sel){
    dataUrl="<?php echo base_url('obtenerDepartamentosPais') ?>" + '/' + id
    $.ajax({
      url: dataUrl,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        console.log(res);
        $('#' +name).empty()
        for (let i = 0; i < res.length; i++) {
          let id = res[i]['id'];
          let nombre = res[i]['nombre'];
          $('#'+name).append("<option value='"+id+"'>"+nombre+"</option>");
        }
        if(id_sel!=0){$('#'+name).val(id_sel);}
      }
    }) 
  }
  
  function llenar_SelectMuni(id, name, id_sel){
    dataUrl="<?php echo base_url('obtenerMunicipiosDepartamentos') ?>" + '/' + id
    $.ajax({
      url: dataUrl,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        console.log(res);
        $('#' +name).empty()
        for (let i = 0; i < res.length; i++) {
          let id = res[i]['id'];
          let nombre = res[i]['nombre'];
          $('#'+name).append("<option value='"+id+"'>"+nombre+"</option>");
        }
        if(id_sel!=0){$('#'+name).val(id_sel);}
      }
    }) 
  }
  function seleccionaMunicipio(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/municipios/buscar_municipio'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(rs['id'])
          $("#selectPais").val(rs['id_pais']);
          llenar_Select(rs['id_pais'], "selectDepartamento", rs['id_dpto'])
          //$("#selectDepartamento").val(rs['id_dpto']);
          //seleccionarDepartamento(rs['id_pais'], rs['id_dpto']);
          $("#nombre").val(rs['nombre']);
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el municipio ' + rs['nombre']);
          $("#MuniModal").modal("show");
        }
      })
    } else {
      
      $("#tp").val(1);
      $("#id").val('');
      $("#nombre").val('');
      $("#selectPais").val('');
      $("#selectDepartamento").val('');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Municipio');
      $("#MuniModal").modal("show");
    }
  };


    
      
    $('.close').click(function() {
      
      $("#modal-confirma").modal('hide');
    
    });
</script>
