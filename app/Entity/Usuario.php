<?php

    namespace App\Entity;

    use App\Db\Database;
    use \PDO;

    class Usuario{

        public $id;

        public $nome;

        public $senha;

        public $nivelacesso;

        public function cadastrar(){
            $obDatabase = new Database('usuarios');

            $this->id = $obDatabase->insert([
                'nome' => $this->nome,
                'senha' => $this->senha,
                'nivelacesso' => $this->nivelacesso
            ]);

            return true;
        }

        public static function getUsuarioPorNome($nome){
            return (new Database('usuarios'))->select('nome = "'.$nome.'"')->fetchObject(self::class);
        }

    }



?>