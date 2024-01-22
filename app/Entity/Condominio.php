<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Condominio
{
    public $tablename = 'condominios';

    /**
     * Identificador Unico
     * @var integer
      */
    public $id;

    /**
     * Nome da pessoa
     * @var string
     */
    public $nome_condominio;

    /**
     * Código interno unico do condominio
     * @var string
     */
    public $cod_moni;

    /**
     * Código interno unico do condominio
     * @var string
     */
    public $cod_app;

    /**
     * Faixa de IP do condominio
     * @var string
     */
    public $faixa_ip;

    /**
     * Tipo do serviço de atendimento prestado ao condominio
     * @var string
     */
    public $tipoatendimento;

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
                                'nome_condominio'  => $this->nome_condominio,
                                'cod_moni'  => $this->cod_moni,
                                'cod_app'   => $this->cod_app,
                                'faixa_ip' => $this->faixa_ip,
                                'tipoatendimento' => $this->tipoatendimento
                                ]);

        //Retornar sucesso
        return true;
    }

    public function atualizar()
    {
        return (new Database($this->tablename))->update('id = '.$this->id, [
                                                        'nome_condominio'  => $this->nome_condominio,
                                                        'cod_moni'  => $this->cod_moni,
                                                        'cod_app'   => $this->cod_app,
                                                        'faixa_ip' => $this->faixa_ip,
                                                        'tipoatendimento' => $this->tipoatendimento
                                                        ]);
    }

    public function excluir()
    {
        return (new Database($this->tablename))->delete('id = '.$this->id);
    }

    public static function getCondominios($innerJoin = null, $where = null, $order = null, $limit = null, $table = 'condominios')
    {
        return (new Database($table))->select($innerJoin, $where, $order, $limit)
                                     ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getCondominio($id, $table = 'condominios')
    {
        return (new Database($table))->select(null, 'id = '.$id)
                                     ->fetchObject(self::class);
    }

}
