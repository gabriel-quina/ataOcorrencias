<?php

    namespace App\Db;

    use \PDO;
    use \PDOException;
    use \Dotenv;

    class Database{

        private $table;

        private $connection;

        private $dotenv;

        public $errorDB;

        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();
        }

        private function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD']);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch( PDOException $e ){
                die('ERROR: '.$e->getCode().
                            '<p>'.$e->getMessage().'</p>');
            }
        }

        public function execute($query,$params = []){
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }catch( PDOException $e ){
                die('ERROR: '.$e->getCode().
                            '<p>'.$e->getMessage().'</p>');
            }
        }

        public function insert($values){
            // DADOS DA QUERY
            $fields = array_keys($values);
            $binds  = array_pad([],count($fields),'?');

            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

            $this->execute($query,array_values($values));

            return $this->connection->lastInsertId();
        }

        public function select($innerJoin = null, $where = null,  $order = null, $limit = null, $fields = '*'){
            $innerJoin = strlen($innerJoin) ? ' '.$innerJoin : '';
            $where = strlen($where) ? 'WHERE '.$where : '';            
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';
            
            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$innerJoin.' '.$where.' '.$order.' '.$limit;

            return $this->execute($query);
        }

        public function update($where,$values){

            $fields = array_keys($values);

            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

            $this->execute($query,array_values($values));

            return true;
        }

        public function delete($where){
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            $this->execute($query);

            return true;
        }

    }
?>