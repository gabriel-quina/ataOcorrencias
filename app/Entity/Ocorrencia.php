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
         * ID Condominio
         * @var string
         */      
        public $id_condominio;
        
        /**
         * Nome Condominio
         * @var string
         */        
        public $condominio;

        /**
         * Corpo do texto da ocorrencia
         * @var string 
         */
        public $ocorrencia;

        /**
         * Tipo da ocorrencia [Técnica, informativa] 
         * @var string 
         */
        public $tipo_ocorrencia;

        /**
         * Usuario que fez a criação
         * @var string 
         */
        public $criado_por;
        
        /**
         * Data de criação
         * @var string 
         */
        public $criado_em;

        /**
         * Usuario que fez a modificação
         * @var string 
         */
        public $modificado_por;

        /**
         * Data de modificação
         * @var string 
         */
        public $modificado_em;

        /**
         * Situação da Ocorrencia
         * @var string 
         */
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
                                    'id_condominio' => $this->id_condominio,
                                    'condominio'  => $this->condominio,
                                    'ocorrencia'  => $this->ocorrencia,
                                    'tipo_ocorrencia' => $this->tipo_ocorrencia,
                                    'criado_por'  => $_SESSION['usuario']['id'],
                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                    'status' => $this->status
                                    ]);

            //Retornar sucesso
            return true;
        }

        public function atualizar(){
            return (new Database($this->tablename))->update('id = '.$this->id,[
                                                    'id_condominio' => $this->id_condominio,
                                                    'condominio'  => $this->condominio,
                                                    'ocorrencia'  => $this->ocorrencia,
                                                    'tipo_ocorrencia' => $this->tipo_ocorrencia,
                                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                                    'status' => $this->status
                                                    ]);
        }

        public function excluir(){
            return (new Database($this->tablename))->delete('id = '.$this->id);
        }
        
        public static function ler($id, $usuario, $date){
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

        public static function resolver($id, $status){
            $obDatabase = new Database('ocorrencias');
            //Update no banco
            $obDatabase->update('id = '.$id,[
                        'status'  => $status
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
            return (new Database($table))->select(null,'id = '.$id)
                                             ->fetchObject(self::class);
        }

    }

?>