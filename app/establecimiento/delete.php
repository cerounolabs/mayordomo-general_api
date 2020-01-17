<?php
    $app->delete('/v1/establecimiento/500/poblacion/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTPOB SET ESTPOBAEM = ?, ESTPOBAUS = ?, ESTPOBAFH = ?, ESTPOBAIP = ? WHERE ESTPOBCOD = ?";
            $sql01  = "DELETE FROM ESTPOB WHERE ESTPOBCOD = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00  = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->delete('/v1/establecimiento/500/persona/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTPER SET ESTPERAEM = ?, ESTPERAUS = ?, ESTPERAFH = ?, ESTPERAIP = ? WHERE ESTPERCOD = ?";
            $sql01  = "DELETE FROM ESTPER WHERE ESTPERCOD = ?";

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

    $app->delete('/v1/establecimiento/500/seccion/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val00      = $request->getAttribute('establecimiento');
        $val01      = $request->getParsedBody()['tipo_estado_codigo'];
        $val02      = $request->getParsedBody()['establecimiento_codigo'];
        $val03      = $request->getParsedBody()['establecimiento_seccion_nombre'];
        $val04      = $request->getParsedBody()['establecimiento_seccion_observacion'];
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($val00) && isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "DELETE FROM ESTSEC WHERE ESTSECCOD = ? AND ESTSECESC = ?";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val00, $val02]); 
                
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
    
    /****** */
    $app->delete('/v1/establecimiento/601/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTPER SET ESTPERAEM = ?, ESTPERAUS = ?, ESTPERAFH = ?, ESTPERAIP = ? WHERE ESTPERCOD = ?";
            $sql01  = "DELETE FROM ESTPER WHERE ESTPERCOD = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00  = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->delete('/v1/establecimiento/604/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTLOT SET ESTLOTAEM = ?, ESTLOTAUS = ?, ESTLOTAFH = ?, ESTLOTAIP = ? WHERE ESTLOTCOD = ?";
            $sql01  = "DELETE FROM ESTLOT WHERE ESTLOTCOD = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00  = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->delete('/v1/establecimiento/605/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTPOB SET ESTPOBAEM = ?, ESTPOBAUS = ?, ESTPOBAFH = ?, ESTPOBAIP = ? WHERE ESTPOBCOD = ?";
            $sql01  = "DELETE FROM ESTPOB WHERE ESTPOBCOD = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00  = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });

    $app->delete('/v1/establecimiento/607/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $aud01      = $request->getParsedBody()['auditoria_empresa_codigo'];
        $aud02      = $request->getParsedBody()['auditoria_usuario'];
        $aud03      = $request->getParsedBody()['auditoria_fecha_hora'];
        $aud04      = $request->getParsedBody()['auditoria_ip'];

        if (isset($aud01) && isset($aud02) && isset($aud03) && isset($aud04) && isset($val01)) {
            $sql00  = "UPDATE ESTUBD SET ESTUBDAEM = ?, ESTUBDAUS = ?, ESTUBDAFH = ?, ESTUBDAIP = ? WHERE ESTUBDCOD = ?";
            $sql01  = "DELETE FROM ESTUBD WHERE ESTUBDCOD = ?";

            try {
                $connESTABLECIMIENTO    = getConnectionESTABLECIMIENTO();

                $stmtESTABLECIMIENTO00  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO00->execute([$aud01, $aud02, $aud03, $aud04, $val01]);

                $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                $stmtESTABLECIMIENTO01->execute([$val01]);

                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DELETE'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

                $stmtESTABLECIMIENTO00->closeCursor();
                $stmtESTABLECIMIENTO00  = null;

                $stmtESTABLECIMIENTO01->closeCursor();
                $stmtESTABLECIMIENTO01  = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json                   = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error INSERT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;

        return $json;
    });