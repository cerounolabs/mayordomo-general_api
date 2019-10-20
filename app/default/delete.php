<?php
    $app->delete('/v1/default/000/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_nombre'];
        $val03      = $request->getParsedBody()['tipo_dominio'];
        $val04      = $request->getParsedBody()['tipo_observacion'];
        $val05      = $request->getParsedBody()['tipo_empresa'];
        $val06      = $request->getParsedBody()['tipo_usuario'];
        $val07      = $request->getParsedBody()['tipo_fecha_hora'];
        $val08      = $request->getParsedBody()['tipo_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM DOMFIC WHERE DOMFICCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error DELETE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->delete('/v1/default/100/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['pais_nombre'];
        $val03      = $request->getParsedBody()['pais_iso3166_char2'];
        $val04      = $request->getParsedBody()['pais_iso3166_char3'];
        $val05      = $request->getParsedBody()['pais_iso3166_numero'];
        $val06      = $request->getParsedBody()['pais_observacion'];
        $val07      = $request->getParsedBody()['pais_empresa_codigo'];
        $val08      = $request->getParsedBody()['pais_usuario'];
        $val09      = $request->getParsedBody()['pais_fecha_hora'];
        $val10      = $request->getParsedBody()['pais_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM LOCPAI WHERE LOCPAICOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error DELETE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->delete('/v1/default/200/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['pais_codigo'];
        $val03      = $request->getParsedBody()['departamento_nombre'];
        $val04      = $request->getParsedBody()['departamento_observacion'];
        $val05      = $request->getParsedBody()['departamento_empresa_codigo'];
        $val06      = $request->getParsedBody()['departamento_usuario'];
        $val07      = $request->getParsedBody()['departamento_fecha_hora'];
        $val08      = $request->getParsedBody()['departamento_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM LOCDEP WHERE LOCDEPCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error DELETE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->delete('/v1/default/300/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_zona_codigo'];
        $val03      = $request->getParsedBody()['tipo_riesgo_codigo'];
        $val04      = $request->getParsedBody()['departamento_codigo'];
        $val05      = $request->getParsedBody()['distrito_nombre'];
        $val06      = $request->getParsedBody()['distrito_observacion'];
        $val07      = $request->getParsedBody()['distrito_empresa_codigo'];
        $val08      = $request->getParsedBody()['distrito_usuario'];
        $val09      = $request->getParsedBody()['distrito_fecha_hora'];
        $val10      = $request->getParsedBody()['distrito_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM LOCDIS WHERE LOCDISCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error DELETE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->delete('/v1/default/400/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_persona_codigo'];
        $val03      = $request->getParsedBody()['tipo_documento_codigo'];
        $val04      = $request->getParsedBody()['persona_completo'];
        $val05      = $request->getParsedBody()['persona_documento'];
        $val06      = $request->getParsedBody()['persona_telefono'];
        $val07      = $request->getParsedBody()['persona_email'];
        $val08      = $request->getParsedBody()['persona_observacion'];
        $val09      = $request->getParsedBody()['persona_empresa_codigo'];
        $val10      = $request->getParsedBody()['persona_usuario'];
        $val11      = $request->getParsedBody()['persona_fecha_hora'];
        $val12      = $request->getParsedBody()['persona_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM PERFIC WHERE PERFICCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error DELETE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });
