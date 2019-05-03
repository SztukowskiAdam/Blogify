<?php

namespace Kernel;

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
            $data['createdAt'] = $now;
            $data['updatedAt'] = $now;
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

    /**
     * Selects rows where $key $statement $value
     * e.g. name = 'John'
     * or   age >= 18
     * @param string $key
     * @param string $statement
     * @param string $value
     * @return array
     */
    public function where(string $key, string $statement, string $value) {
        $query = "select * from $this->table where $key $statement :$key";

        $pdoQuery = $this->database->prepare($query);

        $pdoQuery->bindParam(":$key", $value);

        $pdoQuery->execute();

        return $pdoQuery->fetchAll();
    }

    /**
     * Multiple where statements
     * @param array $data
     * @return array
     */
    public function whereData(array $data): array {

        $query = '';
        $first = true;
        foreach ($data as $key => $value) {
            if ($first) {
                $query .= "select * from $this->table where $key = :$key";
                $first = false;
            } else {
                $query .= " and $key = :$key";
            }
        }
        $pdoQuery = $this->database->prepare($query);

        foreach ($data as $key => $value) {
            $pdoQuery->bindParam(":$key", $value);
        }

        $pdoQuery->execute();
        return $pdoQuery->fetchAll();
    }


}