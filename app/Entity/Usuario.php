<?php

    namespace App\Entity;

    use App\Db\Database;
    use \PDO;

    class Usuario{

        public $tablename = 'usuarios';

        public $id;

        public $nome;

        public $senha;

        public $nivelacesso;

        public function cadastrar(){
            $obDatabase = new Database($this->tablename);

            $this->id = $obDatabase->insert([
                'nome' => $this->nome,
                'senha' => $this->senha,
                'nivelacesso' => $this->nivelacesso
            ]);

            return true;
        }

        public function atualizar(){
            return (new Database($this->tablename))->update('id = '.$this->id,[
                                                            'nome'  => $this->nome,
                                                            'senha'  => $this->senha,
                                                            'nivelacesso'  => $this->nivelacesso,
                                                            ]);
        }

        public function excluir(){
            return (new Database($this->tablename))->delete('id = '.$this->id);
        }
        
        public static function getUsuarioPorId($id){
            return (new Database('usuarios'))->select(null,'id = "'.$id.'"')->fetchObject(self::class);
        }

        public static function getUsuarioPorNome($nome){
            return (new Database('usuarios'))->select(null,'nome = "'.$nome.'"')->fetchObject(self::class);
        }

        public static function getUsuarios($innerJoin = null, $where = null, $order = null, $limit = null, $table = 'usuarios'){
            return (new Database($table))->select($innerJoin,$where,$order,$limit)
                                         ->fetchAll(PDO::FETCH_CLASS,self::class);
        }

    }

?>