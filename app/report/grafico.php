<?php
    $app->get('/v1/grafico/001/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            SUM(a.ESTPOBCAN)    AS          establecimiento_poblacion_cantidad,

            b.ESTPERCOD         AS          persona_codigo,
            b.ESTPERPER         AS          persona_completo
            
            FROM ESTPOB a
            INNER JOIN mayordomo_establecimiento.ESTPER b ON a.ESTPOBPEC = b.ESTPERCOD

            WHERE a.ESTPOBESC = ?

            GROUP BY a.ESTPOBPEC

            ORDER BY a.ESTPOBPEC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'persona_codigo'                                => $rowESTABLECIMIENTO['persona_codigo'],
                        'persona_completo'                              => $rowESTABLECIMIENTO['persona_completo'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'establecimiento_poblacion_cantidad'            => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->get('/v1/grafico/002/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            SUM(a.ESTPOBCAN)    AS          establecimiento_poblacion_cantidad,

            b.DOMFICCOD         AS          tipo_origen_codigo,
            b.DOMFICNOM         AS          tipo_origen_nombre
            
            FROM ESTPOB a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOBTOC = b.DOMFICCOD

            WHERE a.ESTPOBESC = ?

            GROUP BY a.ESTPOBTOC

            ORDER BY a.ESTPOBTOC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_origen_codigo'                            => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                            => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_origen_codigo'                            => '',
                        'tipo_origen_nombre'                            => '',
                        'establecimiento_poblacion_cantidad'            => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->get('/v1/grafico/003/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            SUM(a.ESTPOBCAN)    AS          establecimiento_poblacion_cantidad,

            b.DOMFICCOD         AS          tipo_raza_codigo,
            b.DOMFICNOM         AS          tipo_raza_nombre
            
            FROM ESTPOB a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOBTRC = b.DOMFICCOD

            WHERE a.ESTPOBESC = ?

            GROUP BY a.ESTPOBTRC

            ORDER BY a.ESTPOBTRC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_raza_codigo'                              => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                              => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_raza_codigo'                              => '',
                        'tipo_raza_nombre'                              => '',
                        'establecimiento_poblacion_cantidad'            => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });