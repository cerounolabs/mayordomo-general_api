<?php
    $app->put('/v1/default/000/{codigo}', function($request) {
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

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03) && isset($val05) && isset($val06) && isset($val07) && isset($val08)) {
            $sql00  = "UPDATE DOMFIC SET DOMFICEDC = ?, DOMFICNOM = ?, DOMFICOBS = ?, DOMFICAEM = ?, DOMFICAUS = ?, DOMFICAFH = ?, DOMFICAIP = ? WHERE DOMFICCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val04, $val05, $val06, $val07, $val08, $val00]); 
                
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

    $app->put('/v1/default/100/{codigo}', function($request) {
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

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val07) && isset($val08) && isset($val09) && isset($val10)) {
            $sql00  = "UPDATE LOCPAI SET LOCPAIEPC = ?, LOCPAINOM = ?, LOCPAIIC2 = ?, LOCPAIIC3 = ?, LOCPAIIN3 = ?, LOCPAIOBS = ?, LOCPAIAEM = ?, LOCPAIAUS = ?, LOCPAIAFH = ?, LOCPAIAIP = ? WHERE LOCPAICOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val00]); 
                
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

    $app->put('/v1/default/200/{codigo}', function($request) {
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

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03) && isset($val05) && isset($val06) && isset($val07) && isset($val08)) {
            $sql00  = "UPDATE LOCDEP SET LOCDEPEDC = ?, LOCDEPPAC = ?, LOCDEPNOM = ?, LOCDEPOBS = ?, LOCDEPAEM = ?, LOCDEPAUS = ?, LOCDEPAFH = ?, LOCDEPAIP = ? WHERE LOCDEPCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val00]); 
                
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

    $app->put('/v1/default/300/{codigo}', function($request) {
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

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val07) && isset($val08) && isset($val09) && isset($val10)) {
            $sql00  = "UPDATE LOCDIS SET LOCDISECC = ?, LOCDISTZC = ?, LOCDISTRC = ?, LOCDISDEC = ?, LOCDISNOM = ?, LOCDISOBS = ?, LOCDISAEM = ?, LOCDISAUS = ?, LOCDISAFH = ?, LOCDISAIP = ? WHERE LOCDISCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val00]);
                
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

    $app->put('/v1/default/400/{codigo}', function($request) {
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

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06) && isset($val07) && isset($val09) && isset($val10) && isset($val11) && isset($val12)) {
            $sql00  = "UPDATE PERFIC SET PERFICECC = ?, PERFICTPC = ?, PERFICTDC = ?, PERFICNOM = ?, PERFICDOC = ?, PERFICTEL = ?, PERFICMAI = ?, PERFICOBS = ?, PERFICAEM = ?, PERFICAUS = ?, PERFICAFH = ?, PERFICAIP = ? WHERE PERFICCOD = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val11, $val12, $val00]);
                
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

    $app->put('/v1/default/500/{codigo}', function($request) {
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
