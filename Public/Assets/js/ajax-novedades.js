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