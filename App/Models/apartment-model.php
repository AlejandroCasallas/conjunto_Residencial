<?php
class apartmentModel{
    public static function getAllApartments(){
        try {
            $conexion = new Conexion();
            $con = $conexion->getConexion();
            $traer_apartamento = "SELECT * from apartamento";
            $stmt = $con->prepare($traer_apartamento);
            $stmt->execute();
            $apartamento = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $apartamento [] = $row;
            };
            return $apartamento;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conexion->cerrarConexion($con);
        }
    }
    public static function postApartment($data) {
        $conn = null;
        try {
            // 1. Conexión a la base de datos
            $conn = new PDO("mysql:host=localhost;dbname=conjunto", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Iniciar transacción explícitamente
            $conn->beginTransaction();
    
            // 2. Insertar apartamento (con traza de depuración)
            error_log("Insertando apartamento: " . print_r($data, true));
            
            $stmt = $conn->prepare("INSERT INTO apartamento 
                (torre, apartamento, nombre_prop, email_prop, numeroemergencia, calentador, arrendado)
                VALUES (:torre, :apartamento, :nombre_prop, :email_prop, :telefono_emergencia, :calentador_gas, :esta_arrendado)");
            
            $stmt->execute([
                ':torre' => $data['torre'],
                ':apartamento' => $data['apartamento'],
                ':nombre_prop' => $data['nombre_prop'],
                ':email_prop' => $data['email_prop'],
                ':telefono_emergencia' => $data['telefono_emergencia'],
                ':calentador_gas' => $data['calentador_gas'],
                ':esta_arrendado' => $data['esta_arrendado']
            ]);
    
            $apto_id = $conn->lastInsertId();
            error_log("ID de apartamento generado: " . $apto_id);
    
            // 3. Insertar residentes
            foreach ($data['residentes'] as $index => $residente) {
                error_log("Insertando residente {$index}: " . print_r($residente, true));
                
                $stmt = $conn->prepare("INSERT INTO apartamento_residentes 
                    (apto, nombre_residente, telefono, edad, salesolo, documento, parentesco, discapacitado) 
                    VALUES (:apto, :nombre, :telefono, :edad, :puede_salir_solo, :documento, :parentesco, :discapacitado)");
                
                $stmt->execute([
                    ':apto' => $apto_id,
                    ':nombre' => $residente['nombre'],
                    ':telefono' => $residente['telefono'],
                    ':edad' => $residente['edad'],
                    ':puede_salir_solo' => $residente['puede_salir_solo'],
                    ':documento' => $residente['documento'],
                    ':parentesco' => $residente['parentesco'],
                    ':discapacitado' => $residente['discapacitado']
                ]);
                
                error_log("Residente {$index} insertado");
            }
    
            // 4. Insertar mascotas
            if (!empty($data['mascotas'])) {
                foreach ($data['mascotas'] as $index => $mascota) {
                    error_log("Insertando mascota {$index}: " . print_r($mascota, true));
                    
                    $stmt = $conn->prepare("INSERT INTO mascotas_apto 
                        (apto, especie, nombre, raza, color, vacuna) 
                        VALUES (:apto, :especie, :nombre, :raza, :color, :vacuna)");
                    
                    $stmt->execute([
                        ':apto' => $apto_id,
                        ':especie' => $mascota['especie'],
                        ':nombre' => $mascota['nombre'],
                        ':raza' => $mascota['raza'],
                        ':color' => $mascota['color'],
                        ':vacuna' => $mascota['vacuna']
                    ]);
                    
                    error_log("Mascota {$index} insertada");
                }
            }
    
            // 5. Insertar vehículos
            if (!empty($data['vehiculos'])) {
                foreach ($data['vehiculos'] as $index => $vehiculo) {
                    error_log("Insertando vehículo {$index}: " . print_r($vehiculo, true));
                    
                    $tipo_vehiculo = ($vehiculo['tipo'] == 'carro') ? 1 : 0;
                    
                    $stmt = $conn->prepare("INSERT INTO vehiculo 
                        (apto, tipo, placa, marca, modelo, color) 
                        VALUES (:apto, :tipo, :placa, :marca, :modelo, :color)");
                    
                    $stmt->execute([
                        ':apto' => $apto_id,
                        ':tipo' => $tipo_vehiculo,
                        ':placa' => $vehiculo['placa'],
                        ':marca' => $vehiculo['marca'],
                        ':modelo' => $vehiculo['modelo'],
                        ':color' => $vehiculo['color']
                    ]);
                    
                    error_log("Vehículo {$index} insertado");
                }
            }
    
            // Confirmar transacción
            $conn->commit();
            error_log("Transacción completada con éxito");
            
            return [
                'status' => 'success',
                'message' => 'Apartamento registrado exitosamente.',
                'apto_id' => $apto_id // Devolvemos el ID para referencia
            ];
    
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            if ($conn) {
                $conn->rollBack();
                error_log("Transacción revertida por error");
            }
            
            error_log("Error en postApartment: " . $e->getMessage());
            error_log("Código de error: " . $e->getCode());
            error_log("Trace: " . $e->getTraceAsString());
            
            return [
                'status' => 'error',
                'message' => 'Error al registrar el apartamento.',
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        } finally {
            if ($conn) {
                $conn = null;
            }
        }
    }


    public static function deleteApartment($id) {
        $conexion = null;
        $con = null;
        try {
            $conexion = new Conexion();
            $con = $conexion->getConexion();
            
            // Iniciar transacción
            $con->beginTransaction();
    
            // 1. Eliminar vehículos asociados
            $eliminar_vehiculos = "DELETE FROM vehiculo WHERE apto = :id";
            $stmt = $con->prepare($eliminar_vehiculos);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            // 2. Eliminar mascotas asociadas
            $eliminar_mascotas = "DELETE FROM mascotas_apto WHERE apto = :id";
            $stmt = $con->prepare($eliminar_mascotas);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            // 3. Eliminar residentes asociados
            $eliminar_residentes = "DELETE FROM apartamento_residentes WHERE apto = :id";
            $stmt = $con->prepare($eliminar_residentes);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            // 4. Finalmente, eliminar el apartamento
            $eliminar_apartamento = "DELETE FROM apartamento WHERE id = :id";
            $stmt = $con->prepare($eliminar_apartamento);
            $stmt->bindParam(':id', $id);
            $resultado = $stmt->execute();
    
            // Confirmar transacción
            $con->commit();
    
            return $resultado;
    
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            if ($con instanceof PDO) {
                $con->rollBack();
            }
            
            // Registrar el error
            error_log("Error al eliminar apartamento ID {$id}: " . $e->getMessage());
            
            // Opcional: puedes lanzar la excepción para manejarla en el controlador
            throw new Exception("Error al eliminar el apartamento: " . $e->getMessage());
            
        } finally {
            // Cerrar conexión
            if ($conexion instanceof Conexion && $con instanceof PDO) {
                $conexion->cerrarConexion($con);
            }
        }
    }
}