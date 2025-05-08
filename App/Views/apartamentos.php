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
                    <h1 class="h3 mb-2 text-gray-800">Apartamentos</h1>
                    <p class="mb-4">En este apartado podrás ver, crear y expandir la información los diferentes Apartamentos</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 text-primary">Apartamentos</h6>
                            <div class="btn-register">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ApartamentRegister">Registrar Apartamento Nuevo</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="apartmentsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Torre - Apartamento</th>
                                            <th>Nombre Propietari@</th>
                                            <th>numero emergencia</th>
                                            <th>Telefono Apto</th>
                                            <th>Calentador Gas</th>
                                            <th>Está Arrendado</th>
                                            <th>Eliminar</th>
                                            <th>Expandir información</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Torre - Apartamento</th>
                                            <th>Nombre Propietari@</th>
                                            <th>numero emergencia</th>
                                            <th>Telefono Apto</th>
                                            <th>Calentador Gas</th>
                                            <th>Está Arrendado</th>
                                            <th>Eliminar</th>
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
        <div class="modal fade" id="ApartamentRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="proyectRegisterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="proyectRegisterLabel">Registro de Apartamento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Barra de progreso -->
            <div class="progress-container px-4 pt-3">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Paso 1 de 4</div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <small class="text-muted">Información Básica</small>
                    <small class="text-muted">Residentes</small>
                    <small class="text-muted">Mascotas</small>
                    <small class="text-muted">Vehículos</small>
                </div>
            </div>
            
            <form id="formApartamentRegister">
                <input type="hidden" name="action" value="registrar">
                
                <div class="modal-body">
                    <!-- Paso 1: Información básica -->
                    <div class="step step-1">
                        <div class="mb-3">
                            <label for="torre" class="form-label">Torre</label>
                            <input type="number" class="form-control" id="torre" name="torre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="apartamento" class="form-label">Número de Apartamento</label>
                            <input type="number" class="form-control" id="apartamento" name="apartamento" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nombre_prop" class="form-label">Nombre del Propietario</label>
                            <input type="text" class="form-control" id="nombre_prop" name="nombre_prop" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email_prop" class="form-label">Email del Propietario</label>
                            <input type="email" class="form-control" id="email_prop" name="email_prop" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono_emergencia" class="form-label">Teléfono de Emergencia</label>
                            <input type="tel" class="form-control" id="telefono_emergencia" name="telefono_emergencia">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="calentador_gas" name="calentador_gas" value="1">
                            <label class="form-check-label" for="calentador_gas">¿Cuenta con calentador a gas?</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="esta_arrendado" name="esta_arrendado" value="1">
                            <label class="form-check-label" for="esta_arrendado">¿Está arrendado?</label>
                        </div>

                    </div>
                    
                    <!-- Paso 2: Residentes (máximo 7) -->
                    <div class="step step-2 d-none">
                        <div class="residentes-container">
                            <div class="residente-form mb-4 p-3 border rounded">
                                <h5>Residente Principal <span class="badge bg-primary">Obligatorio</span></h5>
                                <div class="mb-3">
                                    <label class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" name="nombre_residente[]" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" name="telefono_residente[]">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Edad</label>
                                    <input type="number" class="form-control" name="edad_residente[]" min="0">
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="puede_salir_solo[]" value="1">
                                    <label class="form-check-label">¿Puede salir solo/a?</label>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Documento de Identidad</label>
                                            <input type="text" class="form-control" name="documento[]">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Parentesco</label>
                                            <select class="form-select" name="parentesco[]">
                                                <option value="Propietario">Propietario</option>
                                                <option value="Hijo">Hijo</option>
                                                <option value="Cónyuge">Cónyuge</option>
                                                <option value="Familiar">Familiar</option>
                                                <option value="Arrendatario">Arrendatario</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="discapacitado[]" value="1">
                                    <label class="form-check-label">¿Es discapacitado?</label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="agregar-residente">
                            <i class="fas fa-plus"></i> Agregar residente adicional
                        </button>
                        <div class="text-muted small mb-3">Máximo 7 residentes por apartamento</div>
                    </div>
                    
                    <!-- Paso 3: Mascotas (máximo 3) -->
                    <div class="step step-3 d-none">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="tiene-mascota" name="mascota" value="1">
                            <label class="form-check-label" for="tiene-mascota">¿Tiene mascota?</label>
                        </div>
                        
                        <div id="mascota-info" class="border rounded p-3" style="display: none;">
                            <div class="mascotas-container">
                                <div class="mascota-form mb-3">
                                    <h6>Mascota #1</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Especie</label>
                                        <input type="text" class="form-control" name="especie[]">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre_mascota[]">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Raza</label>
                                        <input type="text" class="form-control" name="raza[]">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-control" name="color_mascota[]">
                                    </div>

                                    
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="vacuna[]" value="1">
                                        <label class="form-check-label">¿Vacunas al día?</label>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="agregar-mascota">
                                <i class="fas fa-plus"></i> Agregar otra mascota
                            </button>
                            <div class="text-muted small">Máximo 3 mascotas por apartamento</div>
                        </div>
                    </div>
                    
                    <!-- Paso 4: Vehículos (máximo 2) -->
                    <div class="step step-4 d-none">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="tiene-vehiculo" name="vehiculo" value="1">
                            <label class="form-check-label" for="tiene-vehiculo">¿Tiene vehículo?</label>
                        </div>
                        
                        <div id="vehiculo-info" class="border rounded p-3" style="display: none;">
                            <div class="vehiculos-container">
                                <div class="vehiculo-form mb-3">
                                    <h6>Vehículo #1</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_vehiculo[]" id="carro1" value="carro" checked>
                                        <label class="form-check-label" for="carro1">Carro</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_vehiculo[]" id="moto1" value="moto">
                                        <label class="form-check-label" for="moto1">Moto</label>
                                    </div>
                                    
                                    <div class="mb-3 mt-2">
                                        <label class="form-label">Placa</label>
                                        <input type="text" class="form-control" name="placa[]">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Marca</label>
                                        <input type="text" class="form-control" name="marca[]">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Modelo</label>
                                        <input type="text" class="form-control" name="modelo[]">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-control" name="color_vehiculo[]">
                                    </div>

                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="agregar-vehiculo">
                                <i class="fas fa-plus"></i> Agregar otro vehículo
                            </button>
                            <div class="text-muted small">Máximo 2 vehículos por apartamento</div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-prev" disabled>
                        <i class="fas fa-arrow-left"></i> Anterior
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-next">
                        Siguiente <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="btn-submit" style="display: none;">
                        <i class="fas fa-save"></i> Guardar
                    </button>
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
    <script src="Public/Assets/js/ajax-apartamento.js"></script>
</body>
</html>