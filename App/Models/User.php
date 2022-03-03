<?php

namespace App\Models;

/**
 * Classe Responsável pelas requisições de usuários
 * 
 * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
 * @since 2022-03-02
 */
class User
{
    private static $table = 'users';

    /**
     * Método que retorna os dados de um usuário específico
     * 
     * @param int $id ID do usuário
     * @return object
     * 
     * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
     * @since 2022-03-02
     */
    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    /**
     * Método que retorna os dados de todos os usuários
     * 
     * @param int $id ID do usuário
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
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    /**
     * Método que insere usuários
     * 
     * @param array $data Dados do usuário
     * @return object
     * 
     * @author Gabriel Quintino <gabrielv.quintino@gmail.com>
     * @since 2022-03-02
     */
    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (name, token, email, phone, cpf ) VALUES (:na, :to, :em, :ph, :cp )';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':na', $data['name']);
        $stmt->bindValue(':to', $data['token']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':ph', $data['phone']);
        $stmt->bindValue(':cp', $data['cpf']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }
}