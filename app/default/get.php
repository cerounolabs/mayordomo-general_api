<?php
    $app->get('/v1/000/dominio', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.DOMFICCOD         AS          tipo_codigo,
        a.DOMFICORD         AS          tipo_orden,
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

        ORDER BY a.DOMFICORD, a.DOMFICNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'tipo_codigo'           => $rowDEFAULT['tipo_codigo'],
                    'tipo_orden'            => $rowDEFAULT['tipo_orden'],
                    'tipo_estado_codigo'    => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'    => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),
                    'tipo_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_nombre']))),
                    'tipo_dominio'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                    'tipo_observacion'      => trim($rowDEFAULT['tipo_observacion']),
                    'tipo_empresa_codigo'   => $rowDEFAULT['tipo_empresa_codigo'],
                    'tipo_empresa_nombre'   => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                    'tipo_usuario'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                    'tipo_fecha_hora'       => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                    'tipo_ip'               => trim($rowDEFAULT['tipo_ip'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DOMINIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_codigo'           => '',
                    'tipo_orden'            => '',
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

    $app->get('/v1/000/dominio/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.DOMFICCOD         AS          tipo_codigo,
            a.DOMFICORD         AS          tipo_orden,
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

            ORDER BY a.DOMFICORD, a.DOMFICNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_codigo'           => $rowDEFAULT['tipo_codigo'],
                        'tipo_orden'            => $rowDEFAULT['tipo_orden'],
                        'tipo_estado_codigo'    => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'    => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),
                        'tipo_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_nombre']))),
                        'tipo_dominio'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                        'tipo_observacion'      => trim($rowDEFAULT['tipo_observacion']),
                        'tipo_empresa_codigo'   => $rowDEFAULT['tipo_empresa_codigo'],
                        'tipo_empresa_nombre'   => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                        'tipo_usuario'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                        'tipo_fecha_hora'       => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                        'tipo_ip'               => trim($rowDEFAULT['tipo_ip'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success DOMINIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_codigo'           => '',
                        'tipo_orden'            => '',
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

    $app->get('/v1/000/dominiosub', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.DOMSUBORD         AS          tipo_orden,
        a.DOMSUBVAL         AS          tipo_dominio,
        a.DOMSUBOBS         AS          tipo_observacion,
        a.DOMSUBAEM         AS          tipo_empresa_codigo,
        a.DOMSUBAEM         AS          tipo_empresa_nombre,
        a.DOMSUBAUS         AS          tipo_usuario,
        a.DOMSUBAFH         AS          tipo_fecha_hora,
        a.DOMSUBAIP         AS          tipo_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.DOMFICCOD         AS          tipo_dominio1_codigo,
        c.DOMFICNOM         AS          tipo_dominio1_nombre,
        c.DOMFICVAL         AS          tipo_dominio1_dominio,

        d.DOMFICCOD         AS          tipo_dominio2_codigo,
        d.DOMFICNOM         AS          tipo_dominio2_nombre
        d.DOMFICVAL         AS          tipo_dominio2_dominio
        
        FROM DOMSUB a
        INNER JOIN DOMFIC b ON a.DOMSUBEDC = b.DOMFICCOD
        INNER JOIN DOMFIC c ON a.DOMSUBCO1 = c.DOMFICCOD
        INNER JOIN DOMFIC d ON a.DOMSUBCO2 = d.DOMFICCOD

        ORDER BY a.DOMSUBVAL, a.DOMSUBORD";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'tipo_dominio1_codigo'          => $rowDEFAULT['tipo_dominio1_codigo'],
                    'tipo_dominio1_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_nombre']))),
                    'tipo_dominio1_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_dominio']))),
                    
                    'tipo_dominio2_codigo'          => $rowDEFAULT['tipo_dominio2_codigo'],
                    'tipo_dominio2_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_nombre']))),
                    'tipo_dominio2_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_dominio']))),

                    'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'            => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),

                    'tipo_orden'                    => $rowDEFAULT['tipo_orden'],
                    'tipo_dominio'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                    'tipo_observacion'              => $rowDEFAULT['tipo_observacion'],
                    'tipo_empresa_codigo'           => $rowDEFAULT['tipo_empresa_codigo'],
                    'tipo_empresa_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                    'tipo_usuario'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                    'tipo_fecha_hora'               => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                    'tipo_ip'                       => trim($rowDEFAULT['tipo_ip'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SUBDOMINIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_dominio1_codigo'          => '',
                    'tipo_dominio1_nombre'          => '',
                    'tipo_dominio1_dominio'         => '',
                    'tipo_dominio2_codigo'          => '',
                    'tipo_dominio2_nombre'          => '',
                    'tipo_dominio2_dominio'         => '',
                    'tipo_estado_codigo'            => '',
                    'tipo_estado_nombre'            => '',
                    'tipo_orden'                    => '',
                    'tipo_dominio'                  => '',
                    'tipo_observacion'              => '',
                    'tipo_empresa_codigo'           => '',
                    'tipo_empresa_nombre'           => '',
                    'tipo_usuario'                  => '',
                    'tipo_fecha_hora'               => '',
                    'tipo_ip'                       => ''
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

    $app->get('/v1/000/dominiosub/{dominio}/{codigo1}/{codigo2}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('dominio');
        $val02      = $request->getAttribute('codigo1');
        $val03      = $request->getAttribute('codigo2');
        
        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "SELECT
            a.DOMSUBORD         AS          tipo_orden,
            a.DOMSUBVAL         AS          tipo_dominio,
            a.DOMSUBOBS         AS          tipo_observacion,
            a.DOMSUBAEM         AS          tipo_empresa_codigo,
            a.DOMSUBAEM         AS          tipo_empresa_nombre,
            a.DOMSUBAUS         AS          tipo_usuario,
            a.DOMSUBAFH         AS          tipo_fecha_hora,
            a.DOMSUBAIP         AS          tipo_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_dominio1_codigo,
            c.DOMFICNOM         AS          tipo_dominio1_nombre,
            c.DOMFICVAL         AS          tipo_dominio1_dominio,

            d.DOMFICCOD         AS          tipo_dominio2_codigo,
            d.DOMFICNOM         AS          tipo_dominio2_nombre
            d.DOMFICVAL         AS          tipo_dominio2_dominio
            
            FROM DOMSUB a
            INNER JOIN DOMFIC b ON a.DOMSUBEDC = b.DOMFICCOD
            INNER JOIN DOMFIC c ON a.DOMSUBCO1 = c.DOMFICCOD
            INNER JOIN DOMFIC d ON a.DOMSUBCO2 = d.DOMFICCOD

            WHERE a.DOMSUBVAL = ? AND a.DOMSUBCO1 = ? AND a.DOMSUBCO2 = ?

            ORDER BY a.DOMSUBVAL, a.DOMSUBORD";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_dominio1_codigo'          => $rowDEFAULT['tipo_dominio1_codigo'],
                        'tipo_dominio1_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_nombre']))),
                        'tipo_dominio1_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_dominio']))),
                        
                        'tipo_dominio2_codigo'          => $rowDEFAULT['tipo_dominio2_codigo'],
                        'tipo_dominio2_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_nombre']))),
                        'tipo_dominio2_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_dominio']))),
    
                        'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'            => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),
    
                        'tipo_orden'                    => $rowDEFAULT['tipo_orden'],
                        'tipo_dominio'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                        'tipo_observacion'              => $rowDEFAULT['tipo_observacion'],
                        'tipo_empresa_codigo'           => $rowDEFAULT['tipo_empresa_codigo'],
                        'tipo_empresa_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                        'tipo_usuario'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                        'tipo_fecha_hora'               => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                        'tipo_ip'                       => trim($rowDEFAULT['tipo_ip'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SUBDOMINIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_dominio1_codigo'          => '',
                        'tipo_dominio1_nombre'          => '',
                        'tipo_dominio1_dominio'         => '',
                        'tipo_dominio2_codigo'          => '',
                        'tipo_dominio2_nombre'          => '',
                        'tipo_dominio2_dominio'         => '',
                        'tipo_estado_codigo'            => '',
                        'tipo_estado_nombre'            => '',
                        'tipo_orden'                    => '',
                        'tipo_dominio'                  => '',
                        'tipo_observacion'              => '',
                        'tipo_empresa_codigo'           => '',
                        'tipo_empresa_nombre'           => '',
                        'tipo_usuario'                  => '',
                        'tipo_fecha_hora'               => '',
                        'tipo_ip'                       => ''
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
    
    $app->get('/v1/000/dominiotri', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.DOMTRIORD         AS          tipo_orden,
        a.DOMTRIVAL         AS          tipo_dominio,
        a.DOMTRIOBS         AS          tipo_observacion,
        a.DOMTRIAEM         AS          tipo_empresa_codigo,
        a.DOMTRIAEM         AS          tipo_empresa_nombre,
        a.DOMTRIAUS         AS          tipo_usuario,
        a.DOMTRIAFH         AS          tipo_fecha_hora,
        a.DOMTRIAIP         AS          tipo_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.DOMFICCOD         AS          tipo_dominio1_codigo,
        c.DOMFICNOM         AS          tipo_dominio1_nombre,
        c.DOMFICVAL         AS          tipo_dominio1_dominio,

        d.DOMFICCOD         AS          tipo_dominio2_codigo,
        d.DOMFICNOM         AS          tipo_dominio2_nombre
        d.DOMFICVAL         AS          tipo_dominio2_dominio,

        e.DOMFICCOD         AS          tipo_dominio3_codigo,
        e.DOMFICNOM         AS          tipo_dominio3_nombre,
        e.DOMFICVAL         AS          tipo_dominio3_dominio
        
        FROM DOMTRI a
        INNER JOIN DOMFIC b ON a.DOMTRIEDC = b.DOMFICCOD
        INNER JOIN DOMFIC c ON a.DOMTRICO1 = c.DOMFICCOD
        INNER JOIN DOMFIC d ON a.DOMTRICO2 = d.DOMFICCOD
        INNER JOIN DOMFIC e ON a.DOMTRICO3 = e.DOMFICCOD

        ORDER BY a.DOMTRIVAL, a.DOMTRIORD";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'tipo_dominio1_codigo'          => $rowDEFAULT['tipo_dominio1_codigo'],
                    'tipo_dominio1_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_nombre']))),
                    'tipo_dominio1_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_dominio']))),

                    'tipo_dominio2_codigo'          => $rowDEFAULT['tipo_dominio2_codigo'],
                    'tipo_dominio2_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_nombre']))),
                    'tipo_dominio2_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_dominio']))),

                    'tipo_dominio3_codigo'          => $rowDEFAULT['tipo_dominio3_codigo'],
                    'tipo_dominio3_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio3_nombre']))),
                    'tipo_dominio3_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio3_dominio']))),

                    'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'            => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),

                    'tipo_orden'                    => $rowDEFAULT['tipo_orden'],
                    'tipo_dominio'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                    'tipo_observacion'              => $rowDEFAULT['tipo_observacion'],
                    'tipo_empresa_codigo'           => $rowDEFAULT['tipo_empresa_codigo'],
                    'tipo_empresa_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                    'tipo_usuario'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                    'tipo_fecha_hora'               => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                    'tipo_ip'                       => trim($rowDEFAULT['tipo_ip'])
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success TRIDOMONIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'tipo_dominio1_codigo'          => '',
                    'tipo_dominio1_nombre'          => '',
                    'tipo_dominio1_dominio'         => '',
                    'tipo_dominio2_codigo'          => '',
                    'tipo_dominio2_nombre'          => '',
                    'tipo_dominio2_dominio'         => '',
                    'tipo_dominio3_codigo'          => '',
                    'tipo_dominio3_nombre'          => '',
                    'tipo_dominio3_dominio'         => '',
                    'tipo_estado_codigo'            => '',
                    'tipo_estado_nombre'            => '',
                    'tipo_orden'                    => '',
                    'tipo_dominio'                  => '',
                    'tipo_observacion'              => '',
                    'tipo_empresa_codigo'           => '',
                    'tipo_empresa_nombre'           => '',
                    'tipo_usuario'                  => '',
                    'tipo_fecha_hora'               => '',
                    'tipo_ip'                       => ''
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

    $app->get('/v1/000/dominiotri/{dominio}/{codigo1}/{codigo2}/{codigo3}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('dominio');
        $val02      = $request->getAttribute('codigo1');
        $val03      = $request->getAttribute('codigo2');
        $val04      = $request->getAttribute('codigo3');
        
        if (isset($val01) && isset($val02) && isset($val03) && isset($val04)) {
            $sql00  = "SELECT
            a.DOMTRIORD         AS          tipo_orden,
            a.DOMTRIVAL         AS          tipo_dominio,
            a.DOMTRIOBS         AS          tipo_observacion,
            a.DOMTRIAEM         AS          tipo_empresa_codigo,
            a.DOMTRIAEM         AS          tipo_empresa_nombre,
            a.DOMTRIAUS         AS          tipo_usuario,
            a.DOMTRIAFH         AS          tipo_fecha_hora,
            a.DOMTRIAIP         AS          tipo_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_dominio1_codigo,
            c.DOMFICNOM         AS          tipo_dominio1_nombre,
            c.DOMFICVAL         AS          tipo_dominio1_dominio,

            d.DOMFICCOD         AS          tipo_dominio2_codigo,
            d.DOMFICNOM         AS          tipo_dominio2_nombre
            d.DOMFICVAL         AS          tipo_dominio2_dominio,

            e.DOMFICCOD         AS          tipo_dominio3_codigo,
            e.DOMFICNOM         AS          tipo_dominio3_nombre,
            e.DOMFICVAL         AS          tipo_dominio3_dominio
            
            FROM DOMTRI a
            INNER JOIN DOMFIC b ON a.DOMTRIEDC = b.DOMFICCOD
            INNER JOIN DOMFIC c ON a.DOMTRICO1 = c.DOMFICCOD
            INNER JOIN DOMFIC d ON a.DOMTRICO2 = d.DOMFICCOD
            INNER JOIN DOMFIC e ON a.DOMTRICO3 = e.DOMFICCOD

            WHERE a.DOMTRIVAL = ? AND a.DOMTRICO1 = ? AND a.DOMTRICO2 = ? AND  a.DOMTRICO3 = ?

            ORDER BY a.DOMTRIVAL, a.DOMTRIORD";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03, $val04]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_dominio1_codigo'          => $rowDEFAULT['tipo_dominio1_codigo'],
                        'tipo_dominio1_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_nombre']))),
                        'tipo_dominio1_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio1_dominio']))),

                        'tipo_dominio2_codigo'          => $rowDEFAULT['tipo_dominio2_codigo'],
                        'tipo_dominio2_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_nombre']))),
                        'tipo_dominio2_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio2_dominio']))),

                        'tipo_dominio3_codigo'          => $rowDEFAULT['tipo_dominio3_codigo'],
                        'tipo_dominio3_nombre'          => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio3_nombre']))),
                        'tipo_dominio3_dominio'         => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio3_dominio']))),

                        'tipo_estado_codigo'            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'            => strtoupper(strtolower(trim($rowDEFAULT['tipo_estado_nombre']))),

                        'tipo_orden'                    => $rowDEFAULT['tipo_orden'],
                        'tipo_dominio'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_dominio']))),
                        'tipo_observacion'              => $rowDEFAULT['tipo_observacion'],
                        'tipo_empresa_codigo'           => $rowDEFAULT['tipo_empresa_codigo'],
                        'tipo_empresa_nombre'           => strtoupper(strtolower(trim($rowDEFAULT['tipo_empresa_nombre']))),
                        'tipo_usuario'                  => strtoupper(strtolower(trim($rowDEFAULT['tipo_usuario']))),
                        'tipo_fecha_hora'               => date('d/m/Y H:i:s', strtotime($rowDEFAULT['tipo_fecha_hora'])),
                        'tipo_ip'                       => trim($rowDEFAULT['tipo_ip'])
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success TRIDOMONIO', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'tipo_dominio1_codigo'          => '',
                        'tipo_dominio1_nombre'          => '',
                        'tipo_dominio1_dominio'         => '',
                        'tipo_dominio2_codigo'          => '',
                        'tipo_dominio2_nombre'          => '',
                        'tipo_dominio2_dominio'         => '',
                        'tipo_dominio3_codigo'          => '',
                        'tipo_dominio3_nombre'          => '',
                        'tipo_dominio3_dominio'         => '',
                        'tipo_estado_codigo'            => '',
                        'tipo_estado_nombre'            => '',
                        'tipo_orden'                    => '',
                        'tipo_dominio'                  => '',
                        'tipo_observacion'              => '',
                        'tipo_empresa_codigo'           => '',
                        'tipo_empresa_nombre'           => '',
                        'tipo_usuario'                  => '',
                        'tipo_fecha_hora'               => '',
                        'tipo_ip'                       => ''
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

            WHERE a.LOCDISCOD = ?

            ORDER BY f.LOCPAINOM, e.LOCDEPNOM, a.LOCDISNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

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

    $app->get('/v1/default/400', function($request) {
        require __DIR__.'/../../src/connect.php';

        $sql00  = "SELECT
        a.PERFICCOD         AS          persona_codigo,
        a.PERFICNOM         AS          persona_completo,
        a.PERFICDOC         AS          persona_documento,
        a.PERFICCST         AS          persona_codigo_sitrap,
        a.PERFICCSG         AS          persona_codigo_sigor,
        a.PERFICTEL         AS          persona_telefono,
        a.PERFICMAI         AS          persona_email,
        a.PERFICOBS         AS          persona_observacion,
        a.PERFICAEM         AS          persona_empresa_codigo,
        a.PERFICAEM         AS          persona_empresa_nombre,
        a.PERFICAUS         AS          persona_usuario,
        a.PERFICAFH         AS          persona_fecha_hora,
        a.PERFICAIP         AS          persona_ip,

        b.DOMFICCOD         AS          tipo_estado_codigo,
        b.DOMFICNOM         AS          tipo_estado_nombre,

        c.DOMFICCOD         AS          tipo_persona_codigo,
        c.DOMFICNOM         AS          tipo_persona_nombre,

        d.DOMFICCOD         AS          tipo_documento_codigo,
        d.DOMFICNOM         AS          tipo_documento_nombre
        
        FROM PERFIC a
        INNER JOIN DOMFIC b ON a.PERFICECC = b.DOMFICCOD
        INNER JOIN DOMFIC c ON a.PERFICTPC = c.DOMFICCOD
        INNER JOIN DOMFIC d ON a.PERFICTDC = d.DOMFICCOD

        ORDER BY a.PERFICNOM";

        try {
            $connDEFAULT  = getConnectionDEFAULT();
            $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
            $stmtDEFAULT->execute(); 

            while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                $detalle    = array(
                    'persona_codigo'                    => $rowDEFAULT['persona_codigo'],
                    'persona_completo'                  => $rowDEFAULT['persona_completo'],
                    'persona_documento'                 => $rowDEFAULT['persona_documento'],
                    'persona_codigo_sitrap'             => $rowDEFAULT['persona_codigo_sitrap'],
                    'persona_codigo_sigor'              => $rowDEFAULT['persona_codigo_sigor'],
                    'persona_telefono'                  => $rowDEFAULT['persona_telefono'],
                    'persona_email'                     => $rowDEFAULT['persona_email'],
                    'persona_observacion'               => $rowDEFAULT['persona_observacion'],
                    'persona_empresa_codigo'            => $rowDEFAULT['persona_empresa_codigo'],
                    'persona_empresa_nombre'            => $rowDEFAULT['persona_empresa_nombre'],
                    'persona_usuario'                   => $rowDEFAULT['persona_usuario'],
                    'persona_fecha_hora'                => date_format(date_create($rowDEFAULT['persona_fecha_hora']), 'd/m/Y H:i:s'),
                    'persona_ip'                        => $rowDEFAULT['persona_ip'],
                    'tipo_estado_codigo'                => $rowDEFAULT['tipo_estado_codigo'],
                    'tipo_estado_nombre'                => $rowDEFAULT['tipo_estado_nombre'],
                    'tipo_persona_codigo'               => $rowDEFAULT['tipo_persona_codigo'],
                    'tipo_persona_nombre'               => $rowDEFAULT['tipo_persona_nombre'],
                    'tipo_documento_codigo'             => $rowDEFAULT['tipo_documento_codigo'],
                    'tipo_documento_nombre'             => $rowDEFAULT['tipo_documento_nombre']
                );

                $result[]   = $detalle;
            }

            if (isset($result)){
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'persona_codigo'                    => '',
                    'persona_completo'                  => '',
                    'persona_documento'                 => '',
                    'persona_codigo_sitrap'             => '',
                    'persona_codigo_sigor'              => '',
                    'persona_telefono'                  => '',
                    'persona_email'                     => '',
                    'persona_observacion'               => '',
                    'persona_empresa_codigo'            => '',
                    'persona_empresa_nombre'            => '',
                    'persona_usuario'                   => '',
                    'persona_fecha_hora'                => '',
                    'persona_ip'                        => '',
                    'tipo_estado_codigo'                => '',
                    'tipo_estado_nombre'                => '',
                    'tipo_persona_codigo'               => '',
                    'tipo_persona_nombre'               => '',
                    'tipo_documento_codigo'             => '',
                    'tipo_documento_nombre'             => ''
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

    $app->get('/v1/default/400/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.PERFICCOD         AS          persona_codigo,
            a.PERFICNOM         AS          persona_completo,
            a.PERFICDOC         AS          persona_documento,
            a.PERFICCST         AS          persona_codigo_sitrap,
            a.PERFICCSG         AS          persona_codigo_sigor,
            a.PERFICTEL         AS          persona_telefono,
            a.PERFICMAI         AS          persona_email,
            a.PERFICOBS         AS          persona_observacion,
            a.PERFICAEM         AS          persona_empresa_codigo,
            a.PERFICAEM         AS          persona_empresa_nombre,
            a.PERFICAUS         AS          persona_usuario,
            a.PERFICAFH         AS          persona_fecha_hora,
            a.PERFICAIP         AS          persona_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_persona_codigo,
            c.DOMFICNOM         AS          tipo_persona_nombre,

            d.DOMFICCOD         AS          tipo_documento_codigo,
            d.DOMFICNOM         AS          tipo_documento_nombre
            
            FROM PERFIC a
            INNER JOIN DOMFIC b ON a.PERFICECC = b.DOMFICCOD
            INNER JOIN DOMFIC c ON a.PERFICTPC = c.DOMFICCOD
            INNER JOIN DOMFIC d ON a.PERFICTDC = d.DOMFICCOD

            WHERE a.PERFICCOD = ?
            ORDER BY a.PERFICNOM";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'persona_codigo'                    => $rowDEFAULT['persona_codigo'],
                        'persona_completo'                  => $rowDEFAULT['persona_completo'],
                        'persona_documento'                 => $rowDEFAULT['persona_documento'],
                        'persona_codigo_sitrap'             => $rowDEFAULT['persona_codigo_sitrap'],
                        'persona_codigo_sigor'              => $rowDEFAULT['persona_codigo_sigor'],
                        'persona_telefono'                  => $rowDEFAULT['persona_telefono'],
                        'persona_email'                     => $rowDEFAULT['persona_email'],
                        'persona_observacion'               => $rowDEFAULT['persona_observacion'],
                        'persona_empresa_codigo'            => $rowDEFAULT['persona_empresa_codigo'],
                        'persona_empresa_nombre'            => $rowDEFAULT['persona_empresa_nombre'],
                        'persona_usuario'                   => $rowDEFAULT['persona_usuario'],
                        'persona_fecha_hora'                => date_format(date_create($rowDEFAULT['persona_fecha_hora']), 'd/m/Y H:i:s'),
                        'persona_ip'                        => $rowDEFAULT['persona_ip'],
                        'tipo_estado_codigo'                => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_persona_codigo'               => $rowDEFAULT['tipo_persona_codigo'],
                        'tipo_persona_nombre'               => $rowDEFAULT['tipo_persona_nombre'],
                        'tipo_documento_codigo'             => $rowDEFAULT['tipo_documento_codigo'],
                        'tipo_documento_nombre'             => $rowDEFAULT['tipo_documento_nombre']
                    );

                    $result[]   = $detalle;
                }

                if (isset($result)){
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    $detalle = array(
                        'persona_codigo'                    => '',
                        'persona_completo'                  => '',
                        'persona_documento'                 => '',
                        'persona_codigo_sitrap'             => '',
                        'persona_codigo_sigor'              => '',
                        'persona_telefono'                  => '',
                        'persona_email'                     => '',
                        'persona_observacion'               => '',
                        'persona_empresa_codigo'            => '',
                        'persona_empresa_nombre'            => '',
                        'persona_usuario'                   => '',
                        'persona_fecha_hora'                => '',
                        'persona_ip'                        => '',
                        'tipo_estado_codigo'                => '',
                        'tipo_estado_nombre'                => '',
                        'tipo_persona_codigo'               => '',
                        'tipo_persona_nombre'               => '',
                        'tipo_documento_codigo'             => '',
                        'tipo_documento_nombre'             => ''
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

    $app->get('/v1/default/602/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTSECCOD         AS          establecimiento_seccion_codigo,
            a.ESTSECNOM         AS          establecimiento_seccion_nombre,
            a.ESTSECOBS         AS          establecimiento_seccion_observacion,
            a.ESTSECAEM         AS          auditoria_empresa_codigo,
            a.ESTSECAEM         AS          auditoria_empresa_nombre,
            a.ESTSECAUS         AS          auditoria_usuario,
            a.ESTSECAFH         AS          auditoria_fecha_hora,
            a.ESTSECAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTSEC a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTSECECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTSECESC = c.ESTFICCOD

            WHERE a.ESTSECESC = ? 

            ORDER BY a.ESTSECCOD";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_seccion_codigo'                => $rowDEFAULT['establecimiento_seccion_codigo'],
                        'establecimiento_seccion_nombre'                => $rowDEFAULT['establecimiento_seccion_nombre'],
                        'establecimiento_seccion_observacion'           => $rowDEFAULT['establecimiento_seccion_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_seccion_codigo'                => '',
                        'establecimiento_seccion_nombre'                => '',
                        'establecimiento_seccion_observacion'           => '',
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

    $app->get('/v1/default/602/{codigo}/{seccion}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('seccion');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTSECCOD         AS          establecimiento_seccion_codigo,
            a.ESTSECNOM         AS          establecimiento_seccion_nombre,
            a.ESTSECOBS         AS          establecimiento_seccion_observacion,
            a.ESTSECAEM         AS          auditoria_empresa_codigo,
            a.ESTSECAEM         AS          auditoria_empresa_nombre,
            a.ESTSECAUS         AS          auditoria_usuario,
            a.ESTSECAFH         AS          auditoria_fecha_hora,
            a.ESTSECAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.ESTFICCOD         AS          establecimiento_codigo,
            c.ESTFICNOM         AS          establecimiento_nombre
            
            FROM ESTSEC a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTSECECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC c ON a.ESTSECESC = c.ESTFICCOD

            WHERE a.ESTSECESC = ? AND a.ESTSECCOD = ?

            ORDER BY a.ESTSECCOD";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_seccion_codigo'                => $rowDEFAULT['establecimiento_seccion_codigo'],
                        'establecimiento_seccion_nombre'                => $rowDEFAULT['establecimiento_seccion_nombre'],
                        'establecimiento_seccion_observacion'           => $rowDEFAULT['establecimiento_seccion_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_seccion_codigo'                => '',
                        'establecimiento_seccion_nombre'                => '',
                        'establecimiento_seccion_observacion'           => '',
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

    $app->get('/v1/default/603/{codigo}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        
        if (isset($val01)) {
            $sql00  = "SELECT
            a.ESTPOTCOD         AS          establecimiento_potrero_codigo,
            a.ESTPOTNOM         AS          establecimiento_potrero_nombre,
            a.ESTPOTHEC         AS          establecimiento_potrero_hectarea,
            a.ESTPOTCAP         AS          establecimiento_potrero_capacidad,
            a.ESTPOTOBS         AS          establecimiento_potrero_observacion,
            a.ESTPOTAEM         AS          auditoria_empresa_codigo,
            a.ESTPOTAEM         AS          auditoria_empresa_nombre,
            a.ESTPOTAUS         AS          auditoria_usuario,
            a.ESTPOTAFH         AS          auditoria_fecha_hora,
            a.ESTPOTAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_pastura1_codigo,
            c.DOMFICNOM         AS          tipo_pastura1_nombre,

            d.DOMFICCOD         AS          tipo_pastura2_codigo,
            d.DOMFICNOM         AS          tipo_pastura2_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTSECCOD         AS          establecimiento_seccion_codigo,
            f.ESTSECNOM         AS          establecimiento_seccion_nombre
            
            FROM ESTPOT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOTECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOTTPC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOTTAC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOTESC = e.ESTFICCOD
            INNER JOIN mayordomo_default.ESTSEC f ON a.ESTPOTSEC = f.ESTSECCOD

            WHERE a.ESTPOTESC = ?

            ORDER BY a.ESTPOTESC, a.ESTPOTSEC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_pastura1_codigo'                          => $rowDEFAULT['tipo_pastura1_codigo'],
                        'tipo_pastura1_nombre'                          => $rowDEFAULT['tipo_pastura1_nombre'],
                        'tipo_pastura2_codigo'                          => $rowDEFAULT['tipo_pastura2_codigo'],
                        'tipo_pastura2_nombre'                          => $rowDEFAULT['tipo_pastura2_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_seccion_codigo'                => $rowDEFAULT['establecimiento_seccion_codigo'],
                        'establecimiento_seccion_nombre'                => $rowDEFAULT['establecimiento_seccion_nombre'],
                        'establecimiento_potrero_codigo'                => $rowDEFAULT['establecimiento_potrero_codigo'],
                        'establecimiento_potrero_nombre'                => $rowDEFAULT['establecimiento_potrero_nombre'],
                        'establecimiento_potrero_hectarea'              => $rowDEFAULT['establecimiento_potrero_hectarea'],
                        'establecimiento_potrero_capacidad'             => $rowDEFAULT['establecimiento_potrero_capacidad'],
                        'establecimiento_potrero_observacion'           => $rowDEFAULT['establecimiento_potrero_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'tipo_pastura1_codigo'                          => '',
                        'tipo_pastura1_nombre'                          => '',
                        'tipo_pastura2_codigo'                          => '',
                        'tipo_pastura2_nombre'                          => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_seccion_codigo'                => '',
                        'establecimiento_seccion_nombre'                => '',
                        'establecimiento_potrero_codigo'                => '',
                        'establecimiento_potrero_nombre'                => '',
                        'establecimiento_potrero_hectarea'              => '',
                        'establecimiento_potrero_capacidad'             => '',
                        'establecimiento_potrero_observacion'           => '',
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

    $app->get('/v1/default/603/{codigo}/{seccion}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('seccion');
        
        if (isset($val01) && isset($val02)) {
            $sql00  = "SELECT
            a.ESTPOTCOD         AS          establecimiento_potrero_codigo,
            a.ESTPOTNOM         AS          establecimiento_potrero_nombre,
            a.ESTPOTHEC         AS          establecimiento_potrero_hectarea,
            a.ESTPOTCAP         AS          establecimiento_potrero_capacidad,
            a.ESTPOTOBS         AS          establecimiento_potrero_observacion,
            a.ESTPOTAEM         AS          auditoria_empresa_codigo,
            a.ESTPOTAEM         AS          auditoria_empresa_nombre,
            a.ESTPOTAUS         AS          auditoria_usuario,
            a.ESTPOTAFH         AS          auditoria_fecha_hora,
            a.ESTPOTAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_pastura_codigo,
            c.DOMFICNOM         AS          tipo_pastura_nombre,

            d.DOMFICCOD         AS          tipo_pastura2_codigo,
            d.DOMFICNOM         AS          tipo_pastura2_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTSECCOD         AS          establecimiento_seccion_codigo,
            f.ESTSECNOM         AS          establecimiento_seccion_nombre
            
            FROM ESTPOT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOTECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOTTPC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOTTAC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOTESC = e.ESTFICCOD
            INNER JOIN mayordomo_default.ESTSEC f ON a.ESTPOTSEC = f.ESTSECCOD

            WHERE a.ESTPOTESC = ? AND a.ESTPOTSEC = ?

            ORDER BY a.ESTPOTESC, a.ESTPOTSEC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_pastura1_codigo'                          => $rowDEFAULT['tipo_pastura1_codigo'],
                        'tipo_pastura1_nombre'                          => $rowDEFAULT['tipo_pastura1_nombre'],
                        'tipo_pastura2_codigo'                          => $rowDEFAULT['tipo_pastura2_codigo'],
                        'tipo_pastura2_nombre'                          => $rowDEFAULT['tipo_pastura2_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_seccion_codigo'                => $rowDEFAULT['establecimiento_seccion_codigo'],
                        'establecimiento_seccion_nombre'                => $rowDEFAULT['establecimiento_seccion_nombre'],
                        'establecimiento_potrero_codigo'                => $rowDEFAULT['establecimiento_potrero_codigo'],
                        'establecimiento_potrero_nombre'                => $rowDEFAULT['establecimiento_potrero_nombre'],
                        'establecimiento_potrero_hectarea'              => $rowDEFAULT['establecimiento_potrero_hectarea'],
                        'establecimiento_potrero_capacidad'             => $rowDEFAULT['establecimiento_potrero_capacidad'],
                        'establecimiento_potrero_observacion'           => $rowDEFAULT['establecimiento_potrero_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'tipo_pastura1_codigo'                          => '',
                        'tipo_pastura1_nombre'                          => '',
                        'tipo_pastura2_codigo'                          => '',
                        'tipo_pastura2_nombre'                          => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_seccion_codigo'                => '',
                        'establecimiento_seccion_nombre'                => '',
                        'establecimiento_potrero_codigo'                => '',
                        'establecimiento_potrero_nombre'                => '',
                        'establecimiento_potrero_hectarea'              => '',
                        'establecimiento_potrero_capacidad'             => '',
                        'establecimiento_potrero_observacion'           => '',
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

    $app->get('/v1/default/603/{codigo}/{seccion}/{potrero}', function($request) {
        require __DIR__.'/../../src/connect.php';

        $val01      = $request->getAttribute('codigo');
        $val02      = $request->getAttribute('seccion');
        $val03      = $request->getAttribute('potrero');
        
        if (isset($val01) && isset($val02) && isset($val03)) {
            $sql00  = "SELECT
            a.ESTPOTCOD         AS          establecimiento_potrero_codigo,
            a.ESTPOTNOM         AS          establecimiento_potrero_nombre,
            a.ESTPOTHEC         AS          establecimiento_potrero_hectarea,
            a.ESTPOTCAP         AS          establecimiento_potrero_capacidad,
            a.ESTPOTOBS         AS          establecimiento_potrero_observacion,
            a.ESTPOTAEM         AS          auditoria_empresa_codigo,
            a.ESTPOTAEM         AS          auditoria_empresa_nombre,
            a.ESTPOTAUS         AS          auditoria_usuario,
            a.ESTPOTAFH         AS          auditoria_fecha_hora,
            a.ESTPOTAIP         AS          auditoria_ip,

            b.DOMFICCOD         AS          tipo_estado_codigo,
            b.DOMFICNOM         AS          tipo_estado_nombre,

            c.DOMFICCOD         AS          tipo_pastura_codigo,
            c.DOMFICNOM         AS          tipo_pastura_nombre,

            d.DOMFICCOD         AS          tipo_pastura2_codigo,
            d.DOMFICNOM         AS          tipo_pastura2_nombre,

            e.ESTFICCOD         AS          establecimiento_codigo,
            e.ESTFICNOM         AS          establecimiento_nombre,

            f.ESTSECCOD         AS          establecimiento_seccion_codigo,
            f.ESTSECNOM         AS          establecimiento_seccion_nombre
            
            FROM ESTPOT a
            INNER JOIN mayordomo_default.DOMFIC b ON a.ESTPOTECC = b.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC c ON a.ESTPOTTPC = c.DOMFICCOD
            INNER JOIN mayordomo_default.DOMFIC d ON a.ESTPOTTAC = d.DOMFICCOD
            INNER JOIN mayordomo_default.ESTFIC e ON a.ESTPOTESC = e.ESTFICCOD
            INNER JOIN mayordomo_default.ESTSEC f ON a.ESTPOTSEC = f.ESTSECCOD

            WHERE a.ESTPOTESC = ? AND a.ESTPOTSEC = ? AND a.ESTPOTCOD = ?

            ORDER BY a.ESTPOTESC, a.ESTPOTSEC";

            try {
                $connDEFAULT  = getConnectionDEFAULT();
                $stmtDEFAULT  = $connDEFAULT->prepare($sql00);
                $stmtDEFAULT->execute([$val01, $val02, $val03]); 

                while ($rowDEFAULT = $stmtDEFAULT->fetch()) {
                    $detalle    = array(
                        'tipo_estado_codigo'                            => $rowDEFAULT['tipo_estado_codigo'],
                        'tipo_estado_nombre'                            => $rowDEFAULT['tipo_estado_nombre'],
                        'tipo_pastura1_codigo'                          => $rowDEFAULT['tipo_pastura1_codigo'],
                        'tipo_pastura1_nombre'                          => $rowDEFAULT['tipo_pastura1_nombre'],
                        'tipo_pastura2_codigo'                          => $rowDEFAULT['tipo_pastura2_codigo'],
                        'tipo_pastura2_nombre'                          => $rowDEFAULT['tipo_pastura2_nombre'],
                        'establecimiento_codigo'                        => $rowDEFAULT['establecimiento_codigo'],
                        'establecimiento_nombre'                        => $rowDEFAULT['establecimiento_nombre'],
                        'establecimiento_seccion_codigo'                => $rowDEFAULT['establecimiento_seccion_codigo'],
                        'establecimiento_seccion_nombre'                => $rowDEFAULT['establecimiento_seccion_nombre'],
                        'establecimiento_potrero_codigo'                => $rowDEFAULT['establecimiento_potrero_codigo'],
                        'establecimiento_potrero_nombre'                => $rowDEFAULT['establecimiento_potrero_nombre'],
                        'establecimiento_potrero_hectarea'              => $rowDEFAULT['establecimiento_potrero_hectarea'],
                        'establecimiento_potrero_capacidad'             => $rowDEFAULT['establecimiento_potrero_capacidad'],
                        'establecimiento_potrero_observacion'           => $rowDEFAULT['establecimiento_potrero_observacion'],
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
                        'tipo_estado_codigo'                            => '',
                        'tipo_estado_nombre'                            => '',
                        'tipo_pastura1_codigo'                          => '',
                        'tipo_pastura1_nombre'                          => '',
                        'tipo_pastura2_codigo'                          => '',
                        'tipo_pastura2_nombre'                          => '',
                        'establecimiento_codigo'                        => '',
                        'establecimiento_nombre'                        => '',
                        'establecimiento_seccion_codigo'                => '',
                        'establecimiento_seccion_nombre'                => '',
                        'establecimiento_potrero_codigo'                => '',
                        'establecimiento_potrero_nombre'                => '',
                        'establecimiento_potrero_hectarea'              => '',
                        'establecimiento_potrero_capacidad'             => '',
                        'establecimiento_potrero_observacion'           => '',
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