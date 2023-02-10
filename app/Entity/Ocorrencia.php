<?php

    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;

    class Ocorrencia{
        
        public $tablename = 'ocorrencias';

        /**
         * Identificador Unico 
         * @var integer 
          */
        public $id;
        
        /**
         * Nome da pessoa 
         * @var string
         */        
        public $condominio;

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
                                    'condominio'  => $this->condominio,
                                    'ocorrencia'  => $this->ocorrencia,
                                    'data_inicio'  => $this->data_inicio,
                                    'data_fim'  => $this->data_fim,
                                    'status' => $this->status
                                    ]);

            //Retornar sucesso
            return true;
        }

        public function atualizar(){
            return (new Database($this->tablename))->update('id = '.$this->id,[
                                                            'condominio'  => $this->condominio,
                                                            'ocorrencia'  => $this->ocorrencia,
                                                            'data_inicio'  => $this->data_inicio,
                                                            'data_fim'  => $this->data_fim,
                                                            'status' => $this->status
                                                            ]);
        }

        public function excluir(){
            return (new Database($this->tablename))->delete('id = '.$this->id);
        }

        public static function getOcorrencias($where = null, $order = null, $limit = null, $table = 'ocorrencias'){
            return (new Database($table))->select($where,$order,$limit)
                                             ->fetchAll(PDO::FETCH_CLASS,self::class);
        }

        public static function getQtdOcorrencias($where = null, $table = 'ocorrencias'){
            return (new Database($table))->select($where,null,null,'COUNT(*) as qtd')
                                          ->fetchObject()
                                          ->qtd;
        }
        
        public static function getOcorrencia($id, $table = 'ocorrencias'){
            return (new Database($table))->select('id = '.$id)
                                             ->fetchObject(self::class);
        }

    }

?>