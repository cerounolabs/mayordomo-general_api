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