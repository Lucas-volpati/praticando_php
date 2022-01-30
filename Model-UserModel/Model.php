<?php

namespace Source\Models;

use Source\Database\Connect;
use stdClass;

abstract class Model {

    /** @var object|null */
    protected $data;

    /** @var \PDOException|null */
    protected $fail;

    /** @var string|null */
    protected $message;

    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    public function data():?object {
        return $this->data;
    }

    public function fail() :?\PDOException {
        return $this->fail;
    }

    public function message() :?string {
        return $this->message;
    }

    protected function create(string $entity, array $data) :?int {

        try {

            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

            $stmt = Connect::getInstance()->prepare("INSERT INTO {$entity} ({$columns}) VALUES ({$values})");
            $stmt->execute($this->filter($data));

            return Connect::getInstance()->lastInsertId();

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function read(string $select, $params = null) :?\PDOStatement { //param=$id
        try {
            $stmt = Connect::getInstance()->prepare($select);//SELECT * FROM users WHERE email = :email

            if ($params) {
                parse_str($params, $params);// $params = ["id"] => "1";

                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }
            $stmt->execute();
            return $stmt;

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function update(string $entity, array $data, string $terms, string $params) :?int {
        try {
            $dataSet = [];
            foreach ($data as $bind => $value) {
                $dataSet[] = "{$bind} = :{$bind}";
            }

            $dataSet = implode(", ", $dataSet);
            parse_str($params, $params);


            $stmt = Connect::getInstance()->prepare("UPDATE {$entity} SET {$dataSet} WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));
            return ($stmt->rowCount() ?? 1);

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function delete(string $entity, string $terms, string $params) :?int {

        try {
            
            $stmt = Connect::getInstance()->prepare("DELETE FROM {$entity} WHERE {$terms}");
            parse_str($params, $params);

            $stmt->execute($params);
            return ($stmt->rowCount() ?? 1);

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }

    }

    protected function safe() :?array {//método que assegura a não manipulação dos campos não permitidos na tabela (id, created_at e updated_at).
        $safe = (array)$this->data;
        foreach (static::$safe as $unset) {
            unset($safe[$unset]);
        }
        return $safe;
    }

    private function filter(array $data) :?array {//Método que filtra os dados contra inserção de tags html, script ou código php.
        $filter = [];

        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }
        return $filter;
    }

}