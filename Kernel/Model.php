<?php

namespace Kernel;

use Kernel\Database;

class Model
{
    protected $table = '';
    protected $primaryKey = 'id';
    protected $orderBy = '';
    protected $limit = '';
    protected $timestamps = false;
    protected $database = null;

    public function __construct(?string $host = null, ?string  $dbName = null, ?string $username = null, ?string $password = null) {
        $this->database = Database::getInstance($host, $dbName, $username, $password);
    }

    /**
     * Get all records method
     * @return array
     */
    public function getAll(): array {
        $query = "select * from $this->table";

        $pdoQuery = $this->database->prepare($query);

        $pdoQuery->execute();

        return $pdoQuery->fetchAll();
    }

    /**
     * Find single or none by ID method
     * @param int $id
     * @return mixed
     */
    public function find(int $id) {
        $query = "select * from $this->table where $this->primaryKey = :id limit 1";

        $pdoQuery = $this->database->prepare($query);

        $pdoQuery->bindParam(':id', $id, \PDO::PARAM_INT);

        $pdoQuery->execute();

        return $pdoQuery->fetchObject('Kernel\Model');
    }

    /**
     * Storing data
     * @param array $data
     * @return null|string
     */
    public function save(array $data): ?string {
        if ($this->timestamps) {
            $now = date('Y-m-d H:i:s');
            $data['created_at'] = $now;
            $data['updated_at'] = $now;
        }

        $keys = array_keys($data);
        foreach ($data as $key => $value) {
            $data[":$key"] = $value;
            unset($data["$key"]);
        }

        $query = "INSERT INTO $this->table (".implode(", ", $keys).") ";
        $query .= "VALUES ( :".implode(", :", $keys).")";
        $statement = $this->database->prepare($query);

        if ($statement->execute($data)) {
            return $this->database->lastInsertId();
        }
        return null;
    }

    /**
     * Updating data
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool {

    }

    /**
     * Removing data
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {

    }


}