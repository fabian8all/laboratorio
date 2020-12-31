<?php

	require_once('DBConnection.class.php');

	Class Alerts extends DBConnection {

        public function getLab()
        {
            $sql = "
                SELECT 
                    SUM( 
                        CASE
                            WHEN S.estado = 0 THEN 1 ELSE 0
                        END
                    ) as pendienteMuestra,
                    SUM( 
                        CASE
                            WHEN S.estado = 1 THEN 1 ELSE 0
                        END
                    ) as enProceso,
                    SUM( 
                        CASE
                            WHEN S.estado = 2 THEN 1 ELSE 0
                        END
                    ) as pendientePago 
                FROM solicitudes S
                WHERE 
                    S.cancelado IS NULL; 
            ";
            $alerts = self::query_single_object($sql);
            return $alerts;
        }
        public function getClient($id)
        {
            $sql = "
                SELECT 
                    SUM( 
                        CASE
                            WHEN S.estado = 0 THEN 1 ELSE 0
                        END
                    ) as pendienteMuestra,
                    SUM( 
                        CASE
                            WHEN S.estado = 1 THEN 1 ELSE 0
                        END
                    ) as enProceso
                FROM solicitudes S
                    INNER JOIN pacientes P
                        ON S.id_paciente = P.id
                WHERE 
                    S.cancelado IS NULL
                    AND P.referente = $id; 
            ";
            $alerts = self::query_single_object($sql);
            $sqlCorte = "
                SELECT 
                    DATE_FORMAT(fechaFin, '%Y-%m-%d') as fechaCorte, 
                    pagado
                FROM cortes 
                WHERE idCliente = $id
                ORDER BY id DESC
                LIMIT 1
            ";
            $corte = self::query_single_object($sqlCorte);
            $alerts->fechaCorte = $corte->fechaCorte;
            $alerts->pagado = $corte->pagado;
            return $alerts;
        }
    }


?>
