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

    $app->delete('/v1/default/020/{dominio}/{codigo1}/{codigo2}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('dominio');
        $val01      = $request->getAttribute('codigo1');
        $val02      = $request->getAttribute('codigo2');
        $val03      = $request->getParsedBody()['tipo_estado_codigo'];
        $val04      = $request->getParsedBody()['tipo_dominio1_codigo'];
        $val05      = $request->getParsedBody()['tipo_dominio2_codigo'];
        $val06      = $request->getParsedBody()['tipo_dominio'];
        $val07      = $request->getParsedBody()['tipo_observacion'];
        $val08      = $request->getParsedBody()['tipo_empresa'];
        $val09      = $request->getParsedBody()['tipo_usuario'];
        $val10      = $request->getParsedBody()['tipo_fecha_hora'];
        $val11      = $request->getParsedBody()['tipo_ip'];

        if (isset($val00) && isset($val01) && isset($val02)) {
            $sql00  = "DELETE FROM DOMSUB WHERE DOMSUBVAL = ? AND DOMSUBCO1 = ? AND DOMSUBCO2 = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00, $val01, $val02]); 
                
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

    $app->delete('/v1/default/500/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_establecimiento_codigo'];
        $val03      = $request->getParsedBody()['tipo_finalidad_codigo'];
        $val04      = $request->getParsedBody()['persona_codigo'];
        $val05      = $request->getParsedBody()['distrito_codigo'];
        $val06      = $request->getParsedBody()['establecimiento_nombre'];
        $val07      = $request->getParsedBody()['establecimiento_total_hectarea'];
        $val08      = $request->getParsedBody()['establecimiento_total_potrero'];
        $val09      = $request->getParsedBody()['establecimiento_codigo_senacsa'];
        $val10      = $request->getParsedBody()['establecimiento_codigo_sigor'];
        $val11      = $request->getParsedBody()['establecimiento_sitrap'];
        $val12      = $request->getParsedBody()['establecimiento_observacion'];
        $val13      = $request->getParsedBody()['establecimiento_empresa_codigo'];
        $val14      = $request->getParsedBody()['establecimiento_usuario'];
        $val15      = $request->getParsedBody()['establecimiento_fecha_hora'];
        $val16      = $request->getParsedBody()['establecimiento_ip'];

        if (isset($val00)) {
            $sql00  = "DELETE FROM ESTFIC WHERE ESTFICCOD = ?";

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

    $app->delete('/v1/default/602/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTSEC SET ESTSECAEM = ?, ESTSECAUS = ?, ESTSECAFH = ?, ESTSECAIP = ? WHERE ESTSECCOD = ?";
            $sql01  = "DELETE FROM ESTSEC WHERE ESTSECCOD = ?";

            try {
                $connDEFAULT    = getConnectionDEFAULT();

                $stmtDEFAULT00  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtDEFAULT01  = $connDEFAULT->prepare($sql01);
                $stmtDEFAULT01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT00->closeCursor();
                $stmtDEFAULT00  = null;

                $stmtDEFAULT01->closeCursor();
                $stmtDEFAULT01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;

        return $json;
    });

    $app->delete('/v1/default/603/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTPOT SET ESTPOTAEM = ?, ESTPOTAUS = ?, ESTPOTAFH = ?, ESTPOTAIP = ? WHERE ESTPOTCOD = ?";
            $sql01  = "DELETE FROM ESTPOT WHERE ESTPOTCOD = ?";

            try {
                $connDEFAULT    = getConnectionDEFAULT();

                $stmtDEFAULT00  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtDEFAULT01  = $connDEFAULT->prepare($sql01);
                $stmtDEFAULT01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT00->closeCursor();
                $stmtDEFAULT00  = null;

                $stmtDEFAULT01->closeCursor();
                $stmtDEFAULT01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;

        return $json;
    });