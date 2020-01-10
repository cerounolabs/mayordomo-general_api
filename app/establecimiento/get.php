<?php
    $app->get('/v1/establecimiento/500', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.ESTFICCOD         AS          establecimiento_codigo,
        a.ESTFICNOM         AS          establecimiento_nombre,
        a.ESTFICTHE         AS          establecimiento_total_hectarea,
        a.ESTFICTPO         AS          establecimiento_total_potrero,
        a.ESTFICCO1         AS          establecimiento_codigo_senacsa,
        a.ESTFICCO2         AS          establecimiento_codigo_sigor,
        a.ESTFICCO3         AS          establecimiento_codigo_sitrap,
        a.ESTFICOBS         AS          establecimiento_observacion,
        a.ESTFICAEM         AS          establecimiento_empresa_codigo,
        a.ESTFICAEM         AS          establecimiento_empresa_nombre,
        a.ESTFICAUS         AS          establecimiento_usuario,
        a.ESTFICAFH         AS          establecimiento_fecha_hora,
        a.ESTFICAIP         AS          establecimiento_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.DOMFICCOD         AS          tipo_establecimiento_codigo,
        c.DOMFICNOM         AS          tipo_establecimiento_nombre,

        d.DOMFICCOD         AS          tipo_finalidad_codigo,
        d.DOMFICNOM         AS          tipo_finalidad_nombre,

        e.PERFICCOD         AS          persona_codigo,
        e.PERFICDOC         AS          persona_completo,
        e.PERFICDOC         AS          persona_documento,
        e.PERFICCST         AS          persona_codigo_senacsa,
        e.PERFICCSG         AS          persona_codigo_sigor,

        f.LOCDISCOD         AS          distrito_codigo,
        f.LOCDISNOM         AS          distrito_nombre
        
        FROM ESTFIC a
        INNER JOIN DOMFIC b ON a.ESTFICECC = b.DOMFICCOD
        INNER JOIN DOMFIC c ON a.ESTFICTEC = c.DOMFICCOD
        INNER JOIN DOMFIC d ON a.ESTFICTFC = d.DOMFICCOD
        INNER JOIN PERFIC e ON a.ESTFICPEC = e.PERFICCOD
        INNER JOIN LOCDIS f ON a.ESTFICDIC = f.LOCDISCOD

        ORDER BY a.ESTFICNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'establecimiento_codigo'                    => $rowDEFAULT['establecimiento_codigo'],
                    'establecimiento_nombre'                    => $rowDEFAULT['establecimiento_nombre'],
                    'establecimiento_total_hectarea'            => $rowDEFAULT['establecimiento_total_hectarea'],
                    'establecimiento_total_potrero'             => $rowDEFAULT['establecimiento_total_potrero'],
                    'establecimiento_codigo_senacsa'            => $rowDEFAULT['establecimiento_codigo_senacsa'],
                    'establecimiento_codigo_sigor'              => $rowDEFAULT['establecimiento_codigo_sigor'],
                    'establecimiento_codigo_sitrap'             => $rowDEFAULT['establecimiento_codigo_sitrap'],
                    'establecimiento_observacion'               => $rowDEFAULT['establecimiento_observacion'],
                    'establecimiento_empresa_codigo'            => $rowDEFAULT['establecimiento_empresa_codigo'],
                    'establecimiento_empresa_nombre'            => $rowDEFAULT['establecimiento_empresa_nombre'],
                    'establecimiento_usuario'                   => $rowDEFAULT['establecimiento_usuario'],
                    'establecimiento_fecha_hora'                => date_format(date_create($rowDEFAULT['establecimiento_fecha_hora']), 'd/m/Y H:i:s'),
                    'establecimiento_ip'                        => $rowDEFAULT['establecimiento_ip'],
                    'tipo_estado_codigo'                        => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'                        => $rowDEFAULT['tipo_estado_nombre'],
                    'tipo_establecimiento_codigo'               => $rowDEFAULT['tipo_establecimiento_codigo'],
                    'tipo_establecimiento_nombre'               => $rowDEFAULT['tipo_establecimiento_nombre'],
                    'tipo_documento_codigo'                     => $rowDEFAULT['tipo_documento_codigo'],
                    'tipo_documento_nombre'                     => $rowDEFAULT['tipo_documento_nombre'],
                    'tipo_finalidad_codigo'                     => $rowDEFAULT['tipo_finalidad_codigo'],
                    'tipo_finalidad_nombre'                     => $rowDEFAULT['tipo_finalidad_nombre'],
                    'persona_codigo'                            => $rowDEFAULT['persona_codigo'],
                    'persona_completo'                          => $rowDEFAULT['persona_completo'],
                    'persona_documento'                         => $rowDEFAULT['persona_documento'],
                    'persona_codigo_sitrap'                     => $rowDEFAULT['persona_codigo_sitrap'],
                    'persona_codigo_sigor'                      => $rowDEFAULT['persona_codigo_sigor'],
                    'distrito_codigo'                           => $rowDEFAULT['distrito_codigo'],
                    'distrito_nombre'                           => $rowDEFAULT['distrito_nombre']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'establecimiento_codigo'                    => '',
                    'establecimiento_nombre'                    => '',
                    'establecimiento_total_hectarea'            => '',
                    'establecimiento_total_potrero'             => '',
                    'establecimiento_codigo_senacsa'            => '',
                    'establecimiento_codigo_sigor'              => '',
                    'establecimiento_codigo_sitrap'             => '',
                    'establecimiento_observacion'               => '',
                    'establecimiento_empresa_codigo'            => '',
                    'establecimiento_empresa_nombre'            => '',
                    'establecimiento_usuario'                   => '',
                    'establecimiento_fecha_hora'                => '',
                    'establecimiento_ip'                        => '',
                    'tipo_estado_codigo'                        => '',
                    'tipo_estado_nombre'                        => '',
                    'tipo_establecimiento_codigo'               => '',
                    'tipo_establecimiento_nombre'               => '',
                    'tipo_documento_codigo'                     => '',
                    'tipo_documento_nombre'                     => '',
                    'tipo_finalidad_codigo'                     => '',
                    'tipo_finalidad_nombre'                     => '',
                    'persona_codigo'                            => '',
                    'persona_completo'                          => '',
                    'persona_documento'                         => '',
                    'persona_codigo_sitrap'                     => '',
                    'persona_codigo_sigor'                      => '',
                    'distrito_codigo'                           => '',
                    'distrito_nombre'                           => ''
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

    $app->get('/v1/establecimiento/500/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTFICCOD         AS          establecimiento_codigo,
            a.ESTFICNOM         AS          establecimiento_nombre,
            a.ESTFICTHE         AS          establecimiento_total_hectarea,
            a.ESTFICTPO         AS          establecimiento_total_potrero,
            a.ESTFICCO1         AS          establecimiento_codigo_senacsa,
            a.ESTFICCO2         AS          establecimiento_codigo_sigor,
            a.ESTFICCO3         AS          establecimiento_codigo_sitrap,
            a.ESTFICOBS         AS          establecimiento_observacion,
            a.ESTFICAEM         AS          establecimiento_empresa_codigo,
            a.ESTFICAEM         AS          establecimiento_empresa_nombre,
            a.ESTFICAUS         AS          establecimiento_usuario,
            a.ESTFICAFH         AS          establecimiento_fecha_hora,
            a.ESTFICAIP         AS          establecimiento_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_establecimiento_codigo,
            c.DOMFICNOM         AS          tipo_establecimiento_nombre,

            d.DOMFICCOD         AS          tipo_finalidad_codigo,
            d.DOMFICNOM         AS          tipo_finalidad_nombre,

            e.PERFICCOD         AS          persona_codigo,
            e.PERFICDOC         AS          persona_completo,
            e.PERFICDOC         AS          persona_documento,
            e.PERFICCST         AS          persona_codigo_senacsa,
            e.PERFICCSG         AS          persona_codigo_sigor,

            f.LOCDISCOD         AS          distrito_codigo,
            f.LOCDISNOM         AS          distrito_nombre
            
            FROM ESTFIC a
            INNER JOIN DOMFIC b ON a.ESTFICECC = b.DOMFICCOD
            INNER JOIN DOMFIC c ON a.ESTFICTEC = c.DOMFICCOD
            INNER JOIN DOMFIC d ON a.ESTFICTFC = d.DOMFICCOD
            INNER JOIN PERFIC e ON a.ESTFICPEC = e.PERFICCOD
            INNER JOIN LOCDIS f ON a.ESTFICDIC = f.LOCDISCOD

            WHERE a.ESTFICCOD = ?

            ORDER BY a.ESTFICNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'establecimiento_codigo'                    => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                    => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_total_hectarea'            => $rowDEFAULT['establecimiento_total_hectarea'],
                        'establecimiento_total_potrero'             => $rowDEFAULT['establecimiento_total_potrero'],
                        'establecimiento_codigo_senacsa'            => $rowDEFAULT['establecimiento_codigo_senacsa'],
                        'establecimiento_codigo_sigor'              => $rowDEFAULT['establecimiento_codigo_sigor'],
                        'establecimiento_codigo_sitrap'             => $rowDEFAULT['establecimiento_codigo_sitrap'],
                        'establecimiento_observacion'               => $rowDEFAULT['establecimiento_observacion'],
                        'establecimiento_empresa_codigo'            => $rowDEFAULT['establecimiento_empresa_codigo'],
                        'establecimiento_empresa_nombre'            => $rowDEFAULT['establecimiento_empresa_nombre'],
                        'establecimiento_usuario'                   => $rowDEFAULT['establecimiento_usuario'],
                        'establecimiento_fecha_hora'                => date_format(date_create($rowDEFAULT['establecimiento_fecha_hora']), 'd/m/Y H:i:s'),
                        'establecimiento_ip'                        => $rowDEFAULT['establecimiento_ip'],
                        'tipo_estado_codigo'                        => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                        => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_establecimiento_codigo'               => $rowDEFAULT['tipo_establecimiento_codigo'],
                        'tipo_establecimiento_nombre'               => $rowDEFAULT['tipo_establecimiento_nombre'],
                        'tipo_documento_codigo'                     => $rowDEFAULT['tipo_documento_codigo'],
                        'tipo_documento_nombre'                     => $rowDEFAULT['tipo_documento_nombre'],
                        'tipo_finalidad_codigo'                     => $rowDEFAULT['tipo_finalidad_codigo'],
                        'tipo_finalidad_nombre'                     => $rowDEFAULT['tipo_finalidad_nombre'],
                        'persona_codigo'                            => $rowDEFAULT['persona_codigo'],
                        'persona_completo'                          => $rowDEFAULT['persona_completo'],
                        'persona_documento'                         => $rowDEFAULT['persona_documento'],
                        'persona_codigo_sitrap'                     => $rowDEFAULT['persona_codigo_sitrap'],
                        'persona_codigo_sigor'                      => $rowDEFAULT['persona_codigo_sigor'],
                        'distrito_codigo'                           => $rowDEFAULT['distrito_codigo'],
                        'distrito_nombre'                           => $rowDEFAULT['distrito_nombre']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_codigo'                    => '',
                        'establecimiento_nombre'                    => '',
                        'establecimiento_total_hectarea'            => '',
                        'establecimiento_total_potrero'             => '',
                        'establecimiento_codigo_senacsa'            => '',
                        'establecimiento_codigo_sigor'              => '',
                        'establecimiento_codigo_sitrap'             => '',
                        'establecimiento_observacion'               => '',
                        'establecimiento_empresa_codigo'            => '',
                        'establecimiento_empresa_nombre'            => '',
                        'establecimiento_usuario'                   => '',
                        'establecimiento_fecha_hora'                => '',
                        'establecimiento_ip'                        => '',
                        'tipo_estado_codigo'                        => '',
                        'tipo_estado_nombre'                        => '',
                        'tipo_establecimiento_codigo'               => '',
                        'tipo_establecimiento_nombre'               => '',
                        'tipo_documento_codigo'                     => '',
                        'tipo_documento_nombre'                     => '',
                        'tipo_finalidad_codigo'                     => '',
                        'tipo_finalidad_nombre'                     => '',
                        'persona_codigo'                            => '',
                        'persona_completo'                          => '',
                        'persona_documento'                         => '',
                        'persona_codigo_sitrap'                     => '',
                        'persona_codigo_sigor'                      => '',
                        'distrito_codigo'                           => '',
                        'distrito_nombre'                           => ''
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

    $app->get('/v1/establecimiento/500/poblacion/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTPOBCOD         AS          establecimiento_poblacion_codigo,
            a.ESTPOBCAN         AS          establecimiento_poblacion_cantidad,
            a.ESTPOBPES         AS          establecimiento_poblacion_peso_promedio,
            a.ESTPOBOBS         AS          establecimiento_poblacion_observacion,

            a.ESTPOBAEM         AS          auditoria_empresa_codigo,
            a.ESTPOBAEM         AS          auditoria_empresa_nombre,
            a.ESTPOBAUS         AS          auditoria_usuario,
            a.ESTPOBAFH         AS          auditoria_fecha_hora,
            a.ESTPOBAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_origen_codigo,
            b.DOMFICNOM         AS          tipo_origen_nombre,

            c.DOMFICCOD         AS          tipo_raza_codigo,
            c.DOMFICNOM         AS          tipo_raza_nombre,

            d.DOMFICCOD         AS          tipo_subcategoria_codigo,
            d.DOMFICNOM         AS          tipo_subcategoria_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTPERCOD         AS          persona_codigo,
            f.ESTPERPER         AS          persona_completo,

            g.DOMFICCOD         AS          tipo_categoria_codigo,
            g.DOMFICNOM         AS          tipo_categoria_nombre
            
            FROM ESTPOB a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOBTOC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOBTRC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOBTSC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOBESC = e.ESTFICCOD
            INNER JOIN mayordomo_establecimiento.ESTPER f ON a.ESTPOBPEC = f.ESTPERCOD
            INNER JOIN mayordomo_default.DOMFIC g ON a.ESTPOBTCC = g.DOMFICCOD

            WHERE a.ESTPOBESC = ?

            ORDER BY a.ESTPOBESC, g.DOMFICCOD, d.DOMFICCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_origen_codigo'                            => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                            => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'tipo_raza_codigo'                              => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                              => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'tipo_categoria_codigo'                         => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                         => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'tipo_subcategoria_codigo'                      => $rowESTABLECIMIENTO['tipo_subcategoria_codigo'],
                        'tipo_subcategoria_nombre'                      => $rowESTABLECIMIENTO['tipo_subcategoria_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'persona_codigo'                                => $rowESTABLECIMIENTO['persona_codigo'],
                        'persona_completo'                              => $rowESTABLECIMIENTO['persona_completo'],
                        'establecimiento_poblacion_codigo'              => $rowESTABLECIMIENTO['establecimiento_poblacion_codigo'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad'],
                        'establecimiento_poblacion_peso_promedio'       => $rowESTABLECIMIENTO['establecimiento_poblacion_peso_promedio'],
                        'establecimiento_poblacion_observacion'         => $rowESTABLECIMIENTO['establecimiento_poblacion_observacion'],
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
                        'tipo_origen_codigo'                            => '',
                        'tipo_origen_nombre'                            => '',
                        'tipo_raza_codigo'                              => '',
                        'tipo_raza_nombre'                              => '',
                        'tipo_categoria_codigo'                         => '',
                        'tipo_categoria_nombre'                         => '',
                        'tipo_subcategoria_codigo'                      => '',
                        'tipo_subcategoria_nombre'                      => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'establecimiento_poblacion_codigo'              => '',
                        'establecimiento_poblacion_cantidad'            => '',
                        'establecimiento_poblacion_peso_promedio'       => '',
                        'establecimiento_poblacion_observacion'         => '',
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

    $app->get('/v1/establecimiento/500/poblacion/categoria/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            g.DOMFICCOD         AS          tipo_categoria_codigo,
            g.DOMFICNOM         AS          tipo_categoria_nombre,
            SUM(a.ESTPOBCAN)    AS          establecimiento_poblacion_cantidad,
            SUM(a.ESTPOBPES)    AS          establecimiento_poblacion_peso_promedio

            FROM ESTPOB a
            LEFT OUTER JOIN mayordomo_default.DOMFIC g ON a.ESTPOBTCC = g.DOMFICCOD

            WHERE a.ESTPOBESC = ?

            GROUP BY g.DOMFICCOD, g.DOMFICNOM
            ORDER BY g.DOMFICCOD, g.DOMFICNOM";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_categoria_codigo'                         => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                         => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad'],
                        'establecimiento_poblacion_peso_promedio'       => round(($rowESTABLECIMIENTO['establecimiento_poblacion_peso_promedio'] / $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad']), 3),
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_categoria_codigo'                         => '',
                        'tipo_categoria_nombre'                         => '',
                        'establecimiento_poblacion_cantidad'            => '',
                        'establecimiento_poblacion_peso_promedio'       => '',
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

    $app->get('/v1/establecimiento/500/persona/{establecimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTPERCOD         AS          establecimiento_persona_codigo,
            a.ESTPEROBS         AS          establecimiento_persona_observacion,
            a.ESTPERAEM         AS          auditoria_empresa_codigo,
            a.ESTPERAEM         AS          auditoria_empresa_nombre,
            a.ESTPERAUS         AS          auditoria_usuario,
            a.ESTPERAFH         AS          auditoria_fecha_hora,
            a.ESTPERAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre,

            d.DOMFICCOD         AS          tipo_usuario_codigo,
            d.DOMFICNOM         AS          tipo_usuario_nombre,

            e.PERFICCOD         AS          persona_codigo,
            e.PERFICNOM         AS          persona_completo,
            e.PERFICDOC         AS          persona_documento,
            e.PERFICCST         AS          persona_codigo_sitrap,
            e.PERFICCSG         AS          persona_codigo_sigor,
            e.PERFICTEL         AS          persona_telefono,
            e.PERFICMAI         AS          persona_email,
            e.PERFICOBS         AS          persona_observacion,

            e1.DOMFICCOD        AS          tipo_persona_codigo,
            e1.DOMFICNOM        AS          tipo_persona_nombre,

            e2.DOMFICCOD        AS          tipo_documento_codigo,
            e2.DOMFICNOM        AS          tipo_documento_nombre
            
            FROM ESTPER a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPERECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTPERESC = c.ESTFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPERTUC = d.DOMFICCOD
            INNER JOIN mayordomo_default.PERFIC e ON a.ESTPERPEC = e.PERFICCOD
            INNER JOIN mayordomo_default.DOMFIC e1 ON e.PERFICTPC = e1.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC e2 ON e.PERFICTDC = e2.DOMFICCOD

            WHERE a.ESTPERESC = ? 

            ORDER BY a.ESTPERTUC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'establecimiento_persona_codigo'                => $rowDEFAULT['establecimiento_persona_codigo'],
                        'establecimiento_persona_observacion'           => $rowDEFAULT['establecimiento_persona_observacion'],
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_usuario_codigo'                           => $rowDEFAULT['tipo_usuario_codigo'],
                        'tipo_usuario_nombre'                           => $rowDEFAULT['tipo_usuario_nombre'],
                        'tipo_persona_codigo'                           => $rowDEFAULT['tipo_persona_codigo'],
                        'tipo_persona_nombre'                           => $rowDEFAULT['tipo_persona_nombre'],
                        'tipo_documento_codigo'                         => $rowDEFAULT['tipo_documento_codigo'],
                        'tipo_documento_nombre'                         => $rowDEFAULT['tipo_documento_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'persona_codigo'                                => $rowDEFAULT['persona_codigo'],
                        'persona_completo'                              => $rowDEFAULT['persona_completo'],
                        'persona_documento'                             => $rowDEFAULT['persona_documento'],
                        'persona_codigo_sitrap'                         => $rowDEFAULT['persona_codigo_sitrap'],
                        'persona_codigo_sigor'                          => $rowDEFAULT['persona_codigo_sigor'],
                        'persona_telefono'                              => $rowDEFAULT['persona_telefono'],
                        'persona_email'                                 => $rowDEFAULT['persona_email'],
                        'persona_observacion'                           => $rowDEFAULT['persona_observacion'],
                        'auditoria_empresa_codigo'                      => $rowDEFAULT['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowDEFAULT['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowDEFAULT['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowDEFAULT['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowDEFAULT['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_persona_codigo'                => '',
                        'establecimiento_persona_observacion'           => '',
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'tipo_usuario_codigo'                           => '',
                        'tipo_usuario_nombre'                           => '',
                        'tipo_persona_codigo'                           => '',
                        'tipo_persona_nombre'                           => '',
                        'tipo_documento_codigo'                         => '',
                        'tipo_documento_nombre'                         => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'persona_documento'                             => '',
                        'persona_codigo_sitrap'                         => '',
                        'persona_codigo_sigor'                          => '',
                        'persona_telefono'                              => '',
                        'persona_email'                                 => '',
                        'persona_observacion'                           => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => ''
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

    $app->get('/v1/establecimiento/500/persona/{establecimiento}/{persona}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('establecimiento');
        $val02      = $request->getAttribute('persona');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTPERCOD         AS          establecimiento_persona_codigo,
            a.ESTPEROBS         AS          establecimiento_persona_observacion,
            a.ESTPERAEM         AS          auditoria_empresa_codigo,
            a.ESTPERAEM         AS          auditoria_empresa_nombre,
            a.ESTPERAUS         AS          auditoria_usuario,
            a.ESTPERAFH         AS          auditoria_fecha_hora,
            a.ESTPERAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre,

            d.DOMFICCOD         AS          tipo_usuario_codigo,
            d.DOMFICNOM         AS          tipo_usuario_nombre,

            e.PERFICCOD         AS          persona_codigo,
            e.PERFICNOM         AS          persona_completo,
            e.PERFICDOC         AS          persona_documento,
            e.PERFICCST         AS          persona_codigo_sitrap,
            e.PERFICCSG         AS          persona_codigo_sigor,
            e.PERFICTEL         AS          persona_telefono,
            e.PERFICMAI         AS          persona_email,
            e.PERFICOBS         AS          persona_observacion,

            e1.DOMFICCOD        AS          tipo_persona_codigo,
            e1.DOMFICNOM        AS          tipo_persona_nombre,

            e2.DOMFICCOD        AS          tipo_documento_codigo,
            e2.DOMFICNOM        AS          tipo_documento_nombre
            
            FROM ESTPER a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPERECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTPERESC = c.ESTFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPERTUC = d.DOMFICCOD
            INNER JOIN mayordomo_default.PERFIC e ON a.ESTPERPEC = e.PERFICCOD
            INNER JOIN mayordomo_default.DOMFIC e1 ON e.PERFICTPC = e1.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC e2 ON e.PERFICTDC = e2.DOMFICCOD

            WHERE a.ESTPERESC = ? AND a.ESTPERPEC = ?

            ORDER BY a.ESTPERTUC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'establecimiento_persona_codigo'                => $rowDEFAULT['establecimiento_persona_codigo'],
                        'establecimiento_persona_observacion'           => $rowDEFAULT['establecimiento_persona_observacion'],
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_usuario_codigo'                           => $rowDEFAULT['tipo_usuario_codigo'],
                        'tipo_usuario_nombre'                           => $rowDEFAULT['tipo_usuario_nombre'],
                        'tipo_persona_codigo'                           => $rowDEFAULT['tipo_persona_codigo'],
                        'tipo_persona_nombre'                           => $rowDEFAULT['tipo_persona_nombre'],
                        'tipo_documento_codigo'                         => $rowDEFAULT['tipo_documento_codigo'],
                        'tipo_documento_nombre'                         => $rowDEFAULT['tipo_documento_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'persona_codigo'                                => $rowDEFAULT['persona_codigo'],
                        'persona_completo'                              => $rowDEFAULT['persona_completo'],
                        'persona_documento'                             => $rowDEFAULT['persona_documento'],
                        'persona_codigo_sitrap'                         => $rowDEFAULT['persona_codigo_sitrap'],
                        'persona_codigo_sigor'                          => $rowDEFAULT['persona_codigo_sigor'],
                        'persona_telefono'                              => $rowDEFAULT['persona_telefono'],
                        'persona_email'                                 => $rowDEFAULT['persona_email'],
                        'persona_observacion'                           => $rowDEFAULT['persona_observacion'],
                        'auditoria_empresa_codigo'                      => $rowDEFAULT['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowDEFAULT['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowDEFAULT['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowDEFAULT['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowDEFAULT['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_persona_codigo'                => '',
                        'establecimiento_persona_observacion'           => '',
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'tipo_usuario_codigo'                           => '',
                        'tipo_usuario_nombre'                           => '',
                        'tipo_persona_codigo'                           => '',
                        'tipo_persona_nombre'                           => '',
                        'tipo_documento_codigo'                         => '',
                        'tipo_documento_nombre'                         => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'persona_documento'                             => '',
                        'persona_codigo_sitrap'                         => '',
                        'persona_codigo_sigor'                          => '',
                        'persona_telefono'                              => '',
                        'persona_email'                                 => '',
                        'persona_observacion'                           => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => ''
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

        $connDEFAULT = null;
        
        return $json;
    });
    //------------------------------------------------------------------//
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

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_usuario_codigo,
            c.DOMFICNOM         AS          tipo_usuario_nombre,

            d.DOMFICCOD         AS          tipo_persona_codigo,
            d.DOMFICNOM         AS          tipo_persona_nombre,

            e.DOMFICCOD         AS          tipo_documento_codigo,
            e.DOMFICNOM         AS          tipo_documento_nombre,

            f.ESTFICCOD         AS          establecimiento_codigo,
            f.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTPER a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPERECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPERTUC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPERTPC = d.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC e ON a.ESTPERPDC = e.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC f ON a.ESTPERESC = f.ESTFICCOD

            WHERE a.ESTPERESC = ? 

            ORDER BY a.ESTPERCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowESTABLECIMIENTO['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowESTABLECIMIENTO['tipo_estado_nombre'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
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

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_usuario_codigo,
            c.DOMFICNOM         AS          tipo_usuario_nombre,

            d.DOMFICCOD         AS          tipo_persona_codigo,
            d.DOMFICNOM         AS          tipo_persona_nombre,

            e.DOMFICCOD         AS          tipo_documento_codigo,
            e.DOMFICNOM         AS          tipo_documento_nombre,

            f.ESTFICCOD         AS          establecimiento_codigo,
            f.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTPER a
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
                        'tipo_estado_codigo'                            => $rowESTABLECIMIENTO['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowESTABLECIMIENTO['tipo_estado_nombre'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
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

    $app->get('/v1/establecimiento/604/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTLOTCOD         AS          establecimiento_lote_codigo,
            a.ESTLOTNOM         AS          establecimiento_lote_nombre,
            a.ESTLOTOBS         AS          establecimiento_lote_observacion,
            a.ESTLOTAEM         AS          auditoria_empresa_codigo,
            a.ESTLOTAEM         AS          auditoria_empresa_nombre,
            a.ESTLOTAUS         AS          auditoria_usuario,
            a.ESTLOTAFH         AS          auditoria_fecha_hora,
            a.ESTLOTAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTLOT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTLOTECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTLOTESC = c.ESTFICCOD

            WHERE a.ESTLOTESC = ? 

            ORDER BY a.ESTLOTCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowESTABLECIMIENTO['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowESTABLECIMIENTO['tipo_estado_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_lote_codigo'                   => $rowESTABLECIMIENTO['establecimiento_lote_codigo'],
                        'establecimiento_lote_nombre'                   => $rowESTABLECIMIENTO['establecimiento_lote_nombre'],
                        'establecimiento_lote_observacion'              => $rowESTABLECIMIENTO['establecimiento_lote_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_lote_codigo'                   => '',
                        'establecimiento_lote_nombre'                   => '',
                        'establecimiento_lote_observacion'              => '',
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

    $app->get('/v1/establecimiento/604/{codigo}/{lote}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('lote');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTLOTCOD         AS          establecimiento_lote_codigo,
            a.ESTLOTNOM         AS          establecimiento_lote_nombre,
            a.ESTLOTOBS         AS          establecimiento_lote_observacion,
            a.ESTLOTAEM         AS          auditoria_empresa_codigo,
            a.ESTLOTAEM         AS          auditoria_empresa_nombre,
            a.ESTLOTAUS         AS          auditoria_usuario,
            a.ESTLOTAFH         AS          auditoria_fecha_hora,
            a.ESTLOTAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTLOT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTLOTECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTLOTESC = c.ESTFICCOD

            WHERE a.ESTLOTESC = ? AND a.ESTLOTCOD = ?

            ORDER BY a.ESTLOTCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowESTABLECIMIENTO['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowESTABLECIMIENTO['tipo_estado_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_lote_codigo'                   => $rowESTABLECIMIENTO['establecimiento_lote_codigo'],
                        'establecimiento_lote_nombre'                   => $rowESTABLECIMIENTO['establecimiento_lote_nombre'],
                        'establecimiento_lote_observacion'              => $rowESTABLECIMIENTO['establecimiento_lote_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_lote_codigo'                   => '',
                        'establecimiento_lote_nombre'                   => '',
                        'establecimiento_lote_observacion'              => '',
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

    $app->get('/v1/establecimiento/605/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTPOBCOD         AS          establecimiento_poblacion_codigo,
            a.ESTPOBCAN         AS          establecimiento_poblacion_cantidad,
            a.ESTPOBPES         AS          establecimiento_poblacion_peso_promedio,
            a.ESTPOBOBS         AS          establecimiento_poblacion_observacion,

            a.ESTPOBAEM         AS          auditoria_empresa_codigo,
            a.ESTPOBAEM         AS          auditoria_empresa_nombre,
            a.ESTPOBAUS         AS          auditoria_usuario,
            a.ESTPOBAFH         AS          auditoria_fecha_hora,
            a.ESTPOBAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_origen_codigo,
            b.DOMFICNOM         AS          tipo_origen_nombre,

            c.DOMFICCOD         AS          tipo_raza_codigo,
            c.DOMFICNOM         AS          tipo_raza_nombre,

            d.DOMFICCOD         AS          tipo_subcategoria_codigo,
            d.DOMFICNOM         AS          tipo_subcategoria_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTPERCOD         AS          persona_codigo,
            f.ESTPERPER         AS          persona_completo,

            g.DOMFICCOD         AS          tipo_categoria_codigo,
            g.DOMFICNOM         AS          tipo_categoria_nombre
            
            FROM ESTPOB a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOBTOC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOBTRC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOBTSC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOBESC = e.ESTFICCOD
            INNER JOIN mayordomo_establecimiento.ESTPER f ON a.ESTPOBPEC = f.ESTPERCOD
            INNER JOIN mayordomo_default.DOMFIC g ON a.ESTPOBTCC = g.DOMFICCOD

            WHERE a.ESTPOBESC = ?

            ORDER BY a.ESTPOBESC, g.DOMFICCOD, d.DOMFICCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_origen_codigo'                            => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                            => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'tipo_raza_codigo'                              => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                              => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'tipo_categoria_codigo'                         => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                         => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'tipo_subcategoria_codigo'                      => $rowESTABLECIMIENTO['tipo_subcategoria_codigo'],
                        'tipo_subcategoria_nombre'                      => $rowESTABLECIMIENTO['tipo_subcategoria_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'persona_codigo'                                => $rowESTABLECIMIENTO['persona_codigo'],
                        'persona_completo'                              => $rowESTABLECIMIENTO['persona_completo'],
                        'establecimiento_poblacion_codigo'              => $rowESTABLECIMIENTO['establecimiento_poblacion_codigo'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad'],
                        'establecimiento_poblacion_peso_promedio'       => $rowESTABLECIMIENTO['establecimiento_poblacion_peso_promedio'],
                        'establecimiento_poblacion_observacion'         => $rowESTABLECIMIENTO['establecimiento_poblacion_observacion'],
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
                        'tipo_origen_codigo'                            => '',
                        'tipo_origen_nombre'                            => '',
                        'tipo_raza_codigo'                              => '',
                        'tipo_raza_nombre'                              => '',
                        'tipo_categoria_codigo'                         => '',
                        'tipo_categoria_nombre'                         => '',
                        'tipo_subcategoria_codigo'                      => '',
                        'tipo_subcategoria_nombre'                      => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'establecimiento_poblacion_codigo'              => '',
                        'establecimiento_poblacion_cantidad'            => '',
                        'establecimiento_poblacion_peso_promedio'       => '',
                        'establecimiento_poblacion_observacion'         => '',
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

    $app->get('/v1/establecimiento/605/{codigo}/{poblacion}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('poblacion');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTPOBCOD         AS          establecimiento_poblacion_codigo,
            a.ESTPOBCAN         AS          establecimiento_poblacion_cantidad,
            a.ESTPOBPES         AS          establecimiento_poblacion_peso_promedio,
            a.ESTPOBOBS         AS          establecimiento_poblacion_observacion,

            a.ESTPOBAEM         AS          auditoria_empresa_codigo,
            a.ESTPOBAEM         AS          auditoria_empresa_nombre,
            a.ESTPOBAUS         AS          auditoria_usuario,
            a.ESTPOBAFH         AS          auditoria_fecha_hora,
            a.ESTPOBAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_origen_codigo,
            b.DOMFICNOM         AS          tipo_origen_nombre,

            c.DOMFICCOD         AS          tipo_raza_codigo,
            c.DOMFICNOM         AS          tipo_raza_nombre,

            d.DOMFICCOD         AS          tipo_subcategoria_codigo,
            d.DOMFICNOM         AS          tipo_subcategoria_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTPERCOD         AS          persona_codigo,
            f.ESTPERPER         AS          persona_completo,

            g.DOMFICCOD         AS          tipo_categoria_codigo,
            g.DOMFICNOM         AS          tipo_categoria_nombre
            
            FROM ESTPOB a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOBTOC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOBTRC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOBTSC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOBESC = e.ESTFICCOD
            INNER JOIN mayordomo_establecimiento.ESTPER f ON a.ESTPOBPEC = f.ESTPERCOD
            INNER JOIN mayordomo_default.DOMFIC g ON a.ESTPOBTCC = h.DOMFICCOD

            WHERE a.ESTPOBESC = ? AND a.ESTPOBCOD = ?

            ORDER BY a.ESTPOBESC, g.DOMFICCOD, d.DOMFICCOD";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'tipo_origen_codigo'                            => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                            => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'tipo_raza_codigo'                              => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                              => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'tipo_categoria_codigo'                         => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                         => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'tipo_subcategoria_codigo'                      => $rowESTABLECIMIENTO['tipo_subcategoria_codigo'],
                        'tipo_subcategoria_nombre'                      => $rowESTABLECIMIENTO['tipo_subcategoria_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'persona_codigo'                                => $rowESTABLECIMIENTO['persona_codigo'],
                        'persona_completo'                              => $rowESTABLECIMIENTO['persona_completo'],
                        'establecimiento_poblacion_codigo'              => $rowESTABLECIMIENTO['establecimiento_poblacion_codigo'],
                        'establecimiento_poblacion_cantidad'            => $rowESTABLECIMIENTO['establecimiento_poblacion_cantidad'],
                        'establecimiento_poblacion_peso_promedio'       => $rowESTABLECIMIENTO['establecimiento_poblacion_peso_promedio'],
                        'establecimiento_poblacion_observacion'         => $rowESTABLECIMIENTO['establecimiento_poblacion_observacion'],
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
                        'tipo_origen_codigo'                            => '',
                        'tipo_origen_nombre'                            => '',
                        'tipo_raza_codigo'                              => '',
                        'tipo_raza_nombre'                              => '',
                        'tipo_categoria_codigo'                         => '',
                        'tipo_categoria_nombre'                         => '',
                        'tipo_subcategoria_codigo'                      => '',
                        'tipo_subcategoria_nombre'                      => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'persona_codigo'                                => '',
                        'persona_completo'                              => '',
                        'establecimiento_poblacion_codigo'              => '',
                        'establecimiento_poblacion_cantidad'            => '',
                        'establecimiento_poblacion_peso_promedio'       => '',
                        'establecimiento_poblacion_observacion'         => '',
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

    $app->get('/v1/establecimiento/606/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTUBCCOD         AS          establecimiento_ubicacion_codigo,
            a.ESTUBCNOM         AS          establecimiento_ubicacion_nombre,
            a.ESTUBCOBS         AS          establecimiento_ubicacion_observacion,

            a.ESTUBCAEM         AS          auditoria_empresa_codigo,
            a.ESTUBCAEM         AS          auditoria_empresa_nombre,
            a.ESTUBCAUS         AS          auditoria_usuario,
            a.ESTUBCAFH         AS          auditoria_fecha_hora,
            a.ESTUBCAIP         AS          auditoria_ip,

            b.ESTPOTCOD         AS          establecimiento_potrero_codigo,
            b.ESTPOTNOM         AS          establecimiento_potrero_nombre,

            c.ESTLOTCOD         AS          establecimiento_lote_codigo,
            c.ESTLOTNOM         AS          establecimiento_lote_nombre,

            d.ESTFICCOD         AS          establecimiento_codigo,
            d.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTUBC a
            INNER JOIN mayordomo_default.ESTPOT b ON a.ESTUBCPOC = b.ESTPOTCOD
            INNER JOIN mayordomo_establecimiento.ESTLOT c ON a.ESTUBCLOT = c.ESTLOTCOD
            INNER JOIN mayordomo_default.ESTFIC d ON a.ESTUBCESC = d.ESTFICCOD

            WHERE a.ESTUBCESC = ?

            ORDER BY a.ESTUBCESC, b.ESTPOTNOM, c.ESTLOTNOM";

            $sql01  = "SELECT
            a.ESTUBDCOD         AS          establecimiento_ubicacion_detalle_codigo,
            a.ESTUBDCAN         AS          establecimiento_ubicacion_detalle_cantidad,
            a.ESTUBDOBS         AS          establecimiento_ubicacion_detalle_observacion,

            a.ESTUBDAEM         AS          auditoria_empresa_codigo,
            a.ESTUBDAEM         AS          auditoria_empresa_nombre,
            a.ESTUBDAUS         AS          auditoria_usuario,
            a.ESTUBDAFH         AS          auditoria_fecha_hora,
            a.ESTUBDAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_categoria_codigo,
            c.DOMFICNOM         AS          tipo_categoria_nombre,

            d.DOMFICCOD         AS          tipo_subcategoria_codigo,
            d.DOMFICNOM         AS          tipo_subcategoria_nombre,

            e.ESTUBCCOD         AS          establecimiento_ubicacion_codigo,
            e.ESTUBCNOM         AS          establecimiento_ubicacion_nombre

            FROM ESTUBD a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTUBDECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTUBDTCC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTUBDTSC = d.DOMFICCOD
            INNER JOIN mayordomo_establecimiento.ESTUBC e ON a.ESTUBDUBC = e.ESTUBCCOD

            WHERE a.ESTUBDUBC = ?

            ORDER BY c.DOMFICNOM, d.DOMFICNOM";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                    $stmtESTABLECIMIENTO01->execute([$rowESTABLECIMIENTO['establecimiento_ubicacion_codigo']]);

                    $cantUbicado = 0;

                    while ($rowESTABLECIMIENTO01 = $stmtESTABLECIMIENTO01->fetch()) {
                        $cantUbicado = $cantUbicado + $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_cantidad'];
                        $detalle        = array(
                            'establecimiento_ubicacion_detalle_codigo'              => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_codigo'],
                            'establecimiento_ubicacion_detalle_cantidad'            => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_cantidad'],
                            'establecimiento_ubicacion_detalle_observacion'         => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_observacion'],
                            'establecimiento_ubicacion_codigo'                      => $rowESTABLECIMIENTO01['establecimiento_ubicacion_codigo'],
                            'establecimiento_ubicacion_nombre'                      => $rowESTABLECIMIENTO01['establecimiento_ubicacion_nombre'],
                            'tipo_estado_codigo'                                    => $rowESTABLECIMIENTO01['tipo_estado_codigo'],
                            'tipo_estado_nombre'                                    => $rowESTABLECIMIENTO01['tipo_estado_nombre'],
                            'tipo_categoria_codigo'                                 => $rowESTABLECIMIENTO01['tipo_categoria_codigo'],
                            'tipo_categoria_nombre'                                 => $rowESTABLECIMIENTO01['tipo_categoria_nombre'],
                            'tipo_subcategoria_codigo'                              => $rowESTABLECIMIENTO01['tipo_subcategoria_codigo'],
                            'tipo_subcategoria_nombre'                              => $rowESTABLECIMIENTO01['tipo_subcategoria_nombre'],
                            'auditoria_empresa_codigo'                              => $rowESTABLECIMIENTO01['auditoria_empresa_codigo'],
                            'auditoria_empresa_nombre'                              => $rowESTABLECIMIENTO01['auditoria_empresa_nombre'],
                            'auditoria_usuario'                                     => $rowESTABLECIMIENTO01['auditoria_usuario'],
                            'auditoria_fecha_hora'                                  => date_format(date_create($rowESTABLECIMIENTO01['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                            'auditoria_ip'                                          => $rowESTABLECIMIENTO01['auditoria_ip']
                        );    
                        $result_detalle[]   = $detalle;
                    }

                    if (!isset($result_detalle)){
                        $result_detalle = array(
                            'establecimiento_ubicacion_detalle_codigo'              => '',
                            'establecimiento_ubicacion_detalle_cantidad'            => '',
                            'establecimiento_ubicacion_detalle_observacion'         => '',
                            'establecimiento_ubicacion_codigo'                      => '',
                            'establecimiento_ubicacion_nombre'                      => '',
                            'tipo_estado_codigo'                                    => '',
                            'tipo_estado_nombre'                                    => '',
                            'tipo_categoria_codigo'                                 => '',
                            'tipo_categoria_nombre'                                 => '',
                            'tipo_subcategoria_codigo'                              => '',
                            'tipo_subcategoria_nombre'                              => '',
                            'auditoria_empresa_codigo'                              => '',
                            'auditoria_empresa_nombre'                              => '',
                            'auditoria_usuario'                                     => '',
                            'auditoria_fecha_hora'                                  => '',
                            'auditoria_ip'                                          => ''
                        );
                    }

                    $detalle    = array(
                        'establecimiento_ubicacion_codigo'              => $rowESTABLECIMIENTO['establecimiento_ubicacion_codigo'],
                        'establecimiento_ubicacion_nombre'              => $rowESTABLECIMIENTO['establecimiento_ubicacion_nombre'],
                        'establecimiento_ubicacion_cantidad'            => $cantUbicado,
                        'establecimiento_ubicacion_observacion'         => $rowESTABLECIMIENTO['establecimiento_ubicacion_observacion'],
                        'establecimiento_potrero_codigo'                => $rowESTABLECIMIENTO['establecimiento_potrero_codigo'],
                        'establecimiento_potrero_nombre'                => $rowESTABLECIMIENTO['establecimiento_potrero_nombre'],
                        'establecimiento_lote_codigo'                   => $rowESTABLECIMIENTO['establecimiento_lote_codigo'],
                        'establecimiento_lote_nombre'                   => $rowESTABLECIMIENTO['establecimiento_lote_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'auditoria_empresa_codigo'                      => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowESTABLECIMIENTO['auditoria_ip'],
                        'detalle'                                       => $result_detalle
                    );
                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_ubicacion_codigo'              => '',
                        'establecimiento_ubicacion_nombre'              => '',
                        'establecimiento_ubicacion_cantidad'            => '',
                        'establecimiento_ubicacion_observacion'         => '',
                        'establecimiento_potrero_codigo'                => '',
                        'establecimiento_potrero_nombre'                => '',
                        'establecimiento_lote_codigo'                   => '',
                        'establecimiento_lote_nombre'                   => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => '',
                        'detalle'                                       => ''
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

    $app->get('/v1/establecimiento/606/{codigo}/{ubicacion}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val01      = $request->getAttribute('ubicacion');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTUBCCOD         AS          establecimiento_ubicacion_codigo,
            a.ESTUBCNOM         AS          establecimiento_ubicacion_nombre,
            a.ESTUBCOBS         AS          establecimiento_ubicacion_observacion,

            a.ESTUBCAEM         AS          auditoria_empresa_codigo,
            a.ESTUBCAEM         AS          auditoria_empresa_nombre,
            a.ESTUBCAUS         AS          auditoria_usuario,
            a.ESTUBCAFH         AS          auditoria_fecha_hora,
            a.ESTUBCAIP         AS          auditoria_ip,

            b.ESTPOTCOD         AS          establecimiento_potrero_codigo,
            b.ESTPOTNOM         AS          establecimiento_potrero_nombre,

            c.ESTLOTCOD         AS          establecimiento_lote_codigo,
            c.ESTLOTNOM         AS          establecimiento_lote_nombre,

            d.ESTFICCOD         AS          establecimiento_codigo,
            d.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTUBC a
            INNER JOIN mayordomo_default.ESTPOT b ON a.ESTUBCPOC = b.ESTPOTCOD
            INNER JOIN mayordomo_establecimiento.ESTLOT c ON a.ESTUBCLOT = c.ESTLOTCOD
            INNER JOIN mayordomo_default.ESTFIC d ON a.ESTUBCESC = d.ESTFICCOD

            WHERE a.ESTUBCESC = ? AND a.ESTUBCCOD = ?

            ORDER BY a.ESTUBCESC, b.ESTPOTNOM, c.ESTLOTNOM";

            $sql01  = "SELECT
            a.ESTUBDCOD         AS          establecimiento_ubicacion_detalle_codigo,
            a.ESTUBDCAN         AS          establecimiento_ubicacion_detalle_cantidad,
            a.ESTUBDOBS         AS          establecimiento_ubicacion_detalle_observacion,

            a.ESTUBDAEM         AS          auditoria_empresa_codigo,
            a.ESTUBDAEM         AS          auditoria_empresa_nombre,
            a.ESTUBDAUS         AS          auditoria_usuario,
            a.ESTUBDAFH         AS          auditoria_fecha_hora,
            a.ESTUBDAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_categoria_codigo,
            c.DOMFICNOM         AS          tipo_categoria_nombre,

            d.DOMFICCOD         AS          tipo_subcategoria_codigo,
            d.DOMFICNOM         AS          tipo_subcategoria_nombre,

            e.ESTUBCCOD         AS          establecimiento_ubicacion_codigo,
            e.ESTUBCNOM         AS          establecimiento_ubicacion_nombre

            FROM ESTUBD a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTUBDECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTUBDTCC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTUBDTSC = d.DOMFICCOD
            INNER JOIN mayordomo_establecimiento.ESTUBC e ON a.ESTUBDUBC = e.ESTUBCCOD

            WHERE a.ESTUBDTSC = ?

            ORDER BY c.DOMFICNOM, d.DOMFICNOM";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02]);

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $stmtESTABLECIMIENTO01  = $connESTABLECIMIENTO->prepare($sql01);
                    $stmtESTABLECIMIENTO01->execute([$rowESTABLECIMIENTO['establecimiento_ubicacion_codigo']]);

                    $cantUbicado = 0;

                    while ($rowESTABLECIMIENTO01 = $stmtESTABLECIMIENTO01->fetch()) {
                        $cantUbicado = $cantUbicado + $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_cantidad'];
                        $detalle        = array(
                            'establecimiento_ubicacion_detalle_codigo'              => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_codigo'],
                            'establecimiento_ubicacion_detalle_cantidad'            => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_cantidad'],
                            'establecimiento_ubicacion_detalle_observacion'         => $rowESTABLECIMIENTO01['establecimiento_ubicacion_detalle_observacion'],
                            'establecimiento_ubicacion_codigo'                      => $rowESTABLECIMIENTO01['establecimiento_ubicacion_codigo'],
                            'establecimiento_ubicacion_nombre'                      => $rowESTABLECIMIENTO01['establecimiento_ubicacion_nombre'],
                            'tipo_estado_codigo'                                    => $rowESTABLECIMIENTO01['tipo_estado_codigo'],
                            'tipo_estado_nombre'                                    => $rowESTABLECIMIENTO01['tipo_estado_nombre'],
                            'tipo_categoria_codigo'                                 => $rowESTABLECIMIENTO01['tipo_categoria_codigo'],
                            'tipo_categoria_nombre'                                 => $rowESTABLECIMIENTO01['tipo_categoria_nombre'],
                            'tipo_subcategoria_codigo'                              => $rowESTABLECIMIENTO01['tipo_subcategoria_codigo'],
                            'tipo_subcategoria_nombre'                              => $rowESTABLECIMIENTO01['tipo_subcategoria_nombre'],
                            'auditoria_empresa_codigo'                              => $rowESTABLECIMIENTO01['auditoria_empresa_codigo'],
                            'auditoria_empresa_nombre'                              => $rowESTABLECIMIENTO01['auditoria_empresa_nombre'],
                            'auditoria_usuario'                                     => $rowESTABLECIMIENTO01['auditoria_usuario'],
                            'auditoria_fecha_hora'                                  => date_format(date_create($rowESTABLECIMIENTO01['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                            'auditoria_ip'                                          => $rowESTABLECIMIENTO01['auditoria_ip']
                        );    
                        $result_detalle[]   = $detalle;
                    }

                    if (!isset($result_detalle)){
                        $result_detalle = array(
                            'establecimiento_ubicacion_detalle_codigo'              => 0,
                            'establecimiento_ubicacion_detalle_cantidad'            => '',
                            'establecimiento_ubicacion_detalle_observacion'         => '',
                            'establecimiento_ubicacion_codigo'                      => '',
                            'establecimiento_ubicacion_nombre'                      => '',
                            'tipo_estado_codigo'                                    => '',
                            'tipo_estado_nombre'                                    => '',
                            'tipo_categoria_codigo'                                 => '',
                            'tipo_categoria_nombre'                                 => '',
                            'tipo_subcategoria_codigo'                              => '',
                            'tipo_subcategoria_nombre'                              => '',
                            'auditoria_empresa_codigo'                              => '',
                            'auditoria_empresa_nombre'                              => '',
                            'auditoria_usuario'                                     => '',
                            'auditoria_fecha_hora'                                  => '',
                            'auditoria_ip'                                          => ''
                        );
                    }

                    $detalle    = array(
                        'establecimiento_ubicacion_codigo'              => $rowESTABLECIMIENTO['establecimiento_ubicacion_codigo'],
                        'establecimiento_ubicacion_nombre'              => $rowESTABLECIMIENTO['establecimiento_ubicacion_nombre'],
                        'establecimiento_ubicacion_cantidad'            => $cantUbicado,
                        'establecimiento_ubicacion_observacion'         => $rowESTABLECIMIENTO['establecimiento_ubicacion_observacion'],
                        'establecimiento_potrero_codigo'                => $rowESTABLECIMIENTO['establecimiento_potrero_codigo'],
                        'establecimiento_potrero_nombre'                => $rowESTABLECIMIENTO['establecimiento_potrero_nombre'],
                        'establecimiento_lote_codigo'                   => $rowESTABLECIMIENTO['establecimiento_lote_codigo'],
                        'establecimiento_lote_nombre'                   => $rowESTABLECIMIENTO['establecimiento_lote_nombre'],
                        'establecimiento_codigo'                        => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'auditoria_empresa_codigo'                      => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                      => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                             => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                          => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                  => $rowESTABLECIMIENTO['auditoria_ip'],
                        'detalle'                                       => $result_detalle
                    );
                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'establecimiento_ubicacion_codigo'              => '',
                        'establecimiento_ubicacion_nombre'              => '',
                        'establecimiento_ubicacion_cantidad'            => '',
                        'establecimiento_ubicacion_observacion'         => '',
                        'establecimiento_potrero_codigo'                => '',
                        'establecimiento_potrero_nombre'                => '',
                        'establecimiento_lote_codigo'                   => '',
                        'establecimiento_lote_nombre'                   => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'auditoria_empresa_codigo'                      => '',
                        'auditoria_empresa_nombre'                      => '',
                        'auditoria_usuario'                             => '',
                        'auditoria_fecha_hora'                          => '',
                        'auditoria_ip'                                  => '',
                        'detalle'                                       => ''
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

    $app->get('/v1/establecimiento/608/{codigo}/{nacimiento}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = date('Y-m-d', strtotime($request->getAttribute('nacimiento')));
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ANINACCOD         AS          animal_nacimiento_codigo,
            a.ANINACFEC         AS          animal_fecha_codigo,
            a.ANINACOBS         AS          animal_nacimiento_observacion,

            a.ANINACAEM         AS          auditoria_empresa_codigo,
            a.ANINACAEM         AS          auditoria_empresa_nombre,
            a.ANINACAUS         AS          auditoria_usuario,
            a.ANINACAFH         AS          auditoria_fecha_hora,
            a.ANINACAIP         AS          auditoria_ip,

            b.ESTFICCOD         AS          establecimiento_codigo,
            b.ESTFICNOM         AS          establecimiento_nombre,

            c.ESTPERCOD         AS          establecimiento_persona_codigo,
            c.ESTPERPER         AS          establecimiento_persona_completo,
            
            d.ANIFICCOD         AS          animal_codigo,
            d.ANIFICCO1         AS          animal_codigo_nacimiento,

            e.ANIPESCOD         AS          animal_pesaje_codigo,
            e.ANIPESFEC         AS          animal_pesaje_fecha,
            e.ANIPESPES         AS          animal_pesaje_peso,

            f.DOMFICCOD         AS          tipo_origen_codigo,
            f.DOMFICNOM         AS          tipo_origen_nombre,

            g.DOMFICCOD         AS          tipo_raza_codigo,
            g.DOMFICNOM         AS          tipo_raza_nombre,

            h.DOMFICCOD         AS          tipo_categoria_codigo,
            h.DOMFICNOM         AS          tipo_categoria_nombre,

            i.DOMFICCOD         AS          tipo_subcategoria_codigo,
            i.DOMFICNOM         AS          tipo_subcategoria_nombre

            FROM ANINAC a
            INNER JOIN mayordomo_default.ESTFIC b ON a.ANINACESC = b.ESTFICCOD
            INNER JOIN mayordomo_establecimiento.ESTPER c ON a.ANINACPEC = c.ESTPERCOD
            INNER JOIN mayordomo_establecimiento.ANIFIC d ON a.ANINACANC = d.ANIFICCOD
            INNER JOIN mayordomo_establecimiento.ANIPES e ON a.ANINACANC = e.ANIPESANC
            INNER JOIN mayordomo_default.DOMFIC f ON d.ANIFICTOC = f.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC g ON d.ANIFICTRC = g.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC h ON d.ANIFICTCC = h.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC i ON d.ANIFICTSC = i.DOMFICCOD

            WHERE a.ANINACESC = ? AND a.ANINACFEC = ?

            ORDER BY a.ANINACFEC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'animal_nacimiento_codigo'                              => $rowESTABLECIMIENTO['animal_nacimiento_codigo'],
                        'animal_fecha_codigo'                                   => date_format(date_create($rowESTABLECIMIENTO['animal_fecha_codigo']), 'd/m/Y'),
                        'animal_nacimiento_observacion'                         => $rowESTABLECIMIENTO['animal_nacimiento_observacion'],
                        'establecimiento_codigo'                                => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                                => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_persona_codigo'                        => $rowESTABLECIMIENTO['establecimiento_persona_codigo'],
                        'establecimiento_persona_completo'                      => $rowESTABLECIMIENTO['establecimiento_persona_completo'],
                        'animal_codigo'                                         => $rowESTABLECIMIENTO['animal_codigo'],
                        'animal_codigo_nacimiento'                              => $rowESTABLECIMIENTO['animal_codigo_nacimiento'],
                        'animal_pesaje_codigo'                                  => $rowESTABLECIMIENTO['animal_pesaje_codigo'],
                        'animal_pesaje_fecha'                                   => date_format(date_create($rowESTABLECIMIENTO['animal_pesaje_fecha']), 'd/m/Y'),
                        'animal_pesaje_peso'                                    => $rowESTABLECIMIENTO['animal_pesaje_peso'],
                        'tipo_origen_codigo'                                    => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                                    => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'tipo_raza_codigo'                                      => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                                      => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'tipo_categoria_codigo'                                 => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                                 => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'tipo_subcategoria_codigo'                              => $rowESTABLECIMIENTO['tipo_subcategoria_codigo'],
                        'tipo_subcategoria_nombre'                              => $rowESTABLECIMIENTO['tipo_subcategoria_nombre'],
                        'auditoria_empresa_codigo'                              => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                              => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                                     => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                                  => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                          => $rowESTABLECIMIENTO['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'animal_nacimiento_codigo'                              => '',
                        'animal_fecha_codigo'                                   => '',
                        'animal_nacimiento_observacion'                         => '',
                        'establecimiento_codigo'                                => '',
                        'establecimiento_nombre'                                => '',
                        'establecimiento_persona_codigo'                        => '',
                        'establecimiento_persona_completo'                      => '',
                        'animal_codigo'                                         => '',
                        'animal_codigo_nacimiento'                              => '',
                        'animal_pesaje_codigo'                                  => '',
                        'animal_pesaje_fecha'                                   => '',
                        'animal_pesaje_peso'                                    => '',
                        'tipo_origen_codigo'                                    => '',
                        'tipo_origen_nombre'                                    => '',
                        'tipo_raza_codigo'                                      => '',
                        'tipo_raza_nombre'                                      => '',
                        'tipo_categoria_codigo'                                 => '',
                        'tipo_categoria_nombre'                                 => '',
                        'tipo_subcategoria_codigo'                              => '',
                        'tipo_subcategoria_nombre'                              => '',
                        'auditoria_empresa_codigo'                              => '',
                        'auditoria_empresa_nombre'                              => '',
                        'auditoria_usuario'                                     => '',
                        'auditoria_fecha_hora'                                  => '',
                        'auditoria_ip'                                          => ''
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

    $app->get('/v1/establecimiento/609/{codigo}/{donacion}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01  = $request->getAttribute('codigo');
        $val02  = date('Y-m-d', strtotime($request->getAttribute('donacion')));
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ANIDONCOD         AS          animal_donacion_codigo,
            a.ANIDONFEC         AS          animal_donacion_fecha,
            a.ANIDONOBS         AS          animal_donacion_observacion,

            a.ANIDONAEM         AS          auditoria_empresa_codigo,
            a.ANIDONAEM         AS          auditoria_empresa_nombre,
            a.ANIDONAUS         AS          auditoria_usuario,
            a.ANIDONAFH         AS          auditoria_fecha_hora,
            a.ANIDONAIP         AS          auditoria_ip,

            b.ESTFICCOD         AS          establecimiento_codigo,
            b.ESTFICNOM         AS          establecimiento_nombre,
         
            c.ANIFICCOD         AS          animal_codigo,
            c.ANIFICCO2         AS          animal_codigo_donacion,

            d.ESTPERCOD         AS          establecimiento_persona_codigo,
            d.ESTPERPER         AS          establecimiento_persona_completo,

            e.DOMFICCOD         AS          tipo_origen_codigo,
            e.DOMFICNOM         AS          tipo_origen_nombre,

            f.DOMFICCOD         AS          tipo_raza_codigo,
            f.DOMFICNOM         AS          tipo_raza_nombre,

            g.DOMFICCOD         AS          tipo_categoria_codigo,
            g.DOMFICNOM         AS          tipo_categoria_nombre,

            h.DOMFICCOD         AS          tipo_subcategoria_codigo,
            h.DOMFICNOM         AS          tipo_subcategoria_nombre,

            i.DOMFICCOD         AS          tipo_donacion_codigo,
            i.DOMFICNOM         AS          tipo_donacion_nombre

            FROM ANIDON a
            INNER JOIN mayordomo_default.ESTFIC b ON a.ANIDONESC = b.ESTFICCOD
            INNER JOIN mayordomo_establecimiento.ANIFIC c ON a.ANIDONANC = c.ANIFICCOD
            INNER JOIN mayordomo_establecimiento.ESTPER d ON c.ANIFICPEC = d.ESTPERCOD
            INNER JOIN mayordomo_default.DOMFIC e ON c.ANIFICTOC = e.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC f ON c.ANIFICTRC = f.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC g ON c.ANIFICTCC = g.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC h ON c.ANIFICTSC = h.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC i ON a.ANIDONTDC = i.DOMFICCOD

            WHERE a.ANIDONESC = ? AND a.ANIDONFEC = ?

            ORDER BY a.ANIDONFEC";

            try {
                $connESTABLECIMIENTO  = getConnectionESTABLECIMIENTO();
                $stmtESTABLECIMIENTO  = $connESTABLECIMIENTO->prepare($sql00);
                $stmtESTABLECIMIENTO->execute([$val01, $val02]); 

                while ($rowESTABLECIMIENTO = $stmtESTABLECIMIENTO->fetch()) {
                    $detalle    = array(
                        'animal_donacion_codigo'                                => $rowESTABLECIMIENTO['animal_nacimiento_codigo'],
                        'animal_donacion_fecha'                                 => date_format(date_create($rowESTABLECIMIENTO['animal_donacion_fecha']), 'd/m/Y'),
                        'animal_donacion_observacion'                           => $rowESTABLECIMIENTO['animal_nacimiento_observacion'],
                        'establecimiento_codigo'                                => $rowESTABLECIMIENTO['establecimiento_codigo'],
                        'establecimiento_nombre'                                => $rowESTABLECIMIENTO['establecimiento_nombre'],
                        'establecimiento_persona_codigo'                        => $rowESTABLECIMIENTO['establecimiento_persona_codigo'],
                        'establecimiento_persona_completo'                      => $rowESTABLECIMIENTO['establecimiento_persona_completo'],
                        'animal_codigo'                                         => $rowESTABLECIMIENTO['animal_codigo'],
                        'animal_codigo_donacion'                                => $rowESTABLECIMIENTO['animal_codigo_donacion'],
                        'tipo_origen_codigo'                                    => $rowESTABLECIMIENTO['tipo_origen_codigo'],
                        'tipo_origen_nombre'                                    => $rowESTABLECIMIENTO['tipo_origen_nombre'],
                        'tipo_raza_codigo'                                      => $rowESTABLECIMIENTO['tipo_raza_codigo'],
                        'tipo_raza_nombre'                                      => $rowESTABLECIMIENTO['tipo_raza_nombre'],
                        'tipo_categoria_codigo'                                 => $rowESTABLECIMIENTO['tipo_categoria_codigo'],
                        'tipo_categoria_nombre'                                 => $rowESTABLECIMIENTO['tipo_categoria_nombre'],
                        'tipo_subcategoria_codigo'                              => $rowESTABLECIMIENTO['tipo_subcategoria_codigo'],
                        'tipo_subcategoria_nombre'                              => $rowESTABLECIMIENTO['tipo_subcategoria_nombre'],
                        'tipo_donacion_codigo'                                  => $rowESTABLECIMIENTO['tipo_donacion_codigo'],
                        'tipo_donacion_nombre'                                  => $rowESTABLECIMIENTO['tipo_donacion_nombre'],
                        'auditoria_empresa_codigo'                              => $rowESTABLECIMIENTO['auditoria_empresa_codigo'],
                        'auditoria_empresa_nombre'                              => $rowESTABLECIMIENTO['auditoria_empresa_nombre'],
                        'auditoria_usuario'                                     => $rowESTABLECIMIENTO['auditoria_usuario'],
                        'auditoria_fecha_hora'                                  => date_format(date_create($rowESTABLECIMIENTO['auditoria_fecha_hora']), 'd/m/Y H:i:s'),
                        'auditoria_ip'                                          => $rowESTABLECIMIENTO['auditoria_ip']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'animal_donacion_codigo'                                => '',
                        'animal_donacion_fecha'                                 => '',
                        'animal_donacion_observacion'                           => '',
                        'establecimiento_codigo'                                => '',
                        'establecimiento_nombre'                                => '',
                        'establecimiento_persona_codigo'                        => '',
                        'establecimiento_persona_completo'                      => '',
                        'animal_codigo'                                         => '',
                        'animal_codigo_donacion'                                => '',
                        'tipo_origen_codigo'                                    => '',
                        'tipo_origen_nombre'                                    => '',
                        'tipo_raza_codigo'                                      => '',
                        'tipo_raza_nombre'                                      => '',
                        'tipo_categoria_codigo'                                 => '',
                        'tipo_categoria_nombre'                                 => '',
                        'tipo_subcategoria_codigo'                              => '',
                        'tipo_subcategoria_nombre'                              => '',
                        'tipo_donacion_codigo'                                  => '',
                        'tipo_donacion_nombre'                                  => '',
                        'auditoria_empresa_codigo'                              => '',
                        'auditoria_empresa_nombre'                              => '',
                        'auditoria_usuario'                                     => '',
                        'auditoria_fecha_hora'                                  => '',
                        'auditoria_ip'                                          => ''
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