<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Equipamento
{
    public $tablename = 'equipamentos';

    /**
     * Identificador Unico
     * @var integer
      */
    public $id;

    /**
     * Nome de identificação do equipamento
     * @var string
     */
    public $nome;

    /**
     * Sufixo IP do equipamento
     * @var string
     */
    public $sufixo_ip;

    /**
     * Código interno unico do condominio
     * @var string
     */
    public $id_condominio;

    /**
     * Login do equipamento
     * @var string
     */
    public $login;

    /**
     * Senha do equipamento
     * @var string
     */
    public $senha;

    /**
     * Metodo responsavel por cadastrar nova pessoa no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //definir ID
        $obDatabase = new Database($this->tablename);
        //Inserir pessoa no banco
        $this->id = $obDatabase->insert([
                                'nome'  => $this->nome,
                                'sufixo_ip'  => $this->sufixo_ip,
                                'id_condominio'   => $this->id_condominio,
                                'login' => $this->login,
                                'senha' => $this->senha
                                ]);

        //Retornar sucesso
        return true;
    }

    public function atualizar()
    {
        return (new Database($this->tablename))->update('id = '.$this->id, [
                                                        'nome'  => $this->nome,
                                                        'sufixo_ip'  => $this->sufixo_ip,
                                                        'id_condominio'   => $this->id_condominio,
                                                        'login' => $this->login,
                                                        'senha' => $this->senha
                                                        ]);
    }

    public function excluir()
    {
        return (new Database($this->tablename))->delete('id = '.$this->id);
    }

    public static function getEquipamentos($innerJoin = null, $where = null, $order = null, $limit = null, $table = 'equipamentos')
    {
        return (new Database($table))->select($innerJoin, $where, $order, $limit)
                                     ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getEquipamento($id, $table = 'equipamentos')
    {
        return (new Database($table))->select(null, 'id = '.$id)
                                     ->fetchObject(self::class);
    }

}
