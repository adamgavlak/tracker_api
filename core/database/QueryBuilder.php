<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 12:20
 */

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected $dbh;   // Database handler

    public function __construct($pdo)
    {
        $this->dbh = $pdo;
    }

    public function all($table)
    {
        $sth = $this->dbh->prepare("select * from {$table};");

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $params)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s);',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
        } catch (\Exception $e) {
            //
        }
    }

    public function findBy($table, $column, $value)
    {
        $sql = sprintf(
            'select * from %s where %s=%s;',
            $table,
            $column,
            ':' . $column
        );

        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':' . $column, $value);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_OBJ);
    }
}