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