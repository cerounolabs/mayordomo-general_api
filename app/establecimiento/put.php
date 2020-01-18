<?php
    $app->put('/v1/establecimiento/500/establecimiento/{codigo}', function($request) {
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
        $val11      = $request->getParsedBody()['establecimiento_codigo_sitrap'];
        $val12      = $request->getParsedBody()['establecimiento_observacion'];
        $val13      = $request->getParsedBody()['establecimiento_empresa_codigo'];
        $val14      = $request->getParsedBody()['establecimiento_usuario'];
        $val15      = $request->getParsedBody()['establecimiento_fecha_hora'];
        $val16      = $request->getParsedBody()['establecimiento_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06) && isset($val13) && isset($val14) && isset($val15) && isset($val16)) {
            $sql00  = "UPDATE ESTFIC SET ESTFICECC = ?, ESTFICTEC = ?, ESTFICTFC = ?, ESTFICPEC = ?, ESTFICDIC = ?, ESTFICNOM = ?, ESTFICTHE = ?, ESTFICTPO = ?, ESTFICCO1 = ?, ESTFICCO2 = ?, ESTFICCO3 = ?, ESTFICOBS = ?, ESTFICAEM = ?, ESTFICAUS = ?, ESTFICAFH = ?, ESTFICAIP = ? WHERE ESTFICCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val11, $val12, $val13, $val14, $val15, $val16, $val00]);
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success UPDATE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error UPDATE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->put('/v1/establecimiento/500/persona/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_usuario_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_codigo'];
        $val04      = $request->getParsedBody()['persona_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_persona_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03) && isset($val04)) {
            $sql00  = "UPDATE ESTPER SET ESTPERECC = ?, ESTPERTUC = ?, ESTPEROBS = ?, ESTPERAEM = ?, ESTPERAUS = ?, ESTPERAFH = ?, ESTPERAIP = ? WHERE ESTPERCOD = ? AND ESTPERESC = ? AND ESTPERPEC = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val05, $aud01, $aud02, $aud03, $aud04, $val00, $val03, $val04]);
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success UPDATE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error UPDATE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->put('/v1/establecimiento/500/seccion/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_seccion_nombre'];
        $val04      = $request->getParsedBody()['establecimiento_seccion_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "UPDATE ESTSEC SET ESTSECECC = ?, ESTSECNOM = ?, ESTSECOBS = ?, ESTSECAEM = ?, ESTSECAUS = ?, ESTSECAFH = ?, ESTSECAIP = ? WHERE ESTSECCOD = ? AND ESTSECESC = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val03, $val04, $aud01, $aud02, $aud03, $aud04, $val00, $val02]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success UPDATE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error UPDATE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->put('/v1/establecimiento/500/potrero/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_pastura1_codigo'];
        $val03      = $request->getParsedBody()['tipo_pastura2_codigo'];
        $val04      = $request->getParsedBody()['establecimiento_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_seccion_codigo'];
        $val06      = $request->getParsedBody()['establecimiento_potrero_nombre'];
        $val07      = $request->getParsedBody()['establecimiento_potrero_hectarea'];
        $val08      = $request->getParsedBody()['establecimiento_potrero_capacidad'];
        $val09      = $request->getParsedBody()['establecimiento_potrero_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "UPDATE ESTPOT SET ESTPOTECC = ?, ESTPOTTPC = ?, ESTPOTTAC = ?, ESTPOTSEC = ?, ESTPOTNOM = ?, ESTPOTHEC = ?, ESTPOTCAP = ?, ESTPOTOBS = ?, ESTPOTAEM = ?, ESTPOTAUS = ?, ESTPOTAFH = ?, ESTPOTAIP = ? WHERE ESTPOTCOD = ? AND ESTPOTESC = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val05, $val06, $val07, $val08, $val09, $aud01, $aud02, $aud03, $aud04, $val00, $val04]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success UPDATE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error UPDATE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->put('/v1/establecimiento/500/lote/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('codigo');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_lote_nombre'];
        $val04      = $request->getParsedBody()['establecimiento_lote_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "UPDATE ESTLOT SET ESTLOTECC = ?, ESTLOTNOM = ?, ESTLOTOBS = ?, ESTLOTAEM = ?, ESTLOTAUS = ?, ESTLOTAFH = ?, ESTLOTAIP = ? WHERE ESTLOTCOD = ? AND ESTLOTESC = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val03, $val04, $aud01, $aud02, $aud03, $aud04, $val00, $val02]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success UPDATE', 'codigo' => $val00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error UPDATE: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });