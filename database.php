<?php

class DB
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("sqlite:database.sqlite");
    }

    public function query(string $query, $class = null, array $params = [])
    {
        $prepare = $this->db->prepare($query);

        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        $prepare->execute($params);

        return $prepare;
    }

    public function insertFromObject(string $table, object $obj)
    {
        // Converte o objeto em array (excluindo propriedades nulas como id)
        $data = array_filter(get_object_vars($obj), fn($val, $key) => $key !== 'id' && $val !== null, ARRAY_FILTER_USE_BOTH);

        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($key) => ":$key", array_keys($data)));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $prepare = $this->db->prepare($query);

        if ($prepare->execute($data)) {
            return $this->db->lastInsertId(); // retorna o ID gerado
        }

        return false;
    }

    public function updateFromObject(string $table, object $obj)
    {
        $data = get_object_vars($obj);

        if (empty($data['id'])) {
            throw new InvalidArgumentException('ID é obrigatório para update.');
        }

        $id = $data['id'];
        unset($data['id']);

        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        $query = "UPDATE $table SET $set WHERE id = :id";
        // $stmt = $this->db->prepare($query);

        $data['id'] = $id;

        return $this->db->prepare($query)->execute($data);
    }
}

$database = new DB();
