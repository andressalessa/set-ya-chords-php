<?php

class Database
{
    private $db;

    public function __construct()
    {
        // prod
        // $this->db = new PDO("sqlite:/home/playchords/data/database.sqlite");
        
        // local
        $this->db = new PDO("sqlite:database.sqlite");
        // $this->db = new PDO($this->getDsn($config));
    }

    private function getDsn($config)
    {
        $driver = $config['driver'];
        unset($config['driver']);

        $dsn = $driver . ':' . http_build_query($config, '', ';');

        if ($driver == 'sqlite') {
            $dsn = $driver . ':' . $config['database'];
        }

        return $dsn;
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

        $data = array_filter($data, fn($val, $key) => $val !== null, ARRAY_FILTER_USE_BOTH);
        
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        $query = "UPDATE $table SET $set WHERE id = :id";

        $data['id'] = $id;

        return $this->db->prepare($query)->execute($data);
    }

    public function deleteFromObject(string $table, object $obj)
    {
        if (empty($obj->id)) {
            throw new InvalidArgumentException('ID é obrigatório para delete.');
        }

        return $this->db->prepare("DELETE FROM $table WHERE id = :id")->execute(['id' => $obj->id]);
    }
}

$database = new Database();
