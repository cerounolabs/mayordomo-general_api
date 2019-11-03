<?php
    $app->get('/v1/establecimiento/600/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTCATCAN         AS          establecimiento_categoria_cantidad,
            a.ESTCATPES         AS          establecimiento_categoria_peso_total,
            a.ESTCATOBS         AS          establecimiento_categoria_observacion,
            a.ESTCATAEM         AS          auditoria_empresa_codigo,
            a.ESTCATAEM         AS          auditoria_empresa_nombre,
            a.ESTCATAUS         AS          auditoria_usuario,
            a.ESTCATAFH         AS          auditoria_fecha_hora,
            a.ESTCATAIP         AS          auditoria_ip,

            b.ESTFICCOD         AS          establecimiento_codigo,
            b.ESTFICNOM         AS          establecimiento_nombre,

            c.DOMFICCOD         AS          categoria_codigo,
            c.DOMFICNOM         AS          categoria_nombre,

            d.DOMFICCOD         AS          estado_codigo,
            d.DOMFICNOM         AS          estado_nombre
            
            FROM ESTCAT a
            INNER JOIN mayordomo_default.ESTFIC b ON a.ESTCATESC = b.ESTFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTCATTCC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTCATECC = d.DOMFICCOD

            WHERE a.ESTCATESC = ? 

            ORDER BY a.ESTCATESC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'establecimiento_codigo'                            => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                            => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'categoria_codigo'                                  => $rowESTABLECIMIENTO['categoria_codigo'],
                        'categoria_nombre'                                  => $rowESTABLECIMIENTO['categoria_nombre'],
                        'estado_codigo'                                     => $rowESTABLECIMIENTO['estado_codigo'],
                        'estado_nombre'                                     => $rowESTABLECIMIENTO['estado_nombre'],
                        'establecimiento_categoria_cantidad'                => $rowESTABLECIMIENTO['establecimiento_categoria_cantidad'],
                        'establecimiento_categoria_peso_total'              => $rowESTABLECIMIENTO['establecimiento_categoria_peso_total'],
                        'establecimiento_categoria_peso_promedio'           => number_format(($rowESTABLECIMIENTO['establecimiento_categoria_cantidad'] / $rowESTABLECIMIENTO['establecimiento_categoria_peso_total']), 4, ',', '.'),
                        'establecimiento_categoria_observacion'             => $rowESTABLECIMIENTO['establecimiento_categoria_observacion'],
                        'auditoria_empresa_codigo'                          => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                          => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                                 => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                              => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                      => $rowESTABLECIMIENTO['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_codigo'                            => '',
                        'establecimiento_nombre'                            => '',
                        'categoria_codigo'                                  => '',
                        'categoria_nombre'                                  => '',
                        'estado_codigo'                                     => '',
                        'estado_nombre'                                     => '',
                        'establecimiento_categoria_cantidad'                => '',
                        'establecimiento_categoria_peso_total'              => '',
                        'establecimiento_categoria_peso_promedio'           => '',
                        'establecimiento_categoria_observacion'             => '',
                        'auditoria_empresa_codigo'                          => '',
                        'auditoria_empresa_nombre'                          => '',
                        'auditoria_usuario'                                 => '',
                        'auditoria_fecha_hora'                              => '',
                        'auditoria_ip'                                      => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->get('/v1/establecimiento/601/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTPERCOD         AS          establecimiento_persona_codigo,
            a.ESTPERPER         AS          establecimiento_persona_completo,
            a.ESTPERDOC         AS          establecimiento_persona_documento,
            a.ESTPERCST         AS          establecimiento_persona_codigo_sitrap,
            a.ESTPERCSG         AS          establecimiento_persona_codigo_sigor,
            a.ESTPERTEL         AS          establecimiento_persona_telefono,
            a.ESTPERMAI         AS          establecimiento_persona_email,
            a.ESTPEROBS         AS          establecimiento_persona_observacion,
            a.ESTPERAEM         AS          auditoria_empresa_codigo,
            a.ESTPERAEM         AS          auditoria_empresa_nombre,
            a.ESTPERAUS         AS          auditoria_usuario,
            a.ESTPERAFH         AS          auditoria_fecha_hora,
            a.ESTPERAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          estado_codigo,
            b.DOMFICNOM         AS          estado_nombre,

            c.DOMFICCOD         AS          tipo_usuario_codigo,
            c.DOMFICNOM         AS          tipo_usuario_nombre,

            d.DOMFICCOD         AS          tipo_persona_codigo,
            d.DOMFICNOM         AS          tipo_persona_nombre,

            e.DOMFICCOD         AS          tipo_documento_codigo,
            e.DOMFICNOM         AS          tipo_documento_nombre,

            f.ESTFICCOD         AS          establecimiento_codigo,
            f.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTCAT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPERECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPERTUC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPERTPC = d.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC e ON a.ESTPERPDC = e.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC f ON a.ESTPERESC = b.ESTFICCOD

            WHERE a.ESTPERESC = ? 

            ORDER BY a.ESTPERCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'estado_codigo'                                 => $rowESTABLECIMIENTO['estado_codigo'],
                        'estado_nombre'                                 => $rowESTABLECIMIENTO['estado_nombre'],
                        'tipo_usuario_codigo'                           => $rowESTABLECIMIENTO['tipo_usuario_codigo'],
                        'tipo_usuario_nombre'                           => $rowESTABLECIMIENTO['tipo_usuario_nombre'],
                        'tipo_persona_codigo'                           => $rowESTABLECIMIENTO['tipo_persona_codigo'],
                        'tipo_persona_nombre'                           => $rowESTABLECIMIENTO['tipo_persona_nombre'],
                        'tipo_documento_codigo'                         => $rowESTABLECIMIENTO['tipo_documento_codigo'],
                        'tipo_documento_nombre'                         => $rowESTABLECIMIENTO['tipo_documento_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_persona_codigo'                => $rowESTABLECIMIENTO['establecimiento_persona_codigo'],
                        'establecimiento_persona_completo'              => $rowESTABLECIMIENTO['establecimiento_persona_completo'],
                        'establecimiento_persona_documento'             => $rowESTABLECIMIENTO['establecimiento_persona_documento'],
                        'establecimiento_persona_codigo_sitrap'         => $rowESTABLECIMIENTO['establecimiento_persona_codigo_sitrap'],
                        'establecimiento_persona_codigo_sigor'          => $rowESTABLECIMIENTO['establecimiento_persona_codigo_sigor'],
                        'establecimiento_persona_telefono'              => $rowESTABLECIMIENTO['establecimiento_persona_telefono'],
                        'establecimiento_persona_email'                 => $rowESTABLECIMIENTO['establecimiento_persona_email'],
                        'establecimiento_persona_observacion'           => $rowESTABLECIMIENTO['establecimiento_persona_observacion'],
                        'auditoria_empresa_codigo'                      => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowESTABLECIMIENTO['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'estado_codigo'                                 => '',
                        'estado_nombre'                                 => '',
                        'tipo_usuario_codigo'                           => '',
                        'tipo_usuario_nombre'                           => '',
                        'tipo_persona_codigo'                           => '',
                        'tipo_persona_nombre'                           => '',
                        'tipo_documento_codigo'                         => '',
                        'tipo_documento_nombre'                         => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_persona_codigo'                => '',
                        'establecimiento_persona_completo'              => '',
                        'establecimiento_persona_documento'             => '',
                        'establecimiento_persona_codigo_sitrap'         => '',
                        'establecimiento_persona_codigo_sigor'          => '',
                        'establecimiento_persona_telefono'              => '',
                        'establecimiento_persona_email'                 => '',
                        'establecimiento_persona_observacion'           => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });

    $app->get('/v1/establecimiento/601/{codigo}/{persona}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('persona');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTPERCOD         AS          establecimiento_persona_codigo,
            a.ESTPERPER         AS          establecimiento_persona_completo,
            a.ESTPERDOC         AS          establecimiento_persona_documento,
            a.ESTPERCST         AS          establecimiento_persona_codigo_sitrap,
            a.ESTPERCSG         AS          establecimiento_persona_codigo_sigor,
            a.ESTPERTEL         AS          establecimiento_persona_telefono,
            a.ESTPERMAI         AS          establecimiento_persona_email,
            a.ESTPEROBS         AS          establecimiento_persona_observacion,
            a.ESTPERAEM         AS          auditoria_empresa_codigo,
            a.ESTPERAEM         AS          auditoria_empresa_nombre,
            a.ESTPERAUS         AS          auditoria_usuario,
            a.ESTPERAFH         AS          auditoria_fecha_hora,
            a.ESTPERAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          estado_codigo,
            b.DOMFICNOM         AS          estado_nombre,

            c.DOMFICCOD         AS          tipo_usuario_codigo,
            c.DOMFICNOM         AS          tipo_usuario_nombre,

            d.DOMFICCOD         AS          tipo_persona_codigo,
            d.DOMFICNOM         AS          tipo_persona_nombre,

            e.DOMFICCOD         AS          tipo_documento_codigo,
            e.DOMFICNOM         AS          tipo_documento_nombre,

            f.ESTFICCOD         AS          establecimiento_codigo,
            f.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTCAT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPERECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPERTUC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPERTPC = d.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC e ON a.ESTPERPDC = e.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC f ON a.ESTPERESC = f.ESTFICCOD

            WHERE a.ESTPERESC = ? AND a.ESTPERCOD = ?

            ORDER BY a.ESTPERCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'estado_codigo'                                 => $rowESTABLECIMIENTO['estado_codigo'],
                        'estado_nombre'                                 => $rowESTABLECIMIENTO['estado_nombre'],
                        'tipo_usuario_codigo'                           => $rowESTABLECIMIENTO['tipo_usuario_codigo'],
                        'tipo_usuario_nombre'                           => $rowESTABLECIMIENTO['tipo_usuario_nombre'],
                        'tipo_persona_codigo'                           => $rowESTABLECIMIENTO['tipo_persona_codigo'],
                        'tipo_persona_nombre'                           => $rowESTABLECIMIENTO['tipo_persona_nombre'],
                        'tipo_documento_codigo'                         => $rowESTABLECIMIENTO['tipo_documento_codigo'],
                        'tipo_documento_nombre'                         => $rowESTABLECIMIENTO['tipo_documento_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_persona_codigo'                => $rowESTABLECIMIENTO['establecimiento_persona_codigo'],
                        'establecimiento_persona_completo'              => $rowESTABLECIMIENTO['establecimiento_persona_completo'],
                        'establecimiento_persona_documento'             => $rowESTABLECIMIENTO['establecimiento_persona_documento'],
                        'establecimiento_persona_codigo_sitrap'         => $rowESTABLECIMIENTO['establecimiento_persona_codigo_sitrap'],
                        'establecimiento_persona_codigo_sigor'          => $rowESTABLECIMIENTO['establecimiento_persona_codigo_sigor'],
                        'establecimiento_persona_telefono'              => $rowESTABLECIMIENTO['establecimiento_persona_telefono'],
                        'establecimiento_persona_email'                 => $rowESTABLECIMIENTO['establecimiento_persona_email'],
                        'establecimiento_persona_observacion'           => $rowESTABLECIMIENTO['establecimiento_persona_observacion'],
                        'auditoria_empresa_codigo'                      => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowESTABLECIMIENTO['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'estado_codigo'                                 => '',
                        'estado_nombre'                                 => '',
                        'tipo_usuario_codigo'                           => '',
                        'tipo_usuario_nombre'                           => '',
                        'tipo_persona_codigo'                           => '',
                        'tipo_persona_nombre'                           => '',
                        'tipo_documento_codigo'                         => '',
                        'tipo_documento_nombre'                         => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_persona_codigo'                => '',
                        'establecimiento_persona_completo'              => '',
                        'establecimiento_persona_documento'             => '',
                        'establecimiento_persona_codigo_sitrap'         => '',
                        'establecimiento_persona_codigo_sigor'          => '',
                        'establecimiento_persona_telefono'              => '',
                        'establecimiento_persona_email'                 => '',
                        'establecimiento_persona_observacion'           => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => ''
                    );

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtESTABLECIMIENTO->closeCursor();
                $stmtESTABLECIMIENTO = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connESTABLECIMIENTO  = null;
        
        return $json;
    });