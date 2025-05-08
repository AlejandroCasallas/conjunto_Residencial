if (document.body.id === 'view-apartments') {
    $(document).ready(function () {
        getApartments();
    });
}

function getApartments() {
    $.ajax({
        url: './getApartaments',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#apartmentsTable').DataTable().clear();
            if (data.length > 0) {
                // Si hay datos, agregarlos a la tabla
                data.forEach(function(apartamento) {
                    if (apartamento.arrendado === 1) {
                        apartamento.arrendado = '<span>Arrendado</span>';
                    }
                    if (apartamento.arrendado === 0) {
                        apartamento.arrendado = '<span >No Arrendado</span>';
                    }
                    if (apartamento.telefono_apto === null) {
                        apartamento.telefono_apto = apartamento.numeroemergencia;
                    }
                    if (apartamento.calentador === 1) {
                        apartamento.calentador = '<span>Cuenta con calentador</span>';
                    }
                    if (apartamento.calentador === 0) {
                        apartamento.calentador = '<span>No cuenta con calentador</span>';
                    }
                    let row = `
                        <tr>
                            <td>${apartamento.torre}-${apartamento.apartamento}</td>
                            <td>${apartamento.nombre_prop}</td>
                            <td>${apartamento.numeroemergencia}</td>
                            <td>${apartamento.telefono_apto}</td>
                            <td>${apartamento.calentador}</td>
                            <td>${apartamento.arrendado}</td>
                            <td><a onclick="eliminarApartamento(${apartamento.id})"  class="btn btn-danger btn-circle btn-lg">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td>
                                <a href="./view-project?id=${apartamento.id}" class="btn btn-info btn-lg">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    $('#apartmentsTable').DataTable().row.add($(row)).draw();  // Agregar fila y redibujar tabla
                });
            } else {
                // Si no hay datos, mostrar mensaje en la tabla
                $('#apartmentsTable').DataTable().clear().draw();
                $('#apartmentsTable tbody').html('<tr><td colspan="7">No hay proyectos disponibles.</td></tr>');
            }
        },
        error: function() {
            // En caso de error, mostrar mensaje de error
            $('#apartmentsTable').DataTable().clear().draw();
            $('#apartmentsTable tbody').html('<tr><td colspan="7">Error al cargar los proyectos.</td></tr>');
        }
    });
}


function eliminarApartamento(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-danger btn-icon-split',
        cancelButtonClass: 'btn btn-success btn-icon-split', 
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarApartamentoDeBD(id);
        }
    });
}

function eliminarApartamentoDeBD(id) {
    $.ajax({
        url: './deleteApartment',
        type: 'POST',
        data: { id: id, action: 'eliminar' },
        success: function(response) {
            const responseData = JSON.parse(response);
            if (responseData.status === 'success') {
                Swal.fire(
                    'Eliminado!',
                    'El proyecto ha sido eliminado.',
                    'success'
                ).then(() => {
                    getApartments();
                });
            } else {
                Swal.fire(
                    'Error!',
                    'No se pudo eliminar el proyecto.',
                    'error'
                );
            }
        },
        error: function() {
            Swal.fire(
                'Error!',
                'Hubo un problema al procesar la solicitud.',
                'error'
            );
        }
    });
}




$(document).ready(function() {
    // Variables de estado
    let currentStep = 1;
    const totalSteps = 4;
    let residenteCount = 1;
    let mascotaCount = 1;
    let vehiculoCount = 1;
    
    // Mostrar/Ocultar secciones
    $('#tiene-mascota').change(function() {
        $('#mascota-info').toggle(this.checked);
    });
    
    $('#tiene-vehiculo').change(function() {
        $('#vehiculo-info').toggle(this.checked);
    });
    
    // Agregar residentes (máximo 7)
    $('#agregar-residente').click(function() {
        if (residenteCount < 7) {
            residenteCount++;
            const newResident = $('.residente-form').first().clone();
            newResident.find('input').val('');
            newResident.find('select').val('Propietario');
            newResident.find('.form-check-input').prop('checked', false);
            newResident.find('h5').html(`Residente #${residenteCount} <span class="badge bg-secondary">Opcional</span>`);
            $('.residentes-container').append(newResident);
            
            if (residenteCount === 7) {
                $(this).prop('disabled', true);
            }
        }
    });
    
    // Agregar mascotas (máximo 3)
    $('#agregar-mascota').click(function() {
        if (mascotaCount < 3) {
            mascotaCount++;
            const newMascota = $('.mascota-form').first().clone();
            newMascota.find('input').val('');
            newMascota.find('.form-check-input').prop('checked', false);
            newMascota.find('h6').text(`Mascota #${mascotaCount}`);
            $('.mascotas-container').append(newMascota);
            
            if (mascotaCount === 3) {
                $(this).prop('disabled', true);
            }
        }
    });
    
    // Agregar vehículos (máximo 2)
    $('#agregar-vehiculo').click(function() {
        if (vehiculoCount < 2) {
            vehiculoCount++;
            const newVehiculo = $('.vehiculo-form').first().clone();
            newVehiculo.find('input').val('');
            newVehiculo.find('input[type="radio"]').prop('checked', false);
            newVehiculo.find('#carro1').attr('id', 'carro' + vehiculoCount);
            newVehiculo.find('#moto1').attr('id', 'moto' + vehiculoCount);
            newVehiculo.find('label[for="carro1"]').attr('for', 'carro' + vehiculoCount);
            newVehiculo.find('label[for="moto1"]').attr('for', 'moto' + vehiculoCount);
            newVehiculo.find('h6').text(`Vehículo #${vehiculoCount}`);
            $('.vehiculos-container').append(newVehiculo);
            
            if (vehiculoCount === 2) {
                $(this).prop('disabled', true);
            }
        }
    });
    
    // Navegación entre pasos
    $('#btn-next').click(function() {
        if (validateStep(currentStep)) {
            $('.step-' + currentStep).addClass('d-none');
            currentStep++;
            $('.step-' + currentStep).removeClass('d-none');
            updateProgressBar();
            
            $('#btn-prev').prop('disabled', false);
            if (currentStep === totalSteps) {
                $(this).hide();
                $('#btn-submit').show();
            }
        }
    });
    
    $('#btn-prev').click(function() {
        $('.step-' + currentStep).addClass('d-none');
        currentStep--;
        $('.step-' + currentStep).removeClass('d-none');
        updateProgressBar();
        
        $('#btn-next').show();
        $('#btn-submit').hide();
        if (currentStep === 1) {
            $(this).prop('disabled', true);
        }
    });
    
    // Actualizar barra de progreso
    function updateProgressBar() {
        const progress = (currentStep / totalSteps) * 100;
        $('.progress-bar').css('width', progress + '%')
                          .text('Paso ' + currentStep + ' de ' + totalSteps);
    }
    
    // Validación de pasos
    function validateStep(step) {
        let isValid = true;
        
        // Validar campos requeridos
        $('.step-' + step + ' [required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Validación especial para residentes
        if (step === 2 && $('[name="nombre_residente[]"]').filter(function() { 
            return $(this).val() !== ''; 
        }).length === 0) {
            isValid = false;
            Swal.fire({
                title: 'Residente requerido',
                text: 'Debe registrar al menos un residente',
                icon: 'warning',
                confirmButtonText: 'Entendido'
            });
        }
        
        if (!isValid && step !== 2) {
            Swal.fire({
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos obligatorios',
                icon: 'warning',
                confirmButtonText: 'Entendido'
            });
        }
        
        return isValid;
    }
    
    // Envío del formulario con AJAX
    $('#formApartamentRegister').submit(function(e) {
        e.preventDefault();
        
        // Validación final
        if (!validateStep(currentStep)) {
            return false;
        }
        
        // Mostrar loader
        Swal.fire({
            title: 'Procesando',
            html: 'Guardando información del apartamento...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Preparar datos del formulario
        const formData = new FormData(this);
        
        // Agregar datos dinámicos de residentes
        $('[name="nombre_residente[]"]').each(function(index) {
            if ($(this).val()) {
                const residenteForm = $(this).closest('.residente-form');
                formData.append(`residentes[${index}][nombre]`, $(this).val());
                formData.append(`residentes[${index}][telefono]`, residenteForm.find('[name="telefono_residente[]"]').val());
                formData.append(`residentes[${index}][edad]`, residenteForm.find('[name="edad_residente[]"]').val());
                formData.append(`residentes[${index}][puede_salir_solo]`, residenteForm.find('[name="puede_salir_solo[]"]').prop('checked') ? 1 : 0);
                formData.append(`residentes[${index}][documento]`, residenteForm.find('[name="documento[]"]').val());
                formData.append(`residentes[${index}][parentesco]`, residenteForm.find('[name="parentesco[]"]').val());
                formData.append(`residentes[${index}][discapacitado]`, residenteForm.find('[name="discapacitado[]"]').prop('checked') ? 1 : 0);
            }
        });
        
        // Agregar datos de mascotas si existen
        if ($('#tiene-mascota').prop('checked')) {
            $('[name="nombre_mascota[]"]').each(function(index) {
                if ($(this).val()) {
                    const mascotaForm = $(this).closest('.mascota-form');
                    formData.append(`mascotas[${index}][nombre]`, $(this).val());
                    formData.append(`mascotas[${index}][especie]`, mascotaForm.find('[name="especie[]"]').val());
                    formData.append(`mascotas[${index}][raza]`, mascotaForm.find('[name="raza[]"]').val());
                    formData.append(`mascotas[${index}][color]`, mascotaForm.find('[name="color_mascota[]"]').val());
                    formData.append(`mascotas[${index}][vacuna]`, mascotaForm.find('[name="vacuna[]"]').prop('checked') ? 1 : 0);
                }
            });
        }
        
        // Agregar datos de vehículos si existen
        if ($('#tiene-vehiculo').prop('checked')) {
            $('[name="placa[]"]').each(function(index) {
                if ($(this).val()) {
                    const vehiculoForm = $(this).closest('.vehiculo-form');
                    formData.append(`vehiculos[${index}][placa]`, $(this).val());
                    formData.append(`vehiculos[${index}][tipo]`, vehiculoForm.find('[name="tipo_vehiculo[]"]:checked').val());
                    formData.append(`vehiculos[${index}][marca]`, vehiculoForm.find('[name="marca[]"]').val());
                    formData.append(`vehiculos[${index}][modelo]`, vehiculoForm.find('[name="modelo[]"]').val());
                    formData.append(`vehiculos[${index}][color]`, vehiculoForm.find('[name="color_vehiculo[]"]').val());
                }
            });
        }
        
        // Enviar datos via AJAX
        $.ajax({
            url: './postApartments',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.close();
                
                try {
                    const result = typeof response === 'string' ? JSON.parse(response) : response;
                    
                    if (result.status === "success") {
                        getApartments();
                        Swal.fire({
                            title: 'Éxito',
                            text: result.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            resetForm();
                            $('#ApartamentRegister').modal('hide');
                            if (typeof cargarProyectos === 'function') {
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.message || 'Error desconocido',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                } catch (e) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al procesar la respuesta del servidor',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error("Error parsing response:", e);
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'Error en la conexión: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error("AJAX Error:", status, error);
            }
        });
    });
    
    // Función para resetear el formulario
    function resetForm() {
        $('#formApartamentRegister')[0].reset();
        $('.step').addClass('d-none');
        $('.step-1').removeClass('d-none');
        currentStep = 1;
        updateProgressBar();
        $('#btn-prev').prop('disabled', true);
        $('#btn-next').show();
        $('#btn-submit').hide();
        residenteCount = 1;
        mascotaCount = 1;
        vehiculoCount = 1;
        $('.residentes-container').html($('.residente-form').first());
        $('.mascotas-container').html($('.mascota-form').first());
        $('.vehiculos-container').html($('.vehiculo-form').first());
        $('#agregar-residente, #agregar-mascota, #agregar-vehiculo').prop('disabled', false);
        $('#mascota-info, #vehiculo-info').hide();
        $('#tiene-mascota, #tiene-vehiculo').prop('checked', false);
        $('.is-invalid').removeClass('is-invalid');
    }
});