<?php
    $app->post('/v1/establecimiento/600', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['categoria_codigo'];
        $val04      = $request->getParsedBody()['establecimiento_categoria_cantidad'];
        $val05      = $request->getParsedBody()['establecimiento_categoria_peso_total'];
        $val06      = $request->getParsedBody()['establecimiento_categoria_observacion'];
        $val07      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $val08      = $request->getParsedBody()['auditoria_usuario'];
        $val09      = $request->getParsedBody()['auditoria_fecha_hora'];
        $val10      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val07) && isset($val08) && isset($val09) && isset($val10)) {
            $sql00  = "INSERT INTO ESTCAT (ESTCATECC, ESTCATESC, ESTCATTCC, ESTCATCAN, ESTCATPES, ESTCATOBS, ESTCATAEM, ESTCATAUS, ESTCATAFH, ESTCATAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connESTABLECIMIENTO->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/601', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_usuario_codigo'];
        $val03      = $request->getParsedBody()['tipo_persona_codigo'];
        $val04      = $request->getParsedBody()['tipo_documento_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_codigo'];
        $val06      = $request->getParsedBody()['establecimiento_persona_completo'];
        $val07      = $request->getParsedBody()['establecimiento_persona_documento'];
        $val08      = $request->getParsedBody()['establecimiento_persona_codigo_sitrap'];
        $val09      = $request->getParsedBody()['establecimiento_persona_codigo_sigor'];
        $val10      = $request->getParsedBody()['establecimiento_persona_telefono'];
        $val11      = $request->getParsedBody()['establecimiento_persona_email'];
        $val12      = $request->getParsedBody()['establecimiento_persona_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06)) {
            $sql00  = "INSERT INTO ESTPER (ESTPERECC, ESTPERTUC, ESTPERTPC, ESTPERPDC, ESTPERESC, ESTPERPER, ESTPERDOC, ESTPERCST, ESTPERCSG, ESTPERTEL, ESTPERMAI, ESTPEROBS, ESTPERAEM, ESTPERAUS, ESTPERAFH, ESTPERAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $val10, $val11, $val12, $aud01, $aud02, $aud03, $aud04]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connESTABLECIMIENTO->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/604', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_lote_nombre'];
        $val04      = $request->getParsedBody()['establecimiento_lote_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "INSERT INTO ESTLOT (ESTLOTECC, ESTLOTESC, ESTLOTNOM, ESTLOTOBS, ESTLOTAEM, ESTLOTAUS, ESTLOTAFH, ESTLOTAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02, $val03, $val04, $aud01, $aud02, $aud03, $aud04]); 
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connESTABLECIMIENTO->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/605', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_origen_codigo'];
        $val02      = $request->getParsedBody()['tipo_raza_codigo'];
        $val03      = $request->getParsedBody()['tipo_categoria_codigo'];
        $val04      = $request->getParsedBody()['tipo_subcategoria_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_codigo'];
        $val06      = $request->getParsedBody()['establecimiento_persona_codigo'];
        $val07      = $request->getParsedBody()['establecimiento_poblacion_cantidad'];
        $val08      = $request->getParsedBody()['establecimiento_poblacion_peso'];
        $val09      = $request->getParsedBody()['establecimiento_poblacion_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04)) {
            $sql00  = "SELECT * FROM ESTPOB WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            $sql01  = "UPDATE ESTPOB SET ESTPOBCAN = ?, ESTPOBPES = ?, ESTPOBOBS = ?, ESTPOBAEM = ?, ESTPOBAUS = ?, ESTPOBAFH = ?, ESTPOBAIP = ? WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            $sql02  = "INSERT INTO ESTPOB (ESTPOBTOC, ESTPOBTRC, ESTPOBTCC, ESTPOBTSC, ESTPOBESC, ESTPOBPEC, ESTPOBCAN, ESTPOBPES, ESTPOBOBS, ESTPOBAEM, ESTPOBAUS, ESTPOBAFH, ESTPOBAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04, $val05, $val06]);

                $rowESTABLECIMIENTO00   = $stmtESTABLECIMIENTO00->fetch(PDO::FETCH_ASSOC);

                if (!$rowESTABLECIMIENTO00){
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql02);
                    $stmtESTABLECIMIENTO01->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val09, $aud01, $aud02, $aud03, $aud04]);
                } else {
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                    $stmtESTABLECIMIENTO01->execute([$val07, $val08, $val09, $aud01, $aud02, $aud03, $aud04, $val01, $val02, $val03, $val04, $val05, $val06]);    
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $connESTABLECIMIENTO->lastInsertId()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/606', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['establecimiento_potrero_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_lote_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_codigo'];
        $val04      = $request->getParsedBody()['establecimiento_ubicacion_nombre'];
        $val05      = $request->getParsedBody()['establecimiento_ubicacion_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "SELECT ESTUBCCOD FROM ESTUBC WHERE ESTUBCPOC = ? AND ESTUBCLOT = ? AND ESTUBCESC = ?";
            $sql01  = "INSERT INTO ESTUBC (ESTUBCPOC, ESTUBCLOT, ESTUBCESC, ESTUBCNOM, ESTUBCOBS, ESTUBCAEM, ESTUBCAUS, ESTUBCAFH, ESTUBCAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03]);
                $rowESTABLECIMIENTO00   = $stmtESTABLECIMIENTO00->fetch(PDO::FETCH_ASSOC);

                if (!$rowESTABLECIMIENTO00){
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                    $stmtESTABLECIMIENTO01->execute([$val01, $val02, $val03, $val04, $val05, $aud01, $aud02, $aud03, $aud04]);
                    $codigo                 = $stmtESTABLECIMIENTO01->lastInsertId()['ESTUBCCOD'];

                    $stmtESTABLECIMIENTO01->closeCursor();
                    $stmtESTABLECIMIENTO01  = null;
                } else {
                    $codigo = $rowESTABLECIMIENTO00['ESTUBCCOD'];
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $codigo), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/607', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_categoria_codigo'];
        $val03      = $request->getParsedBody()['tipo_subcategoria_codigo'];
        $val04      = $request->getParsedBody()['establecimiento_ubicacion_codigo'];
        $val05      = $request->getParsedBody()['establecimiento_ubicacion_detalle_cantidad'];
        $val06      = $request->getParsedBody()['establecimiento_ubicacion_detalle_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val02) && isset($val03) && isset($val04) && isset($val05)) {
            $sql00  = "SELECT ESTUBDCOD FROM ESTUBD WHERE ESTUBDECC = ? AND ESTUBDTCC = ? AND ESTUBDTSC = ? AND ESTUBDUBC = ?";
            $sql01  = "INSERT INTO ESTUBD (ESTUBDECC, ESTUBDTCC, ESTUBDTSC, ESTUBDUBC, ESTUBDCAN, ESTUBDOBS, ESTUBDAEM, ESTUBDAUS, ESTUBDAFH, ESTUBDAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql02  = "UPDATE ESTUBD SET ESTUBDCAN = ESTUBDCAN + ?, ESTUBDOBS = ?, ESTUBDAEM = ?, ESTUBDAUS = ?, ESTUBDAFH = ?, ESTUBDAIP = ? WHERE ESTUBDECC = ? AND ESTUBDTCC = ? AND ESTUBDTSC = ? AND ESTUBDUBC = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04]);

                $rowESTABLECIMIENTO00   = $stmtESTABLECIMIENTO00->fetch(PDO::FETCH_ASSOC);

                if (!$rowESTABLECIMIENTO00){
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                    $stmtESTABLECIMIENTO01->execute([$val01, $val02, $val03, $val04, $val05, $val06, $aud01, $aud02, $aud03, $aud04]);
                    $codigo     = $connESTABLECIMIENTO->lastInsertId()['ESTUBDCOD'];
                    $mensaje    = 'Success INSERT';
                } else {
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql02);
                    $stmtESTABLECIMIENTO01->execute([$val05, $val06, $aud01, $aud02, $aud03, $aud04, $val01, $val02, $val03, $val04]);
                    $codigo = $rowESTABLECIMIENTO00['ESTUBDCOD'];
                    $mensaje    = 'Success UPDATE'; 
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => $mensaje, 'codigo' => $codigo), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->post('/v1/establecimiento/608', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_origen_codigo'];
        $val03      = $request->getParsedBody()['tipo_raza_codigo'];
        $val04      = $request->getParsedBody()['tipo_categoria_codigo'];
        $val05      = $request->getParsedBody()['tipo_subcategoria_codigo'];
        $val06      = $request->getParsedBody()['tipo_peso_codigo'];
        $val07      = $request->getParsedBody()['establecimiento_codigo'];
        $val08      = $request->getParsedBody()['establecimiento_persona_codigo'];
        $val09      = $request->getParsedBody()['animal_codigo_nacimiento'];
        $val10      = $request->getParsedBody()['animal_pesaje_fecha'];
        $val11      = $request->getParsedBody()['animal_pesaje_peso'];
        $val12      = $request->getParsedBody()['animal_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06) && isset($val07) && isset($val08) && isset($val09) && isset($val10) && isset($val11)) {
            $sql00  = "INSERT INTO ANIFIC (ANIFICECC, ANIFICTOC, ANIFICTRC, ANIFICTCC, ANIFICTSC, ANIFICESC, ANIFICPEC, ANIFICCO1, ANIFICOBS, ANIFICAEM, ANIFICAUS, ANIFICAFH, ANIFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql01  = "INSERT INTO ANINAC (ANINACESC, ANINACPEC, ANINACANC, ANINACFEC, ANINACOBS, ANINACAEM, ANINACAUS, ANINACAFH, ANINACAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql02  = "INSERT INTO ANIPES (ANIPESTPC, ANIPESESC, ANIPESANC, ANIPESFEC, ANIPESPES, ANIPESOBS, ANIPESAEM, ANIPESAUS, ANIPESAFH, ANIPESAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql03  = "SELECT ESTPOBCOD FROM ESTPOB WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            $sql041 = "INSERT INTO ESTPOB (ESTPOBTOC, ESTPOBTRC, ESTPOBTCC, ESTPOBTSC, ESTPOBESC, ESTPOBPEC, ESTPOBCAN, ESTPOBPES, ESTPOBOBS, ESTPOBAEM, ESTPOBAUS, ESTPOBAFH, ESTPOBAIP) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, ?, ?, ?, ?)";
            $sql042 = "UPDATE ESTPOB SET ESTPOBCAN = ESTPOBCAN + 1, ESTPOBAEM = ?, ESTPOBAUS = ?, ESTPOBAFH = ?, ESTPOBAIP = ? WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            
            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04, $val05, $val07, $val08, $val09, $val12, $aud01, $aud02, $aud03, $aud04]);
                $ANIFICCOD              = $connESTABLECIMIENTO->lastInsertId()['ANIFICCOD'];

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val07, $val08, $ANIFICCOD, $val10, $val12, $aud01, $aud02, $aud03, $aud04]);
                
                $stmtESTABLECIMIENTO02  = $connESTABLECIMIENTO->prepare($sql02);
                $stmtESTABLECIMIENTO02->execute([$val06, $val07, $ANIFICCOD, $val10, $val11, $val12, $aud01, $aud02, $aud03, $aud04]);

                $stmtESTABLECIMIENTO03  = $connESTABLECIMIENTO->prepare($sql03);
                $stmtESTABLECIMIENTO03->execute([$val02, $val03, $val04, $val05, $val07, $val08]);
                $rowESTABLECIMIENTO03   = $stmtESTABLECIMIENTO03->fetch(PDO::FETCH_ASSOC);

                if (!$rowESTABLECIMIENTO03){
                    $stmtESTABLECIMIENTO04 = $connESTABLECIMIENTO->prepare($sql041);
                    $stmtESTABLECIMIENTO04->execute([$val02, $val03, $val04, $val05, $val07, $val08, $val11, $val12, $aud01, $aud02, $aud03, $aud04]);
                } else {
                    $stmtESTABLECIMIENTO04  = $connESTABLECIMIENTO->prepare($sql042);
                    $stmtESTABLECIMIENTO04->execute([$aud01, $aud02, $aud03, $aud04, $val02, $val03, $val04, $val05, $val07, $val08]); 
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success PROCESO', 'codigo' => 0), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01 = null;

                $stmtESTABLECIMIENTO02->closeCursor();
                $stmtESTABLECIMIENTO02 = null;

                $stmtESTABLECIMIENTO03->closeCursor();
                $stmtESTABLECIMIENTO03 = null;

                $stmtESTABLECIMIENTO04->closeCursor();
                $stmtESTABLECIMIENTO04 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->post('/v1/establecimiento/609', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_origen_codigo'];
        $val03      = $request->getParsedBody()['tipo_raza_codigo'];
        $val04      = $request->getParsedBody()['tipo_categoria_codigo'];
        $val05      = $request->getParsedBody()['tipo_subcategoria_codigo'];
        $val06      = $request->getParsedBody()['tipo_donacion_codigo'];
        $val07      = $request->getParsedBody()['establecimiento_codigo'];
        $val08      = $request->getParsedBody()['establecimiento_persona_codigo'];
        $val09      = $request->getParsedBody()['animal_codigo_donacion'];
        $val10      = $request->getParsedBody()['animal_donacion_fecha'];
        $val11      = $request->getParsedBody()['animal_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05) && isset($val06) && isset($val07) && isset($val08) && isset($val09)) {
            $sql00  = "INSERT INTO ANIFIC (ANIFICECC, ANIFICTOC, ANIFICTRC, ANIFICTCC, ANIFICTSC, ANIFICESC, ANIFICPEC, ANIFICCO2, ANIFICOBS, ANIFICAEM, ANIFICAUS, ANIFICAFH, ANIFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql01  = "INSERT INTO ANIDON (ANIDONTDC, ANIDONESC, ANIDONANC, ANIDONFEC, ANIDONOBS, ANIDONAEM, ANIDONAUS, ANIDONAFH, ANIDONAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql03  = "SELECT ESTPOBCOD FROM ESTPOB WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            $sql041 = "INSERT INTO ESTPOB (ESTPOBTOC, ESTPOBTRC, ESTPOBTCC, ESTPOBTSC, ESTPOBESC, ESTPOBPEC, ESTPOBCAN, ESTPOBOBS, ESTPOBAEM, ESTPOBAUS, ESTPOBAFH, ESTPOBAIP) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, ?, ?, ?)";
            $sql042 = "UPDATE ESTPOB SET ESTPOBCAN = ESTPOBCAN + 1, ESTPOBAEM = ?, ESTPOBAUS = ?, ESTPOBAFH = ?, ESTPOBAIP = ? WHERE ESTPOBTOC = ? AND ESTPOBTRC = ? AND ESTPOBTCC = ? AND ESTPOBTSC = ? AND ESTPOBESC = ? AND ESTPOBPEC = ?";
            
            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04, $val05, $val07, $val08, $val09, $val11, $aud01, $aud02, $aud03, $aud04]);
                $ANIFICCOD              = $connESTABLECIMIENTO->lastInsertId()['ANIFICCOD'];

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val06, $val07, $ANIFICCOD, $val10, $val11, $aud01, $aud02, $aud03, $aud04]);
                
                $stmtESTABLECIMIENTO03  = $connESTABLECIMIENTO->prepare($sql03);
                $stmtESTABLECIMIENTO03->execute([$val02, $val03, $val04, $val05, $val07, $val08]);
                $rowESTABLECIMIENTO03   = $stmtESTABLECIMIENTO03->fetch(PDO::FETCH_ASSOC);

                if (!$rowESTABLECIMIENTO03){
                    $stmtESTABLECIMIENTO04 = $connESTABLECIMIENTO->prepare($sql041);
                    $stmtESTABLECIMIENTO04->execute([$val02, $val03, $val04, $val05, $val07, $val08, $val11, $aud01, $aud02, $aud03, $aud04]);
                } else {
                    $stmtESTABLECIMIENTO04  = $connESTABLECIMIENTO->prepare($sql042);
                    $stmtESTABLECIMIENTO04->execute([$aud01, $aud02, $aud03, $aud04, $val02, $val03, $val04, $val05, $val07, $val08]); 
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success PROCESO', 'codigo' => 0), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01 = null;

                $stmtESTABLECIMIENTO03->closeCursor();
                $stmtESTABLECIMIENTO03 = null;

                $stmtESTABLECIMIENTO04->closeCursor();
                $stmtESTABLECIMIENTO04 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->post('/v1/establecimiento/610', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['animal_compra_chofer'];
        $val02      = $request->getParsedBody()['animal_compra_chapa'];
        $val03      = $request->getParsedBody()['animal_compra_entregado'];
        $val04      = $request->getParsedBody()['animal_compra_recibo'];
        $val05      = $request->getParsedBody()['animal_compra_cota'];
        $val06      = $request->getParsedBody()['animal_compra_guia'];
        $val07      = $request->getParsedBody()['animal_compra_factura'];
        $val08      = $request->getParsedBody()['animal_compra_fecha'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "INSERT INTO ANICOC (ANICOCCHO, ANICOCCHA, ANICOCENT, ANICOCREC, ANICOCCOT, ANICOCGUI, ANICOCFAC, ANICOCFEC, ANICOCAEM, ANICOCAUS, ANICOCAFH, ANICOCAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $aud01, $aud02, $aud03, $aud04]);
                $codigo                 = $stmtESTABLECIMIENTO01->lastInsertId()['ANICOCCOD'];
                
                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $codigo), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->post('/v1/establecimiento/610/detalle', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['tipo_origen_codigo'];
        $val03      = $request->getParsedBody()['tipo_raza_codigo'];
        $val04      = $request->getParsedBody()['tipo_categoria_codigo'];
        $val05      = $request->getParsedBody()['tipo_subcategoria_codigo'];
        $val06      = $request->getParsedBody()['establecimiento_codigo'];
        $val07      = $request->getParsedBody()['establecimiento_persona_codigo'];
        $val08      = $request->getParsedBody()['animal_codigo_compra'];
        $val09      = $request->getParsedBody()['animal_compra_codigo'];
        $val10      = $request->getParsedBody()['animal_compra_cantidad'];
        $val11      = $request->getParsedBody()['animal_observacion'];

        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "INSERT INTO ANIFIC (ANIFICECC, ANIFICTOC, ANIFICTRC, ANIFICTCC, ANIFICTSC, ANIFICESC, ANIFICPEC, ANIFICCO3, ANIFICOBS, ANIFICAEM, ANIFICAUS, ANIFICAFH, ANIFICAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql01  = "INSERT INTO ANICOD (ANICODANC, ANICODCOC, ANICODAEM, ANICODAUS, ANICODAFH, ANICODAIP) VALUES (?, ?, ?, ?, ?, ?)";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);

                for ($i=0; $i < $val11; $i++) {
                    $val08      = $val08.''.$i;
                    $stmtESTABLECIMIENTO00->execute([$val01, $val02, $val03, $val04, $val05, $val06, $val07, $val08, $val11, $aud01, $aud02, $aud03, $aud04]);
                    $ANIFICCOD  = $stmtESTABLECIMIENTO00->lastInsertId()['ANIFICCOD'];

                    $stmtESTABLECIMIENTO01->execute([$ANIFICCOD, $val09, $aud01, $aud02, $aud03, $aud04]);
                }

                header("Content-Type: application/json; charset=utf-8");
                $json       = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success INSERT', 'codigo' => $codigo), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00 = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });