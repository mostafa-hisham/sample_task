<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 03/02/2017
 * Time: 09:57 Õ
 */
class Database extends PDO
{
    /**
     * @param $DB_TYPE
     * @param $DB_HOST
     * @param $DB_PORT
     * @param $DB_NAME
     * @param $DB_USER
     * @param $DB_PASS
     * Create PDO instance
     */
    public function __construct($DB_TYPE, $DB_HOST, $DB_PORT, $DB_NAME, $DB_USER, $DB_PASS)
    {
        $port_config_str = '';
        if (isset($DB_PORT) && $DB_PORT != '') {
            $port_config_str = ';port=' . $DB_PORT;
        }
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . $port_config_str . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
    }

    /**
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     * execute select query
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $query = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $query->bindValue("$key", $value);
        }

        $query->execute();
        return $query->fetchAll($fetchMode);
    }

    /**
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     * execute select returns one record
     */
    public function fetch($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $query = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $query->bindValue("$key", $value);
        }

        $query->execute();
        return $query->fetch($fetchMode);
    }

    /**
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * insert data in table
     */
    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $query = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $query->execute();
    }

    /**
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     * update data in table record based on where condition
     */
    public function update($table, $data, $where)
    {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $query = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value);
        }
        $query->execute();
    }

    /**
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     * delete from table based on condition
     */
    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}