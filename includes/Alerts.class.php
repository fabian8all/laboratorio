<?php

	require_once('../clases/DBConnection.class.php');

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

        public function getDivAlerts(){
            if ($_SESSION['perfil']==2 || $_SESSION['perfil']==3){
                $alerts = $this->getClient($_SESSION['id']);
                $divAlerts = '
                    <div class="col-lg-12">
                        <label>Estatus de las ordenes:</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="resultados.php#nav-pendienteMuestra">
                            <label style="display: inline-block">Pendientes de muestra</label>
                            <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrders">'.$alerts->pendienteMuestra.'</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="resultados.php#nav-enProceso">
                            <label style="display: inline-block">En proceso</label>
                            <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrdersPre">'.$alerts->enProceso.'</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="cortesCliente.php">
                            <label style="display: inline-block">Corte: '.$alerts->fechaCorte.'</label>
                            <span style="display: inline-block" class="badge badge-'.(($alerts->pagado == 1)?'success':'warning').' badge-counter" id="numOrdersFin">'.(($alerts->pagado == 1)?'PAGADO':'PENDIENTE').'</span>
                        </a>
                    </div>
                
                ';
            }else{
                $alerts = $this->getLab();
                $divAlerts = '
                    <div class="col-lg-12">
                        <label>Estatus de las ordenes:</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="resultados.php#nav-pendienteMuestra">
                            <label style="display: inline-block">Pendientes de muestra</label>
                            <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrders">'.$alerts->pendienteMuestra.'</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="resultados.php#nav-enProceso">
                            <label style="display: inline-block">En proceso</label>
                            <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrdersPre">'.$alerts->enProceso.'</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <a href="resultados.php#nav-pendientePago">
                            <label style="display: inline-block">Pendientes de pago</label>
                            <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrdersFin">'.$alerts->pendientePago.'</span>
                        </a>
                    </div>
                ';
                $alertsTotal = $alerts->pendienteMuestra + $alerts->enProceso + $alerts->pendientePago;
                $divAlertsSm = '
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Estatus
                    <span class="btn btn-danger btn-sm">'.$alertsTotal.'</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="resultados.php#nav-pendienteMuestra" class="dropdown-item">Pendiente de muestra <span class="btn btn-danger btn-sm">'.$alerts->pendienteMuestra.'</span></a>
                    <a href="resultados.php#nav-enProceso" class="dropdown-item">En proceso <span class="btn btn-danger btn-sm">'.$alerts->enProceso.'</span></a>
                    <a href="resultados.php#nav-pendientePago" class="dropdown-item">Pendiente de pago <span class="btn btn-danger btn-sm">'.$alerts->pendientePago.'</span></a>
                    
                </div>
                ';
            }
            return array("lg"=>$divAlerts,"sm"=>$divAlertsSm);
        }
	}



?>
