<?php
require_once ROOT_PATH . '/App/Config/ConexionDB.php';
require_once ROOT_PATH . '/App/Models/apartment-model.php';

function getApartments() {
    $apartamentos = apartmentModel::getAllApartments();
    if (empty($apartamentos)) {
        echo json_encode([]);
    } else {
        echo json_encode($apartamentos);
    }
}
function postApartments() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Paso 1: Datos básicos del apartamento
        $torre = $_POST['torre'] ?? null;
        $apartamento = $_POST['apartamento'] ?? null;
        $nombre_prop = $_POST['nombre_prop'] ?? null;
        $email_prop = $_POST['email_prop'] ?? null;
        $telefono_emergencia = $_POST['telefono_emergencia'] ?? null;
        $calentador_gas = isset($_POST['calentador_gas']) ? 1 : 0;
        $esta_arrendado = isset($_POST['esta_arrendado']) ? 1 : 0;

        // Paso 2: Residentes
        $residentes = [];
        $nombres_residentes = $_POST['nombre_residente'] ?? [];
        $telefonos_residentes = $_POST['telefono_residente'] ?? [];
        $edades_residentes = $_POST['edad_residente'] ?? [];
        $puede_salir_solo = $_POST['puede_salir_solo'] ?? [];
        $documentos = $_POST['documento'] ?? [];
        $parentescos = $_POST['parentesco'] ?? [];
        $discapacitados = $_POST['discapacitado'] ?? [];

        // Procesar residentes
        for ($i = 0; $i < count($nombres_residentes); $i++) {
            if (!empty($nombres_residentes[$i])) {
                $residentes[] = [
                    'nombre' => $nombres_residentes[$i],
                    'telefono' => $telefonos_residentes[$i] ?? null,
                    'edad' => $edades_residentes[$i] ?? null,
                    'puede_salir_solo' => isset($puede_salir_solo[$i]) ? 1 : 0,
                    'documento' => $documentos[$i] ?? null,
                    'parentesco' => $parentescos[$i] ?? null,
                    'discapacitado' => isset($discapacitados[$i]) ? 1 : 0
                ];
            }
        }

        // Paso 3: Mascotas
        $tiene_mascota = isset($_POST['mascota']);
        $mascotas = [];
        
        if ($tiene_mascota) {
            $especies = $_POST['especie'] ?? [];
            $nombres_mascotas = $_POST['nombre_mascota'] ?? [];
            $razas = $_POST['raza'] ?? [];
            $colores_mascotas = $_POST['color_mascota'] ?? [];
            $vacunas = $_POST['vacuna'] ?? [];

            // Procesar mascotas
            for ($i = 0; $i < count($especies); $i++) {
                if (!empty($especies[$i]) || !empty($nombres_mascotas[$i])) {
                    $mascotas[] = [
                        'especie' => $especies[$i] ?? null,
                        'nombre' => $nombres_mascotas[$i] ?? null,
                        'raza' => $razas[$i] ?? null,
                        'color' => $colores_mascotas[$i] ?? null,
                        'vacuna' => isset($vacunas[$i]) ? 1 : 0
                    ];
                }
            }
        }

        // Paso 4: Vehículos
        $tiene_vehiculo = isset($_POST['vehiculo']);
        $vehiculos = [];
        
        if ($tiene_vehiculo) {
            $placas = $_POST['placa'] ?? [];
            $tipos_vehiculo = $_POST['tipo_vehiculo'] ?? [];
            $marcas = $_POST['marca'] ?? [];
            $modelos = $_POST['modelo'] ?? [];
            $colores_vehiculos = $_POST['color_vehiculo'] ?? [];

            // Procesar vehículos
            for ($i = 0; $i < count($placas); $i++) {
                if (!empty($placas[$i])) {
                    $vehiculos[] = [
                        'tipo' => $tipos_vehiculo[$i] ?? 'carro',
                        'placa' => $placas[$i],
                        'marca' => $marcas[$i] ?? null,
                        'modelo' => $modelos[$i] ?? null,
                        'color' => $colores_vehiculos[$i] ?? null
                    ];
                }
            }
        }

        // Preparar datos para el modelo
        $data = [
            'torre' => $torre,
            'apartamento' => $apartamento,
            'nombre_prop' => $nombre_prop,
            'email_prop' => $email_prop,
            'telefono_emergencia' => $telefono_emergencia,
            'calentador_gas' => $calentador_gas,
            'esta_arrendado' => $esta_arrendado,
            'residentes' => $residentes,
            'mascotas' => $mascotas,
            'vehiculos' => $vehiculos
        ];

        // Guardar los datos
        $result = apartmentModel::postApartment($data);
        
        // Registrar la respuesta completa para depuración
        error_log("Respuesta del modelo: " . print_r($result, true));
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}

function deleteApartment(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $eliminarApartment = apartmentModel::deleteApartment($id);
        if ($eliminarApartment) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Apartemento eliminado exitosamente.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error al eliminar el Apartamento.'
            ]);
        }
    }
}