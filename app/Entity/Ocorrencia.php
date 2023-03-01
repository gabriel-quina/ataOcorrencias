<?php

    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;

    class Ocorrencia{
        
        private $tablename = 'ocorrencias';

        /**
         * Identificador Unico 
         * @var integer 
          */
        public $id;
        
        /**
         * Nome da pessoa 
         * @var string
         */        
        public $id_condominio;

        /**
         * E-mail 
         * @var string 
         */
        public $ocorrencia;

        /**
         * Data de inicio
         * @var string 
         */
        public $data_inicio;

        /**
         * Data final
         * @var string 
         */
        public $data_fim;

        public $status;

        /**
         * Metodo responsavel por cadastrar nova pessoa no banco
         * @return boolean 
         */
        public function cadastrar(){
            //definir ID
            $obDatabase = new Database($this->tablename);
            //Inserir pessoa no banco
            $this->id = $obDatabase->insert([
                                    'id_condominio'  => $this->id_condominio,
                                    'ocorrencia'  => $this->ocorrencia,
                                    'criado_por'  => $_SESSION['usuario']['id'],
                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                    'data_inicio'  => $this->data_inicio,
                                    'data_fim'  => $this->data_fim,
                                    'status' => $this->status
                                    ]);

            //Retornar sucesso
            return true;
        }

        public function atualizar(){
            return (new Database($this->tablename))->update('id = '.$this->id,[
                                                    'id_condominio'  => $this->id_condominio,
                                                    'ocorrencia'  => $this->ocorrencia,
                                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                                    'data_inicio'  => $this->data_inicio,
                                                    'data_fim'  => $this->data_fim,
                                                    'status' => $this->status
                                                    ]);
        }



        public function excluir(){
            return (new Database($this->tablename))->delete('id = '.$this->id);
        }

        public static function ler($id, $usuario, $date){
            //definir ID
            $obDatabase = new Database('ocorrencias_lidas');
            //Inserir no banco
            $obDatabase->insert([
                        'id_ocorrencias'  => $id,
                        'id_usuario'  => $usuario,
                        'datetime'  => $date
                        ]);

            //Retornar sucesso
            return true;
        }
        
        public static function getOcorrenciasLidas($innerJoin = null, $where = null, $order = null, $limit = null, $fields = '*', $table = 'ocorrencias_lidas'){
            return (new Database($table))->select($innerJoin,$where,$order,$limit,$fields)
                                            ->fetchAll(PDO::FETCH_CLASS);
        }

        public static function getOcorrencias($innerJoin = null, $where = null, $order = null, $limit = null, $fields = '*', $table = 'ocorrencias'){
            return (new Database($table.' t1'))->select($innerJoin,$where,$order,$limit,$fields)
                                             ->fetchAll(PDO::FETCH_CLASS,self::class);
        }

        public static function getQtdOcorrencias($where = null, $table = 'ocorrencias'){
            return (new Database($table))->select(null,$where,null,null,'COUNT(*) as qtd')
                                          ->fetchObject()
                                          ->qtd;
        }
        
        public static function getOcorrencia($id, $table = 'ocorrencias'){
            return (new Database($table.' t1'))->select(
                                                        'INNER JOIN condominios t2 ON t1.id_condominio = t2.id',
                                                        't1.id = '.$id,
                                                        null,
                                                        null,
                                                        't1.*, t2.nome_condominio'
                                                        )
                                             ->fetchObject(self::class);
        }

        public static function convertNotifTime($notif_date, $gmt){

            /**
            * @ findNotifDate : Finds the Date Difference of a Notification
            * @ notif_date : The notification date
            * @ gmt : Your GMT
            **/
        
            //when notification was sent
            $sent_date = (strpos($notif_date, ' ') !== FALSE) ? strtotime($notif_date) : $notif_date; 
        
            $today = gmdate(strtotime($gmt." hours", time())); //current date
        
            //calculate and store the results
            $calc = $today - $sent_date;
            $calcDate = gmdate("d-m-y", $calc);
            $calcTime = gmdate("H:i:s", $calc); //Will always be correct
        
            //check if it isnt default date
        
            //Get How many days, months and years that has passed
            $date_passed = explode("-", $calcDate);
            $time_passed = explode(":", $calcTime);
        
            $days_passed = ($date_passed[0] != '01') ? intval($date_passed[0]) - 1 : NULL;
            $months_passed = ($date_passed[1] != '01') ? intval($date_passed[1]) - 1 : NULL;
            $years_passed = ($date_passed[2] != '70') ? intval($date_passed[2]) - 70 : NULL;
        
            $hours_passed = ($time_passed[0] != '00') ? intval($time_passed[0]) : NULL;
            $mins_passed = ($time_passed[1] != '00') ? intval($time_passed[1]) : NULL;
            $secs_passed = intval($time_passed[2]); 
        
           //Set up your Custom Text output here
            $s = ["segundo atrás", "segundos atrás"];
            $m = ["min", "seg atrás", "mins", "segundos atrás"];
            $h = ["hr", "min atrás", "hrs", "mins atrás"];
            $d = ["dia", "hr atrás", "dias", "hrs atrás"];
            $M = ["mês", "dia atrás", "meses", "dias atrás"];
            $y = ["anos", "mês atrás", "anos", "meses atrás"];
         
                if (!($days_passed) && !($months_passed) && !($years_passed)
                && !($hours_passed) && !($mins_passed)) {
        
                    $ret = ($secs_passed == 1) ? $secs_passed .' '. $s[0] : $secs_passed .' '. $s[1];
        
                }else if (!($days_passed) && !($months_passed) && !($years_passed)
                && !($hours_passed)) {
        
                    $retA = ($mins_passed == 1) ? $mins_passed .' '. $m[0] : $mins_passed .' '. $m[2];
                    $retB = ($secs_passed == 1) ?  $secs_passed .' '.$m[1] : $secs_passed .' '.$m[3];
        
                    $ret = $retA.'';
        
        
                }else if (!($days_passed) && !($months_passed) && !($years_passed)){
        
                    $retA = ($hours_passed == 1) ? $hours_passed .' '. $h[0] : $hours_passed .' '. $h[2];
                    $retB = ($mins_passed == 1) ?  $mins_passed .' '. $h[1] : $mins_passed .' '. $h[3];
        
                    $ret = $retA.'';	
        
                }else if (!($years_passed) && !($months_passed)) {
                    $retA = ($days_passed == 1) ? $days_passed .' '. $d[0] :  $days_passed .' '. $d[2];
                    $retB = ($hours_passed == 1) ? $hours_passed . ' '.$d[1] : $hours_passed . ' '.$d[3];
        
                    $ret = $retA.' '.$retB;
        
                }else if (!($years_passed)) {
        
                    $retA = ($months_passed == 1) ? $months_passed .' '. $M[0] : $months_passed .' '. $M[2];
                    $retB = ($days_passed == 1) ? $days_passed . ' '.$M[1] : $days_passed . ' '.$M[3];
        
                    $ret = $retA.' '.$retB;
                }else{
                    $retA = ($years_passed == 1) ? $years_passed .' '. $y[0] : $years_passed .' '. $y[2];
                    $retB = ($months_passed == 1) ? $months_passed . ' '.$y[1] : $months_passed . ' '.$y[3];
                    
                    $ret = $retA.' '.$retB;
                }
        
                if(strpos($ret, '-')!== FALSE){
                    $ret .= " ( TIME ERROR )-> Invalid Date Provided!";
                }
        
            return $ret;
        }

    }

?>