<?php
    $app->post('/v1/default/000', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_nombre'];
        $val03      = $request->getParsedBody()['tipo_dominio'];
        $val04      = $request->getParsedBody()['tipo_observacion'];
        $val05      = $request->getParsedBody()['tipo_empresa'];
        $val06      = $request->getParsedBody()['tipo_usuario'];
        $val07      = $request->getParsedBody()['tipo_fecha_hora'];
        $val08      = $request->getParsedBody()['tipo_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val05) && isset($val06) && isset($val07) && isset($val08)) {
            $sql00  = "INSERT INTO DOMFIC (DOMFICEDC, DOMFICNOM, DOMFICVAL, DOMFICOBS, DOMFICAEM, DOMFICAUS, DOMFICAFH, DOMFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/020', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_dominio1_codigo'];
        $val03      = $request->getParsedBody()['tipo_dominio2_codigo'];
        $val04      = $request->getParsedBody()['tipo_dominio'];
        $val05      = $request->getParsedBody()['tipo_observacion'];
        $val06      = $request->getParsedBody()['tipo_empresa'];
        $val07      = $request->getParsedBody()['tipo_usuario'];
        $val08      = $request->getParsedBody()['tipo_fecha_hora'];
        $val09      = $request->getParsedBody()['tipo_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val06) && isset($val07) && isset($val08) && isset($val09)) {
            $sql00  = "INSERT INTO DOMSUB (DOMSUBEDC, DOMSUBCO1, DOMSUBCO2, DOMSUBVAL, DOMSUBOBS, DOMSUBAEM, DOMSUBAUS, DOMSUBAFH, DOMSUBAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/040', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_dominio1_codigo'];
        $val03      = $request->getParsedBody()['tipo_dominio2_codigo'];
        $val04      = $request->getParsedBody()['tipo_dominio3_codigo'];
        $val05      = $request->getParsedBody()['tipo_dominio'];
        $val06      = $request->getParsedBody()['tipo_observacion'];
        $val07      = $request->getParsedBody()['tipo_empresa'];
        $val08      = $request->getParsedBody()['tipo_usuario'];
        $val09      = $request->getParsedBody()['tipo_fecha_hora'];
        $val10      = $request->getParsedBody()['tipo_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val07) && isset($val08) && isset($val09) && isset($val10)) {
            $sql00  = "INSERT INTO DOMTRI (DOMTRIEDC, DOMTRICO1, DOMTRICO2, DOMTRICO3, DOMTRIVAL, DOMTRIOBS, DOMTRIAEM, DOMTRIAUS, DOMTRIAFH, DOMTRIAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/100', function($request) {
        require __DIR__.'/../../src/connect.php';

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
            $sql00  = "INSERT INTO LOCPAI (LOCPAIEPC, LOCPAINOM, LOCPAIIC2, LOCPAIIC3, LOCPAIIN3, LOCPAIOBS, LOCPAIAEM, LOCPAIAUS, LOCPAIAFH, LOCPAIAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/200', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['pais_codigo'];
        $val03      = $request->getParsedBody()['departamento_nombre'];
        $val04      = $request->getParsedBody()['departamento_observacion'];
        $val05      = $request->getParsedBody()['departamento_empresa_codigo'];
        $val06      = $request->getParsedBody()['departamento_usuario'];
        $val07      = $request->getParsedBody()['departamento_fecha_hora'];
        $val08      = $request->getParsedBody()['departamento_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val05) && isset($val06) && isset($val07) && isset($val08)) {
            $sql00  = "INSERT INTO LOCDEP (LOCDEPEDC, LOCDEPPAC, LOCDEPNOM, LOCDEPOBS, LOCDEPAEM, LOCDEPAUS, LOCDEPAFH, LOCDEPAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/300', function($request) {
        require __DIR__.'/../../src/connect.php';

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
            $sql00  = "INSERT INTO LOCDIS (LOCDISECC, LOCDISTZC, LOCDISTRC, LOCDISDEC, LOCDISNOM, LOCDISOBS, LOCDISAEM, LOCDISAUS, LOCDISAFH, LOCDISAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/400', function($request) {
        require __DIR__.'/../../src/connect.php';

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

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06) && isset($val07) && isset($val09) && isset($val10) && isset($val11) && isset($val12)) {
            $sql00  = "INSERT INTO PERFIC (PERFICECC, PERFICTPC, PERFICTDC, PERFICNOM, PERFICDOC, PERFICTEL, PERFICMAI, PERFICOBS, PERFICAEM, PERFICAUS, PERFICAFH, PERFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val11, $val12]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/500', function($request) {
        require __DIR__.'/../../src/connect.php';

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
            $sql00  = "INSERT INTO ESTFIC (ESTFICECC, ESTFICTEC, ESTFICTFC, ESTFICPEC, ESTFICDIC, ESTFICNOM, ESTFICTHE, ESTFICTPO, ESTFICCO1, ESTFICCO2, ESTFICCO3, ESTFICOBS, ESTFICAEM, ESTFICAUS, ESTFICAFH, ESTFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val11, $val12, $val13, $val14, $val15, $val16]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/602', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_seccion_nombre'];
        $val04      = $request->getParsedBody()['establecimiento_seccion_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "INSERT INTO ESTSEC (ESTSECECC, ESTSECESC, ESTSECNOM, ESTSECOBS, ESTSECAEM, ESTSECAUS, ESTSECAFH, ESTSECAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $aud01, $aud02, $aud03, $aud04]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->post('/v1/default/603', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_pastura_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_codigo'];
        $val04      = $request->getParsedBody()['establecimiento_seccion_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_potrero_nombre'];
        $val06      = $request->getParsedBody()['establecimiento_potrero_hectarea'];
        $val07      = $request->getParsedBody()['establecimiento_potrero_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "INSERT INTO ESTPOT (ESTPOTECC, ESTPOTTPC, ESTPOTESC, ESTPOTSEC, ESTPOTNOM, ESTPOTHEC, ESTPOTOBS, ESTPOTAEM, ESTPOTAUS, ESTPOTAFH, ESTPOTAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $aud01, $aud02, $aud03, $aud04]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connDEFAULT->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });