<?php
    $app->get('/v1/senacsa/600/{codigo}', function($request) {
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
                $connSENACSA  = getConnectionSENACSA();
                $stmtSENACSA  = $connSENACSA->prepare($sql00);
                $stmtSENACSA->execute([$val01]); 

                while ($rowSENACSA = $stmtSENACSA->fetch()) {
                    $detalle    = array(
                        'establecimiento_codigo'                            => $rowSENACSA['establecimiento_codigo'],
                        'establecimiento_nombre'                            => $rowSENACSA['establecimiento_nombre'],
                        'categoria_codigo'                                  => $rowSENACSA['categoria_codigo'],
                        'categoria_nombre'                                  => $rowSENACSA['categoria_nombre'],
                        'estado_codigo'                                     => $rowSENACSA['estado_codigo'],
                        'estado_nombre'                                     => $rowSENACSA['estado_nombre'],
                        'establecimiento_categoria_cantidad'                => $rowSENACSA['establecimiento_categoria_cantidad'],
                        'establecimiento_categoria_peso_total'              => $rowSENACSA['establecimiento_categoria_peso_total'],
                        'establecimiento_categoria_peso_promedio'           => number_format(($rowSENACSA['establecimiento_categoria_cantidad'] / $rowSENACSA['establecimiento_categoria_peso_total']), 4, ',', '.'),
                        'establecimiento_categoria_observacion'             => $rowSENACSA['establecimiento_categoria_observacion'],
                        'auditoria_empresa_codigo'                          => $rowSENACSA['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                          => $rowSENACSA['auditoria_empresa_nombre'],
                        'auditoria_usuario'                                 => $rowSENACSA['auditoria_usuario'],
                        'auditoria_fecha_hora'                              => date_format(date_create($rowSENACSA['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                      => $rowSENACSA['auditoria_ip']
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

                $stmtSENACSA->closeCursor();
                $stmtSENACSA = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }

        $connSENACSA  = null;
        
        return $json;
    });