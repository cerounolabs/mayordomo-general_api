<?php
    $app->get('/v1/default/000', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.DOMFICCOD         AS          tipo_codigo,
        a.DOMFICNOM         AS          tipo_nombre,
        a.DOMFICVAL         AS          tipo_dominio,
        a.DOMFICOBS         AS          tipo_observacion,
        a.DOMFICAEM         AS          tipo_empresa_codigo,
        a.DOMFICAEM         AS          tipo_empresa_nombre,
        a.DOMFICAUS         AS          tipo_usuario,
        a.DOMFICAFH         AS          tipo_fecha_hora,
        a.DOMFICAIP         AS          tipo_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre
        
        FROM DOMFIC a
        INNER JOIN DOMFIC b ON a.DOMFICEDC = b.DOMFICCOD

        ORDER BY a.DOMFICNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'tipo_codigo'           => $rowDEFAULT['tipo_codigo'],
                    'tipo_estado_codigo'    => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'    => $rowDEFAULT['tipo_estado_nombre'],
                    'tipo_nombre'           => $rowDEFAULT['tipo_nombre'],
                    'tipo_dominio'          => $rowDEFAULT['tipo_dominio'],
                    'tipo_observacion'      => $rowDEFAULT['tipo_observacion'],
                    'tipo_empresa_codigo'   => $rowDEFAULT['tipo_empresa_codigo'],
                    'tipo_empresa_nombre'   => $rowDEFAULT['tipo_empresa_nombre'],
                    'tipo_usuario'          => $rowDEFAULT['tipo_usuario'],
                    'tipo_fecha_hora'       => date_format(date_create($rowDEFAULT['tipo_fecha_hora']), 'd/m/Y H:i:s'),
                    'tipo_ip'               => $rowDEFAULT['tipo_ip']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_codigo'           => '',
                    'tipo_estado_codigo'    => '',
                    'tipo_estado_nombre'    => '',
                    'tipo_nombre'           => '',
                    'tipo_dominio'          => '',
                    'tipo_observacion'      => '',
                    'tipo_empresa_codigo'   => '',
                    'tipo_empresa_nombre'   => '',
                    'tipo_usuario'          => '',
                    'tipo_fecha_hora'       => '',
                    'tipo_ip'               => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtDEFAULT->closeCursor();
            $stmtDEFAULT = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->get('/v1/default/000/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.DOMFICCOD         AS          tipo_codigo,
            a.DOMFICNOM         AS          tipo_nombre,
            a.DOMFICVAL         AS          tipo_dominio,
            a.DOMFICOBS         AS          tipo_observacion,
            a.DOMFICAEM         AS          tipo_empresa_codigo,
            a.DOMFICAEM         AS          tipo_empresa_nombre,
            a.DOMFICAUS         AS          tipo_usuario,
            a.DOMFICAFH         AS          tipo_fecha_hora,
            a.DOMFICAIP         AS          tipo_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre
            
            FROM DOMFIC a
            INNER JOIN DOMFIC b ON a.DOMFICEDC = b.DOMFICCOD

            WHERE a.DOMFICCOD = ? 

            ORDER BY a.DOMFICNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_codigo'           => $rowDEFAULT['tipo_codigo'],
                        'tipo_estado_codigo'    => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'    => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_nombre'           => $rowDEFAULT['tipo_nombre'],
                        'tipo_dominio'          => $rowDEFAULT['tipo_dominio'],
                        'tipo_observacion'      => $rowDEFAULT['tipo_observacion'],
                        'tipo_empresa_codigo'   => $rowDEFAULT['tipo_empresa_codigo'],
                        'tipo_empresa_nombre'   => $rowDEFAULT['tipo_empresa_nombre'],
                        'tipo_usuario'          => $rowDEFAULT['tipo_usuario'],
                        'tipo_fecha_hora'       => date_format(date_create($rowDEFAULT['tipo_fecha_hora']), 'd/m/Y H:i:s'),
                        'tipo_ip'               => $rowDEFAULT['tipo_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_codigo'           => '',
                        'tipo_estado_codigo'    => '',
                        'tipo_estado_nombre'    => '',
                        'tipo_nombre'           => '',
                        'tipo_dominio'          => '',
                        'tipo_observacion'      => '',
                        'tipo_empresa_codigo'   => '',
                        'tipo_empresa_nombre'   => '',
                        'tipo_usuario'          => '',
                        'tipo_fecha_hora'       => '',
                        'tipo_ip'               => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->get('/v1/default/000/dominio/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.DOMFICCOD         AS          tipo_codigo,
            a.DOMFICNOM         AS          tipo_nombre,
            a.DOMFICVAL         AS          tipo_dominio,
            a.DOMFICOBS         AS          tipo_observacion,
            a.DOMFICAEM         AS          tipo_empresa_codigo,
            a.DOMFICAEM         AS          tipo_empresa_nombre,
            a.DOMFICAUS         AS          tipo_usuario,
            a.DOMFICAFH         AS          tipo_fecha_hora,
            a.DOMFICAIP         AS          tipo_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre
            
            FROM DOMFIC a
            INNER JOIN DOMFIC b ON a.DOMFICEDC = b.DOMFICCOD

            WHERE a.DOMFICVAL = ? 

            ORDER BY a.DOMFICNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_codigo'           => $rowDEFAULT['tipo_codigo'],
                        'tipo_estado_codigo'    => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'    => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_nombre'           => $rowDEFAULT['tipo_nombre'],
                        'tipo_dominio'          => $rowDEFAULT['tipo_dominio'],
                        'tipo_observacion'      => $rowDEFAULT['tipo_observacion'],
                        'tipo_empresa_codigo'   => $rowDEFAULT['tipo_empresa_codigo'],
                        'tipo_empresa_nombre'   => $rowDEFAULT['tipo_empresa_nombre'],
                        'tipo_usuario'          => $rowDEFAULT['tipo_usuario'],
                        'tipo_fecha_hora'       => date_format(date_create($rowDEFAULT['tipo_fecha_hora']), 'd/m/Y H:i:s'),
                        'tipo_ip'               => $rowDEFAULT['tipo_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_codigo'           => '',
                        'tipo_estado_codigo'    => '',
                        'tipo_estado_nombre'    => '',
                        'tipo_nombre'           => '',
                        'tipo_dominio'          => '',
                        'tipo_observacion'      => '',
                        'tipo_empresa_codigo'   => '',
                        'tipo_empresa_nombre'   => '',
                        'tipo_usuario'          => '',
                        'tipo_fecha_hora'       => '',
                        'tipo_ip'               => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });

    $app->get('/v1/default/000/auditoria/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

		$val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.DOMFICACOD            AS          auditoria_codigo,
            a.DOMFICAMET            AS          auditoria_metodo,
            a.DOMFICAEMP            AS          auditoria_empresa_codigo,
            a.DOMFICAEMP            AS          auditoria_empresa_nombre,
            a.DOMFICAUSU            AS          auditoria_usuario,
            a.DOMFICAFEC            AS          auditoria_fecha_hora,
            a.DOMFICADIP            AS          auditoria_ip,

            a.DOMFICACODOLD         AS          auditoria_antes_tipo_codigo,
            b.DOMFICCOD             AS          auditoria_antes_tipo_estado_codigo,
            b.DOMFICNOM             AS          auditoria_antes_tipo_estado_nombre,
            a.DOMFICANOMOLD         AS          auditoria_antes_tipo_nombre,
            a.DOMFICAVALOLD         AS          auditoria_antes_tipo_dominio,
            a.DOMFICAOBSOLD         AS          auditoria_antes_tipo_observacion,

            a.DOMFICACODNEW         AS          auditoria_despues_tipo_codigo,
            c.DOMFICCOD             AS          auditoria_despues_tipo_estado_codigo,
            c.DOMFICNOM             AS          auditoria_despues_tipo_estado_nombre,
            a.DOMFICANOMNEW         AS          auditoria_despues_tipo_nombre,
            a.DOMFICAVALNEW         AS          auditoria_despues_tipo_dominio,
            a.DOMFICAOBSNEW         AS          auditoria_despues_tipo_observacion
            
            FROM DOMFICA a
            
            WHERE a.DOMFICAVALOLD = ? OR a.DOMFICAVALNEW = ?
            LEFT JOIN DOMFIC b ON a.DOMFICAEDCOLD = b.DOMFICCOD
            LEFT JOIN DOMFIC c ON a.DOMFICAEDCNEW = c.DOMFICCOD
            
            ORDER BY a.DOMFICACOD DESC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val01]);

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'auditoria_codigo'                      => $rowDEFAULT['auditoria_codigo'],
                        'auditoria_metodo'                      => $rowDEFAULT['auditoria_metodo'],
                        'auditoria_empresa_codigo'              => $rowDEFAULT['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'              => $rowDEFAULT['auditoria_empresa_nombre'],
                        'auditoria_usuario'                     => $rowDEFAULT['auditoria_usuario'],
                        'auditoria_fecha_hora'                  => date_format(date_create($rowDEFAULT['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                          => $rowDEFAULT['auditoria_ip'],
                        'auditoria_antes_tipo_codigo'           => $rowDEFAULT['auditoria_antes_tipo_codigo'],
                        'auditoria_antes_tipo_estado_codigo'    => $rowDEFAULT['auditoria_antes_tipo_estado_codigo'],
                        'auditoria_antes_tipo_estado_nombre'    => $rowDEFAULT['auditoria_antes_tipo_estado_nombre'],
                        'auditoria_antes_tipo_nombre'           => $rowDEFAULT['auditoria_antes_tipo_nombre'],
                        'auditoria_antes_tipo_dominio'          => $rowDEFAULT['auditoria_antes_tipo_dominio'],
                        'auditoria_antes_tipo_observacion'      => $rowDEFAULT['auditoria_antes_tipo_observacion'],
                        'auditoria_despues_tipo_codigo'         => $rowDEFAULT['auditoria_despues_tipo_codigo'],
                        'auditoria_despues_tipo_estado_codigo'  => $rowDEFAULT['auditoria_despues_tipo_estado_codigo'],
                        'auditoria_despues_tipo_estado_nombre'  => $rowDEFAULT['auditoria_despues_tipo_estado_nombre'],
                        'auditoria_despues_tipo_nombre'         => $rowDEFAULT['auditoria_despues_tipo_nombre'],
                        'auditoria_despues_tipo_dominio'        => $rowDEFAULT['auditoria_despues_tipo_dominio'],
                        'auditoria_despues_tipo_observacion'    => $rowDEFAULT['auditoria_despues_tipo_observacion']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'auditoria_codigo'                      => '',
                        'auditoria_metodo'                      => '',
                        'auditoria_empresa_codigo'              => '',
                        'auditoria_empresa_nombre'              => '',
                        'auditoria_usuario'                     => '',
                        'auditoria_fecha_hora'                  => '',
                        'auditoria_ip'                          => '',
                        'auditoria_antes_tipo_codigo'           => '',
                        'auditoria_antes_tipo_estado_codigo'    => '',
                        'auditoria_antes_tipo_estado_nombre'    => '',
                        'auditoria_antes_tipo_nombre'           => '',
                        'auditoria_antes_tipo_dominio'          => '',
                        'auditoria_antes_tipo_observacion'      => '',
                        'auditoria_despues_tipo_codigo'         => '',
                        'auditoria_despues_tipo_estado_codigo'  => '',
                        'auditoria_despues_tipo_estado_nombre'  => '',
                        'auditoria_despues_tipo_nombre'         => '',
                        'auditoria_despues_tipo_dominio'        => '',
                        'auditoria_despues_tipo_observacion'    => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtDEFAULT->closeCursor();
                $stmtDEFAULT = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connDEFAULT  = null;
        
        return $json;
    });