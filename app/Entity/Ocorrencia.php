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

    }

?>