<?php

namespace App\Models;

class Transaction
{
    private static $table = 'transactions';

    /**
     * Método que retorna os dados de uma transação específica
     * 
     * @param string $code código da transação
     * @return object
     * 
     * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
     * @since 2022-03-02
     */
    public static function select(string $code)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE code = :code';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhuma transação encontrada!");
        }
    }

    /**
     * Método que retorna os dados de todas as transações
     * 
     * @return object
     * 
     * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
     * @since 2022-03-02
     */
    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhuma transação encontrada!");
        }
    }

    /**
     * Método que insere uma transação
     * 
     * @param array $data Dados da transação
     * 
     * @return object
     * 
     * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
     * @since 2022-03-02
     */
    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (id_fk_user, code, name, value) VALUES (:id, :co, :na, :va)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data['userId']);
        $stmt->bindValue(':co', $data['code']);
        $stmt->bindValue(':na', $data['name']);
        $stmt->bindValue(':va', $data['value']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Investimento feito com sucesso!';
        } else {
            throw new \Exception("Falha ao realizar a transação!");
        }
    }
}