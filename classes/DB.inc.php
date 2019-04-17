<?php
class DB
{
    protected $Connection;
    public function __construct($host, $dbName, $login, $password)
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $this->Connection = new PDO("mysql:host={$host};dbname={$dbName}", $login, $password, $options);
    }
    public function Delete($table, $indexField, $value)
    {
        $sql = "DELETE FROM {$table} WHERE {$indexField} = :val";
        $st = $this->Connection->prepare($sql);
        $st->bindValue('val', $value);
        $st->execute();
    }
    public function Insert($table, $row)
    {
        $fieldsList = array_keys($row);
        $valuesList = array_values($row);
        $fieldsString = implode(',', $fieldsList);
        $params = [];
        for($i = 0; $i < count($fieldsList); $i++)
            array_push($params, '?');
        $paramsString = implode(',', $params);
        $sql = "INSERT INTO {$table} ({$fieldsString}) VALUES($paramsString)";
        $st = $this->Connection->prepare($sql);
        $st->execute($valuesList);
    }
    public function Update($table, $indexField, $indexValue, $row)
    {
        $fieldsList = array_keys($row);
        $valuesList = array_values($row);
        $arr = [];
        for($i = 0; $i < count($fieldsList); $i++)
        {
            array_push($arr, "{$fieldsList[$i]} = ?");
        }
        $setString = implode(",", $arr);
        $sql = "UPDATE {$table} SET {$setString} WHERE {$indexField} = ?";
        echo $sql;
        $st = $this->Connection->prepare($sql);
        array_push($valuesList, $indexValue);
        $st->execute($valuesList);
    }
    public function Select($table, $row = null, $fields = "*")
    {
        if (!empty($row)) {
            $fieldsList = array_keys($row);
            $valuesList = array_values($row);
            $arr = [];
            for ($i = 0; $i < count($fieldsList); $i++) {
                array_push($arr, "{$fieldsList[$i]} = ?");
            }
            $whereString = "WHERE " . implode(" AND ", $arr);
        } else
            $whereString = "";
        $sql = "SELECT {$fields} FROM {$table} {$whereString}";
        $st = $this->Connection->prepare($sql);
        $st->execute($valuesList);
        return $st->fetchAll();
    }
}