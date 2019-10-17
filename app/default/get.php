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

    $app->get('/v1/default/100', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.LOCPAICOD         AS          pais_codigo,
		a.LOCPAINOM         AS          pais_nombre,
		a.LOCPAIIC2         AS          pais_iso3166_char2,
        a.LOCPAIIC3         AS          pais_iso3166_char3,
        a.LOCPAIIN3         AS          pais_iso3166_numero,
        a.LOCPAIOBS         AS          pais_observacion,
        a.LOCPAIAEM         AS          pais_empresa_codigo,
        a.LOCPAIAEM         AS          pais_empresa_nombre,
        a.LOCPAIAUS         AS          pais_usuario,
        a.LOCPAIAFH         AS          pais_fecha_hora,
        a.LOCPAIAIP         AS          pais_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre
        
        FROM LOCPAI a
        INNER JOIN DOMFIC b ON a.LOCPAIEPC = b.DOMFICCOD

        ORDER BY a.LOCPAINOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'pais_codigo'                   => $rowDEFAULT['pais_codigo'],
                    'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'            => $rowDEFAULT['tipo_estado_nombre'],
                    'pais_nombre'                   => $rowDEFAULT['pais_nombre'],
                    'pais_iso3166_char2'            => $rowDEFAULT['pais_iso3166_char2'],
                    'pais_iso3166_char3'            => $rowDEFAULT['pais_iso3166_char3'],
                    'pais_iso3166_numero'           => $rowDEFAULT['pais_iso3166_numero'],
                    'pais_observacion'              => $rowDEFAULT['pais_observacion'],
                    'pais_empresa_codigo'           => $rowDEFAULT['pais_empresa_codigo'],
                    'pais_empresa_nombre'           => $rowDEFAULT['pais_empresa_nombre'],
                    'pais_usuario'                  => $rowDEFAULT['pais_usuario'],
                    'pais_fecha_hora'               => date_format(date_create($rowDEFAULT['pais_fecha_hora']), 'd/m/Y H:i:s'),
                    'pais_ip'                       => $rowDEFAULT['pais_ip']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'pais_codigo'                   => '',
                    'tipo_estado_codigo'            => '',
                    'tipo_estado_nombre'            => '',
                    'pais_nombre'                   => '',
                    'pais_iso3166_char2'            => '',
                    'pais_iso3166_char3'            => '',
                    'pais_iso3166_numero'           => '',
                    'pais_observacion'              => '',
                    'pais_empresa_codigo'           => '',
                    'pais_empresa_nombre'           => '',
                    'pais_usuario'                  => '',
                    'pais_fecha_hora'               => '',
                    'pais_ip'                       => ''
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

    $app->get('/v1/default/100/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.LOCPAICOD         AS          pais_codigo,
            a.LOCPAINOM         AS          pais_nombre,
            a.LOCPAIIC2         AS          pais_iso3166_char2,
            a.LOCPAIIC3         AS          pais_iso3166_char3,
            a.LOCPAIIN3         AS          pais_iso3166_numero,
            a.LOCPAIOBS         AS          pais_observacion,
            a.LOCPAIAEM         AS          pais_empresa_codigo,
            a.LOCPAIAEM         AS          pais_empresa_nombre,
            a.LOCPAIAUS         AS          pais_usuario,
            a.LOCPAIAFH         AS          pais_fecha_hora,
            a.LOCPAIAIP         AS          pais_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre
            
            FROM LOCPAI a
            INNER JOIN DOMFIC b ON a.LOCPAIEPC = b.DOMFICCOD

            WHERE a.LOCPAICOD = ?

            ORDER BY a.LOCPAINOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'pais_codigo'                   => $rowDEFAULT['pais_codigo'],
                        'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'            => $rowDEFAULT['tipo_estado_nombre'],
                        'pais_nombre'                   => $rowDEFAULT['pais_nombre'],
                        'pais_iso3166_char2'            => $rowDEFAULT['pais_iso3166_char2'],
                        'pais_iso3166_char3'            => $rowDEFAULT['pais_iso3166_char3'],
                        'pais_iso3166_numero'           => $rowDEFAULT['pais_iso3166_numero'],
                        'pais_observacion'              => $rowDEFAULT['pais_observacion'],
                        'pais_empresa_codigo'           => $rowDEFAULT['pais_empresa_codigo'],
                        'pais_empresa_nombre'           => $rowDEFAULT['pais_empresa_nombre'],
                        'pais_usuario'                  => $rowDEFAULT['pais_usuario'],
                        'pais_fecha_hora'               => date_format(date_create($rowDEFAULT['pais_fecha_hora']), 'd/m/Y H:i:s'),
                        'pais_ip'                       => $rowDEFAULT['pais_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'pais_codigo'                   => '',
                        'tipo_estado_codigo'            => '',
                        'tipo_estado_nombre'            => '',
                        'pais_nombre'                   => '',
                        'pais_iso3166_char2'            => '',
                        'pais_iso3166_char3'            => '',
                        'pais_iso3166_numero'           => '',
                        'pais_observacion'              => '',
                        'pais_empresa_codigo'           => '',
                        'pais_empresa_nombre'           => '',
                        'pais_usuario'                  => '',
                        'pais_fecha_hora'               => '',
                        'pais_ip'                       => ''
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

    $app->get('/v1/default/100/auditoria/', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.LOCPAIACOD            AS          auditoria_codigo,
        a.LOCPAIAMET            AS          auditoria_metodo,
        a.LOCPAIAEMP            AS          auditoria_empresa_codigo,
        a.LOCPAIAEMP            AS          auditoria_empresa_nombre,
        a.LOCPAIAUSU            AS          auditoria_usuario,
        a.LOCPAIAFEC            AS          auditoria_fecha_hora,
        a.LOCPAIADIP            AS          auditoria_ip,

        a.LOCPAIACODOLD         AS          auditoria_antes_pais_codigo,
        b.DOMFICCOD             AS          auditoria_antes_tipo_estado_codigo,
        b.DOMFICNOM             AS          auditoria_antes_tipo_estado_nombre,
        a.LOCPAIANOMOLD         AS          auditoria_antes_pais_nombre,
        a.LOCPAIAIC2OLD         AS          auditoria_antes_pais_iso3166_char2,
        a.LOCPAIAIC3OLD         AS          auditoria_antes_pais_iso3166_char3,
        a.LOCPAIAIN3OLD         AS          auditoria_antes_pais_iso3166_numero,
        a.LOCPAIAOBSOLD         AS          auditoria_antes_pais_observacion,

        a.LOCPAIACODNEW         AS          auditoria_despues_pais_codigo,
        c.DOMFICCOD             AS          auditoria_despues_tipo_estado_codigo,
        c.DOMFICNOM             AS          auditoria_despues_tipo_estado_nombre,
        a.LOCPAIANOMNEW         AS          auditoria_despues_pais_nombre,
        a.LOCPAIAIC2NEW         AS          auditoria_despues_pais_iso3166_char2,
        a.LOCPAIAIC3NEW         AS          auditoria_despues_pais_iso3166_char3,
        a.LOCPAIAIN3NEW         AS          auditoria_despues_pais_iso3166_numero,
        a.LOCPAIAOBSNEW         AS          auditoria_despues_pais_observacion
        
        FROM LOCPAIA a
        
        LEFT JOIN DOMFIC b ON a.LOCPAIAEPCOLD = b.DOMFICCOD
        LEFT JOIN DOMFIC c ON a.LOCPAIAEPCNEW = c.DOMFICCOD
        
        ORDER BY a.LOCPAIACOD DESC";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute();

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'auditoria_codigo'                              => $rowDEFAULT['auditoria_codigo'],
                    'auditoria_metodo'                              => $rowDEFAULT['auditoria_metodo'],
                    'auditoria_empresa_codigo'                      => $rowDEFAULT['auditoria_empresa_codigo'],
                    'auditoria_empresa_nombre'                      => $rowDEFAULT['auditoria_empresa_nombre'],
                    'auditoria_usuario'                             => $rowDEFAULT['auditoria_usuario'],
                    'auditoria_fecha_hora'                          => date_format(date_create($rowDEFAULT['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                    'auditoria_ip'                                  => $rowDEFAULT['auditoria_ip'],

                    'auditoria_antes_pais_codigo'                   => $rowDEFAULT['auditoria_antes_pais_codigo'],
                    'auditoria_antes_tipo_estado_codigo'            => $rowDEFAULT['auditoria_antes_tipo_estado_codigo'],
                    'auditoria_antes_tipo_estado_nombre'            => $rowDEFAULT['auditoria_antes_tipo_estado_nombre'],
                    'auditoria_antes_pais_nombre'                   => $rowDEFAULT['auditoria_antes_pais_nombre'],
                    'auditoria_antes_pais_iso3166_char2'            => $rowDEFAULT['auditoria_antes_pais_iso3166_char2'],
                    'auditoria_antes_pais_iso3166_char3'            => $rowDEFAULT['auditoria_antes_pais_iso3166_char3'],
                    'auditoria_antes_pais_iso3166_numero'           => $rowDEFAULT['auditoria_antes_pais_iso3166_numero'],
                    'auditoria_antes_pais_observacion'              => $rowDEFAULT['auditoria_antes_pais_observacion'],

                    'auditoria_despues_pais_codigo'                 => $rowDEFAULT['auditoria_despues_pais_codigo'],
                    'auditoria_despues_tipo_estado_codigo'          => $rowDEFAULT['auditoria_despues_tipo_estado_codigo'],
                    'auditoria_despues_tipo_estado_nombre'          => $rowDEFAULT['auditoria_despues_tipo_estado_nombre'],
                    'auditoria_despues_pais_nombre'                 => $rowDEFAULT['auditoria_despues_pais_nombre'],
                    'auditoria_despues_pais_iso3166_char2'          => $rowDEFAULT['auditoria_despues_pais_iso3166_char2'],
                    'auditoria_despues_pais_iso3166_char3'          => $rowDEFAULT['auditoria_despues_pais_iso3166_char3'],
                    'auditoria_despues_pais_iso3166_numero'         => $rowDEFAULT['auditoria_despues_pais_iso3166_numero'],
                    'auditoria_despues_pais_observacion'            => $rowDEFAULT['auditoria_despues_pais_observacion']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'auditoria_codigo'                              => '',
                    'auditoria_metodo'                              => '',
                    'auditoria_empresa_codigo'                      => '',
                    'auditoria_empresa_nombre'                      => '',
                    'auditoria_usuario'                             => '',
                    'auditoria_fecha_hora'                          => '',
                    'auditoria_ip'                                  => '',
                    'auditoria_antes_pais_codigo'                   => '',
                    'auditoria_antes_tipo_estado_codigo'            => '',
                    'auditoria_antes_tipo_estado_nombre'            => '',
                    'auditoria_antes_pais_nombre'                   => '',
                    'auditoria_antes_pais_iso3166_char2'            => '',
                    'auditoria_antes_pais_iso3166_char3'            => '',
                    'auditoria_antes_pais_iso3166_numero'           => '',
                    'auditoria_antes_pais_observacion'              => '',
                    'auditoria_despues_pais_codigo'                 => '',
                    'auditoria_despues_tipo_estado_codigo'          => '',
                    'auditoria_despues_tipo_estado_nombre'          => '',
                    'auditoria_despues_pais_nombre'                 => '',
                    'auditoria_despues_pais_iso3166_char2'          => '',
                    'auditoria_despues_pais_iso3166_char3'          => '',
                    'auditoria_despues_pais_iso3166_numero'         => '',
                    'auditoria_despues_pais_observacion'            => ''
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

    $app->get('/v1/default/200', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.LOCDEPCOD         AS          departamento_codigo,
        a.LOCDEPNOM         AS          departamento_nombre,
        a.LOCDEPOBS         AS          departamento_observacion,
        a.LOCDEPAEM         AS          departamento_empresa_codigo,
        a.LOCDEPAEM         AS          departamento_empresa_nombre,
        a.LOCDEPAUS         AS          departamento_usuario,
        a.LOCDEPAFH         AS          departamento_fecha_hora,
        a.LOCDEPAIP         AS          departamento_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.LOCPAICOD         AS          pais_codigo,
		c.LOCPAINOM         AS          pais_nombre
        
        FROM LOCDEP a
        INNER JOIN DOMFIC b ON a.LOCDEPEDC = b.DOMFICCOD
        INNER JOIN LOCPAI c ON a.LOCDEPPAC = c.LOCPAICOD

        ORDER BY c.LOCPAINOM, a.LOCDEPNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'departamento_codigo'                   => $rowDEFAULT['departamento_codigo'],
                    'departamento_nombre'                   => $rowDEFAULT['departamento_nombre'],
                    'departamento_observacion'              => $rowDEFAULT['departamento_observacion'],
                    'departamento_empresa_codigo'           => $rowDEFAULT['departamento_empresa_codigo'],
                    'departamento_empresa_nombre'           => $rowDEFAULT['departamento_empresa_nombre'],
                    'departamento_usuario'                  => $rowDEFAULT['departamento_usuario'],
                    'departamento_fecha_hora'               => date_format(date_create($rowDEFAULT['departamento_fecha_hora']), 'd/m/Y H:i:s'),
                    'departamento_ip'                       => $rowDEFAULT['departamento_ip'],
                    'tipo_estado_codigo'                    => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'                    => $rowDEFAULT['tipo_estado_nombre'],
                    'pais_codigo'                           => $rowDEFAULT['pais_codigo'],
                    'pais_nombre'                           => $rowDEFAULT['pais_nombre']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    
                    'departamento_codigo'                   => '',
                    'departamento_nombre'                   => '',
                    'departamento_observacion'              => '',
                    'departamento_empresa_codigo'           => '',
                    'departamento_empresa_nombre'           => '',
                    'departamento_usuario'                  => '',
                    'departamento_fecha_hora'               => '',
                    'departamento_ip'                       => '',
                    'pais_codigo'                           => '',
                    'tipo_estado_codigo'                    => '',
                    'tipo_estado_nombre'                    => '',
                    'pais_nombre'                           => ''
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

    $app->get('/v1/default/200/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.LOCDEPCOD         AS          departamento_codigo,
            a.LOCDEPNOM         AS          departamento_nombre,
            a.LOCDEPOBS         AS          departamento_observacion,
            a.LOCDEPAEM         AS          departamento_empresa_codigo,
            a.LOCDEPAEM         AS          departamento_empresa_nombre,
            a.LOCDEPAUS         AS          departamento_usuario,
            a.LOCDEPAFH         AS          departamento_fecha_hora,
            a.LOCDEPAIP         AS          departamento_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.LOCPAICOD         AS          pais_codigo,
            c.LOCPAINOM         AS          pais_nombre
            
            FROM LOCDEP a
            INNER JOIN DOMFIC b ON a.LOCDEPEDC = b.DOMFICCOD
            INNER JOIN LOCPAI c ON a.LOCDEPPAC = c.LOCPAICOD

            WHERE a.LOCDEPCOD = ?

            ORDER BY c.LOCPAINOM, a.LOCDEPNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'departamento_codigo'                   => $rowDEFAULT['departamento_codigo'],
                        'departamento_nombre'                   => $rowDEFAULT['departamento_nombre'],
                        'departamento_observacion'              => $rowDEFAULT['departamento_observacion'],
                        'departamento_empresa_codigo'           => $rowDEFAULT['departamento_empresa_codigo'],
                        'departamento_empresa_nombre'           => $rowDEFAULT['departamento_empresa_nombre'],
                        'departamento_usuario'                  => $rowDEFAULT['departamento_usuario'],
                        'departamento_fecha_hora'               => date_format(date_create($rowDEFAULT['departamento_fecha_hora']), 'd/m/Y H:i:s'),
                        'departamento_ip'                       => $rowDEFAULT['departamento_ip'],
                        'tipo_estado_codigo'                    => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                    => $rowDEFAULT['tipo_estado_nombre'],
                        'pais_codigo'                           => $rowDEFAULT['pais_codigo'],
                        'pais_nombre'                           => $rowDEFAULT['pais_nombre']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        
                        'departamento_codigo'                   => '',
                        'departamento_nombre'                   => '',
                        'departamento_observacion'              => '',
                        'departamento_empresa_codigo'           => '',
                        'departamento_empresa_nombre'           => '',
                        'departamento_usuario'                  => '',
                        'departamento_fecha_hora'               => '',
                        'departamento_ip'                       => '',
                        'pais_codigo'                           => '',
                        'tipo_estado_codigo'                    => '',
                        'tipo_estado_nombre'                    => '',
                        'pais_nombre'                           => ''
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

    $app->get('/v1/default/200/auditoria/', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.LOCDEPACOD            AS          auditoria_codigo,
        a.LOCDEPAMET            AS          auditoria_metodo,
        a.LOCDEPAEMP            AS          auditoria_empresa_codigo,
        a.LOCDEPAEMP            AS          auditoria_empresa_nombre,
        a.LOCDEPAUSU            AS          auditoria_usuario,
        a.LOCDEPAFEC            AS          auditoria_fecha_hora,
        a.LOCDEPADIP            AS          auditoria_ip,

        b1.DOMFICCOD            AS          auditoria_antes_tipo_estado_codigo,
        b1.DOMFICNOM            AS          auditoria_antes_tipo_estado_nombre,
        c1.LOCPAICOD            AS          auditoria_antes_pais_codigo,
        c1.LOCPAINOM            AS          auditoria_antes_pais_nombre,
        a.LOCDEPACODOLD         AS          auditoria_antes_departamento_codigo,
        a.LOCDEPANOMOLD         AS          auditoria_antes_departamento_nombre,
        a.LOCDEPAOBSOLD         AS          auditoria_antes_departamento_observacion,

        b2.DOMFICCOD            AS          auditoria_despues_tipo_estado_codigo,
        b2.DOMFICNOM            AS          auditoria_despues_tipo_estado_nombre,
        c2.LOCPAICOD            AS          auditoria_despues_pais_codigo,
        c2.LOCPAINOM            AS          auditoria_despues_pais_nombre,
        a.LOCDEPACODNEW         AS          auditoria_despues_departamento_codigo,
        a.LOCDEPANOMNEW         AS          auditoria_despues_departamento_nombre,
        a.LOCDEPAOBSNEW         AS          auditoria_despues_departamento_observacion
        
        FROM LOCDEPA a
        
        LEFT JOIN DOMFIC b1 ON a.LOCDEPAEDCOLD = b1.DOMFICCOD
        LEFT JOIN LOCPAI c1 ON a.LOCDEPAPACOLD = c1.LOCPAICOD
        LEFT JOIN DOMFIC b2 ON a.LOCDEPAEDCNEW = b2.DOMFICCOD
        LEFT JOIN LOCPAI c2 ON a.LOCDEPAPACNEW = c2.LOCPAICOD
        
        ORDER BY a.LOCDEPACOD DESC";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute();

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'auditoria_codigo'                                      => $rowDEFAULT['auditoria_codigo'],
                    'auditoria_metodo'                                      => $rowDEFAULT['auditoria_metodo'],
                    'auditoria_empresa_codigo'                              => $rowDEFAULT['auditoria_empresa_codigo'],
                    'auditoria_empresa_nombre'                              => $rowDEFAULT['auditoria_empresa_nombre'],
                    'auditoria_usuario'                                     => $rowDEFAULT['auditoria_usuario'],
                    'auditoria_fecha_hora'                                  => date_format(date_create($rowDEFAULT['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                    'auditoria_ip'                                          => $rowDEFAULT['auditoria_ip'],

                    'auditoria_antes_tipo_estado_codigo'                    => $rowDEFAULT['auditoria_antes_tipo_estado_codigo'],
                    'auditoria_antes_tipo_estado_nombre'                    => $rowDEFAULT['auditoria_antes_tipo_estado_nombre'],
                    'auditoria_antes_pais_codigo'                           => $rowDEFAULT['auditoria_antes_pais_codigo'],
                    'auditoria_antes_pais_nombre'                           => $rowDEFAULT['auditoria_antes_pais_nombre'],
                    'auditoria_antes_departamento_codigo'                   => $rowDEFAULT['auditoria_antes_departamento_codigo'],
                    'auditoria_antes_departamento_nombre'                   => $rowDEFAULT['auditoria_antes_departamento_nombre'],
                    'auditoria_antes_departamento_observacion'              => $rowDEFAULT['auditoria_antes_departamento_observacion'],

                    'auditoria_despues_tipo_estado_codigo'                  => $rowDEFAULT['auditoria_despues_tipo_estado_codigo'],
                    'auditoria_despues_tipo_estado_nombre'                  => $rowDEFAULT['auditoria_despues_tipo_estado_nombre'],
                    'auditoria_despues_pais_codigo'                         => $rowDEFAULT['auditoria_despues_pais_codigo'],
                    'auditoria_despues_pais_nombre'                         => $rowDEFAULT['auditoria_despues_pais_nombre'],
                    'auditoria_despues_departamento_codigo'                 => $rowDEFAULT['auditoria_despues_departamento_codigo'],
                    'auditoria_despues_departamento_nombre'                 => $rowDEFAULT['auditoria_despues_departamento_nombre'],
                    'auditoria_despues_departamento_observacion'            => $rowDEFAULT['auditoria_despues_departamento_observacion']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'auditoria_codigo'                                      => '',
                    'auditoria_metodo'                                      => '',
                    'auditoria_empresa_codigo'                              => '',
                    'auditoria_empresa_nombre'                              => '',
                    'auditoria_usuario'                                     => '',
                    'auditoria_fecha_hora'                                  => '',
                    'auditoria_ip'                                          => '',

                    'auditoria_antes_tipo_estado_codigo'                    => '',
                    'auditoria_antes_tipo_estado_nombre'                    => '',
                    'auditoria_antes_pais_codigo'                           => '',
                    'auditoria_antes_pais_nombre'                           => '',
                    'auditoria_antes_departamento_codigo'                   => '',
                    'auditoria_antes_departamento_nombre'                   => '',
                    'auditoria_antes_departamento_observacion'              => '',

                    'auditoria_despues_tipo_estado_codigo'                  => '',
                    'auditoria_despues_tipo_estado_nombre'                  => '',
                    'auditoria_despues_pais_codigo'                         => '',
                    'auditoria_despues_pais_nombre'                         => '',
                    'auditoria_despues_departamento_codigo'                 => '',
                    'auditoria_despues_departamento_nombre'                 => '',
                    'auditoria_despues_departamento_observacion'            => ''
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

    $app->get('/v1/default/300', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.LOCDISCOD         AS          distrito_codigo,
        a.LOCDISNOM         AS          distrito_nombre,
        a.LOCDISOBS         AS          distrito_observacion,
        a.LOCDISAEM         AS          distrito_empresa_codigo,
        a.LOCDISAEM         AS          distrito_empresa_nombre,
        a.LOCDISAUS         AS          distrito_usuario,
        a.LOCDISAFH         AS          distrito_fecha_hora,
        a.LOCDISAIP         AS          distrito_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.DOMFICCOD         AS          tipo_zona_codigo,
        c.DOMFICNOM         AS          tipo_zona_nombre,

        d.DOMFICCOD         AS          tipo_riesgo_codigo,
        d.DOMFICNOM         AS          tipo_riesgo_nombre,

        e.LOCDEPCOD         AS          departamento_codigo,
        e.LOCDEPNOM         AS          departamento_nombre,

        f.LOCPAICOD         AS          pais_codigo,
		f.LOCPAINOM         AS          pais_nombre
        
        FROM LOCDIS a
        INNER JOIN DOMFIC b ON a.LOCDISECC = b.DOMFICCOD
        INNER JOIN DOMFIC c ON a.LOCDISTZC = c.DOMFICCOD
        INNER JOIN DOMFIC d ON a.LOCDISTRC = d.DOMFICCOD
        INNER JOIN LOCDEP e ON a.LOCDISDEC = e.LOCDEPCOD
        INNER JOIN LOCPAI f ON e.LOCDEPPAC = f.LOCPAICOD

        ORDER BY f.LOCPAINOM, e.LOCDEPNOM, a.LOCDISNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'distrito_codigo'                   => $rowDEFAULT['distrito_codigo'],
                    'distrito_nombre'                   => $rowDEFAULT['distrito_nombre'],
                    'distrito_observacion'              => $rowDEFAULT['distrito_observacion'],
                    'distrito_empresa_codigo'           => $rowDEFAULT['distrito_empresa_codigo'],
                    'distrito_empresa_nombre'           => $rowDEFAULT['distrito_empresa_nombre'],
                    'distrito_usuario'                  => $rowDEFAULT['distrito_usuario'],
                    'distrito_fecha_hora'               => date_format(date_create($rowDEFAULT['distrito_fecha_hora']), 'd/m/Y H:i:s'),
                    'distrito_ip'                       => $rowDEFAULT['distrito_ip'],
                    'tipo_estado_codigo'                => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'                => $rowDEFAULT['tipo_estado_nombre'],
                    'tipo_zona_codigo'                  => $rowDEFAULT['tipo_zona_codigo'],
                    'tipo_zona_nombre'                  => $rowDEFAULT['tipo_zona_nombre'],
                    'tipo_riesgo_codigo'                => $rowDEFAULT['tipo_riesgo_codigo'],
                    'tipo_riesgo_nombre'                => $rowDEFAULT['tipo_riesgo_nombre'],
                    'departamento_codigo'               => $rowDEFAULT['departamento_codigo'],
                    'departamento_nombre'               => $rowDEFAULT['departamento_nombre'],
                    'pais_codigo'                       => $rowDEFAULT['pais_codigo'],
                    'pais_nombre'                       => $rowDEFAULT['pais_nombre']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'distrito_codigo'                   => '',
                    'distrito_nombre'                   => '',
                    'distrito_observacion'              => '',
                    'distrito_empresa_codigo'           => '',
                    'distrito_empresa_nombre'           => '',
                    'distrito_usuario'                  => '',
                    'distrito_fecha_hora'               => '',
                    'distrito_ip'                       => '',
                    'tipo_estado_codigo'                => '',
                    'tipo_estado_nombre'                => '',
                    'tipo_zona_codigo'                  => '',
                    'tipo_zona_nombre'                  => '',
                    'tipo_riesgo_codigo'                => '',
                    'tipo_riesgo_nombre'                => '',
                    'departamento_codigo'               => '',
                    'departamento_nombre'               => '',
                    'pais_codigo'                       => '',
                    'pais_nombre'                       => ''
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

    $app->get('/v1/default/300/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.LOCDISCOD         AS          distrito_codigo,
            a.LOCDISNOM         AS          distrito_nombre,
            a.LOCDISOBS         AS          distrito_observacion,
            a.LOCDISAEM         AS          distrito_empresa_codigo,
            a.LOCDISAEM         AS          distrito_empresa_nombre,
            a.LOCDISAUS         AS          distrito_usuario,
            a.LOCDISAFH         AS          distrito_fecha_hora,
            a.LOCDISAIP         AS          distrito_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_zona_codigo,
            c.DOMFICNOM         AS          tipo_zona_nombre,

            d.DOMFICCOD         AS          tipo_riesgo_codigo,
            d.DOMFICNOM         AS          tipo_riesgo_nombre,

            e.LOCDEPCOD         AS          departamento_codigo,
            e.LOCDEPNOM         AS          departamento_nombre,

            f.LOCPAICOD         AS          pais_codigo,
            f.LOCPAINOM         AS          pais_nombre
            
            FROM LOCDIS a
            INNER JOIN DOMFIC b ON a.LOCDISECC = b.DOMFICCOD
            INNER JOIN DOMFIC c ON a.LOCDISTZC = c.DOMFICCOD
            INNER JOIN DOMFIC d ON a.LOCDISTRC = d.DOMFICCOD
            INNER JOIN LOCDEP e ON a.LOCDISDEC = e.LOCDEPCOD
            INNER JOIN LOCPAI f ON e.LOCDEPPAC = f.LOCPAICOD

            ORDER BY f.LOCPAINOM, e.LOCDEPNOM, a.LOCDISNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute(); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'distrito_codigo'                   => $rowDEFAULT['distrito_codigo'],
                        'distrito_nombre'                   => $rowDEFAULT['distrito_nombre'],
                        'distrito_observacion'              => $rowDEFAULT['distrito_observacion'],
                        'distrito_empresa_codigo'           => $rowDEFAULT['distrito_empresa_codigo'],
                        'distrito_empresa_nombre'           => $rowDEFAULT['distrito_empresa_nombre'],
                        'distrito_usuario'                  => $rowDEFAULT['distrito_usuario'],
                        'distrito_fecha_hora'               => date_format(date_create($rowDEFAULT['distrito_fecha_hora']), 'd/m/Y H:i:s'),
                        'distrito_ip'                       => $rowDEFAULT['distrito_ip'],
                        'tipo_estado_codigo'                => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_zona_codigo'                  => $rowDEFAULT['tipo_zona_codigo'],
                        'tipo_zona_nombre'                  => $rowDEFAULT['tipo_zona_nombre'],
                        'tipo_riesgo_codigo'                => $rowDEFAULT['tipo_riesgo_codigo'],
                        'tipo_riesgo_nombre'                => $rowDEFAULT['tipo_riesgo_nombre'],
                        'departamento_codigo'               => $rowDEFAULT['departamento_codigo'],
                        'departamento_nombre'               => $rowDEFAULT['departamento_nombre'],
                        'pais_codigo'                       => $rowDEFAULT['pais_codigo'],
                        'pais_nombre'                       => $rowDEFAULT['pais_nombre']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'distrito_codigo'                   => '',
                        'distrito_nombre'                   => '',
                        'distrito_observacion'              => '',
                        'distrito_empresa_codigo'           => '',
                        'distrito_empresa_nombre'           => '',
                        'distrito_usuario'                  => '',
                        'distrito_fecha_hora'               => '',
                        'distrito_ip'                       => '',
                        'tipo_estado_codigo'                => '',
                        'tipo_estado_nombre'                => '',
                        'tipo_zona_codigo'                  => '',
                        'tipo_zona_nombre'                  => '',
                        'tipo_riesgo_codigo'                => '',
                        'tipo_riesgo_nombre'                => '',
                        'departamento_codigo'               => '',
                        'departamento_nombre'               => '',
                        'pais_codigo'                       => '',
                        'pais_nombre'                       => ''
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