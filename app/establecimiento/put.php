<?php
    $app->put('/v1/establecimiento/500/seccion/{establecimiento}', function($request) {
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