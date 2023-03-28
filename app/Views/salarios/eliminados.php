<div class="container card my-4">
<div>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
</div>

<body>
<h1 class="titulo_Vista text-center" style="color:#0D6EFD;"><?php echo $titulo ?></h1>

    <div>
        <div>
        </div>
        <div class="card-body">

            <div class="row col-sm-12">
                <div class="col-md-5ths col-lg-5ths col-xs-6 col-sm-5"></div>
                <div class="col-md-9ths col-lg-5ths col-xs-6 col-sm-2">
                <a href="<?php echo base_url('/salarios'); ?>" class="btn btn-primary regresar_btn">Regresar</a>
                </div>
            </div>

            <br>
            <div class="table-responsive">
                <table class="table table-bordered border-primary">
                    <thead class="table-light">
                        <tr style="color:#0D6EFD;font-weight:300;text-align:center;font-family:Arial;font-size:14px;"   >
                            <th>Id</th>
                            <th>Empleado</th>
                            <th>Periodo</th>
                            <th>Sueldo</th>
                            <th>Estado</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($salarios as $dato ) { ?>
                            <th><?php echo $dato['id']; ?></th>
                                <th><?php echo $dato['nombre_empleado']; ?></th>
                                <th><?php echo $dato['periodo']; ?></th>
                                <th><?php echo $dato['sueldo']; ?></th>
                                <th><?php echo $dato['estado']; ?></th>
                                <th class="grid grid text-center" colspan="2">
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-confirma" href="#" data-href="<?php echo base_url('/salarios/eliminarS') . '/' . $dato['id'] . '/' . 'A'; ?>"><i class="bi bi-arrow-clockwise"></i></button>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Confirma Eliminar -->
            <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
                        <div style="text-align:center;" class="modal-header">
                            <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Activación de Registro</h5>

                        </div>
                        <div style="text-align:center;font-weight:bold;" class="modal-body">
                            <p>Seguro Desea Activar éste Registro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
                            <a class="btn btn-danger btn-ok">Si</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Elimina -->

            <script>
                function EliminaSalarios(id) {
                    $("#id").val(id);
                    dataURL = "<?php echo base_url('/salarios/eliminados'); ?>" + "/" + id + "/" + 'A';
                    $.ajax({
                        type: "POST",
                        url: dataURL,
                        dataType: "json",
                        success: function(rs) {},
                        error: function() {
                            alert("No se ha Podido Activar El Registro");
                        }
                    })
                };
            </script>


            <script>
                $('#modal-confirma').on('show.bs.modal', function(e) {
                    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                })
            </script>
        </div>
            


</div>
</body>
