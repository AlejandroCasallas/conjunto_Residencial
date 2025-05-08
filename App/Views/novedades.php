<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar con Bootstrap</title>
    
    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Public/Assets/css/sidebar-styles.css">
</head>
<body id="view-apartments">
    <?php include 'loader.php'; ?>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- /sidebar -->

        <!-- Contenido principal -->
        <div id="mainContent">
            
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Novedades</h1>
                    <p class="mb-4">En este apartado podrás ver, crear y expandir la información los diferentes Novedades</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 text-primary">Novedades</h6>
                            <div class="btn-register">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novedadRegister">Registrar Novedad</button>
                            </div>
                            <div class="btn-register">
                                <input type="file" id="fileUpload" accept=".xls,.xlsx" /><br />
                                <button type="button" id="uploadExcel">Convert</button>
                            </div>
                            <div style="margin-top:10px;">
                                <pre id="jsonData"></pre>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="apartmentsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Torre - Apartamento</th>
                                            <th>Nombre Propietari@</th>
                                            <th>Tipo de observación</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Número</th>
                                            <th>Está Arrendado</th>
                                            <th>Expandir información</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Torre - Apartamento</th>
                                            <th>Nombre Propietari@</th>
                                            <th>Tipo de observación</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Número</th>
                                            <th>Está Arrendado</th>
                                            <th>Expandir información</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal register -->
    <div class="modal fade" id="novedadRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="novedadRegisterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="novedadRegisterLabel">Registrar novedad</h1>
            </div>
            <form id="formNovedadRegister">
                <input type="hidden" name="action" value="registrar">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file">Excelfile</label>
                        <input type="file" id="excelFile" accept=".xlsx, .xls" />

                        <label for="proyectName" class="form-label">Torre</label>
                        <input type="number" class="form-control" id="torre" name="torre" placeholder="Torre" required>

                        <label for="proyectName" class="form-label">Apartamento</label>
                        <input type="number" class="form-control" id="torre" name="torre" placeholder="Torre" required>

                        <label for="proyectDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="proyectDescription" name="proyectDescription" rows="3" placeholder="Descripción del Proyecto" required></textarea>

                        <label for="proyectStartDate" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="proyectStartDate" name="proyectStartDate" required>

                        <label for="proyectEndDate" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="proyectEndDate" name="proyectEndDate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-icon-split" data-bs-dismiss="modal"><span class="text"><i class="fas fa-trash"></i> Cancelar</span></button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
        </div>
    <!-- //modal registro --> 


    <!-- JavaScript -->
    <!-- jQuery (solo una versión) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <!-- Custom Scripts -->
    <script src="Public/Assets/js/datatables-demo.js"></script>
    <script src="Public/Assets/js/sidebar-script.js"></script>
    <script src="Public/Assets/js/apartamento-registro.js"></script>
    <script src="Public/Assets/js/ajax-novedades.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script>
  let selectedFile;

  document.getElementById("fileUpload").addEventListener("change", function(event) {
    selectedFile = event.target.files[0];
  });

  document.getElementById("uploadExcel").addEventListener("click", function() {
    if (selectedFile) {
      const fileReader = new FileReader();

      fileReader.onload = function(event) {
        const data = event.target.result;

        const workbook = XLSX.read(data, { type: "binary" });

        workbook.SheetNames.forEach(sheet => {
          const rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);

          // Mostrar todo el JSON en pantalla (solo para referencia visual)
          document.getElementById("jsonData").textContent = JSON.stringify(rowObject, null, 2);

          const datosLimpios = rowObject.map(row => {
                return {
                    fecha: typeof row["FECHA"] === "number" ? excelDateToJSDate(row["FECHA"]) : row["FECHA"],
                    hora: typeof row["HORA"] === "number" ? excelTimeToHHMM(row["HORA"]) : row["HORA"],
                    torre: row["TORRE"],
                    apto: row["APTO"],
                    tipo: row["TIPO DE OBSERVACION"],
                    descripcion: row["DESCRIPCIÓN"],
                    folio: row["FOLIO"],
                    vigilante: row["VIGILANTE"]
                };
            });
            datosLimpios.forEach(item => {
                const torre = item.torre;
                const apto = item.apto;
                const tipo = item.tipo;
                const descripcion = item.descripcion;
                const folio = item.folio;
                const vigilante = item.vigilante;
                const fecha = item.fecha;
                const hora = item.hora;
                
                $.ajax({
                    url: './obtenerIdApartamento',
                    type: 'POST',
                    data: { torre: torre, apto: apto },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.id) {
                        const id_apto = response.id;
                        console.log('ID del apartamento:',id_apto, 'para torre', torre, 'y apto', apto, 'con el propietatio', response.nombre_prop, 'y el email', response.email_prop, 'y el telefono', response.telefono_emergencia, 'y el calentador', response.calentador_gas, 'y el arrendado', response.arrendado, 'el dia', fecha, 'a la hora', hora, 'con el tipo de observacion', tipo, 'y la descripcion', descripcion, 'y el folio', folio, 'y el vigilante', vigilante, 'cometio esa falta');
                        } else {
                        console.warn("No se encontró el apartamento para:", torre, apto);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en AJAX:", status, error);
                    }
                });
            });



        });
      };

      fileReader.readAsBinaryString(selectedFile);
    }
  });

        function excelDateToJSDate(serial) {
            const excelEpoch = new Date(1899, 11, 30);
            const days = Math.floor(serial);
            const millisecondsPerDay = 24 * 60 * 60 * 1000;
            const date = new Date(excelEpoch.getTime() + days * millisecondsPerDay);
            return date.toISOString().split('T')[0];
        }

        function excelTimeToHHMM(time) {
            const totalMinutes = Math.round(time * 24 * 60);
            const hours = Math.floor(totalMinutes / 60);
            const minutes = totalMinutes % 60;
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
        }

      </script>
</body>
</html>