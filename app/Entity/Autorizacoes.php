<?php

    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;

    class Autorizacoes{
        
        private $tablename = 'autorizacoes';

        /**
         * Identificador Unico 
         * @var integer 
          */
        public $id;
        
        /**
         * ID do Condominio 
         * @var int
         */        
        public $id_condominio;
        
        /**
         * Nome do condominio
         * @var string
         */        
        public $condominio;

        /**
         * E-mail 
         * @var string 
         */
        public $autorizacao;

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
                                    'condominio'  => $this->condominio,
                                    'autorizacao'  => $this->autorizacao,
                                    'criado_por'  => $_SESSION['usuario']['id'],
                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                    'data_inicio'  => $this->data_inicio,
                                    'data_fim'  => $this->data_fim
                                    ]);
            //Retornar sucesso
            return true;
        }

        public function atualizar(){
            return (new Database($this->tablename))->update('id = '.$this->id,[
                                                    'id_condominio'  => $this->id_condominio,
                                                    'condominio'  => $this->condominio,
                                                    'autorizacao'  => $this->autorizacao,
                                                    'modificado_por'  => $_SESSION['usuario']['id'],
                                                    'data_inicio'  => $this->data_inicio,
                                                    'data_fim'  => $this->data_fim
                                                    ]);
        }



        public function excluir(){
            return (new Database($this->tablename))->delete('id = '.$this->id);
        }

        public static function getAutorizacoes($innerJoin = null, $where = null, $order = null, $limit = null, $fields = '*', $table = 'autorizacoes'){
            return (new Database($table.' t1'))->select($innerJoin,$where,$order,$limit,$fields)
                                             ->fetchAll(PDO::FETCH_CLASS,self::class);
        }

        public static function getQtdAutorizacoes($where = null, $table = 'autorizacoes'){
            return (new Database($table))->select(null,$where,null,null,'COUNT(*) as qtd')
                                          ->fetchObject()
                                          ->qtd;
        }
        
        public static function getAutorizacao($id, $table = 'autorizacoes'){
            return (new Database($table))->select(null,'id = '.$id)
                                             ->fetchObject(self::class);
        }

    }

?>