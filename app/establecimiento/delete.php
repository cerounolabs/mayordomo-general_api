<?php
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