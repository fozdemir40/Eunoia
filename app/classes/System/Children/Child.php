<?php namespace System\Children;


class Child
{
    public $id, $parent_id, $child_name, $birthdate, $development;

    static public function add(Child $child, \PDO $db): bool
    {
        $query = "INSERT INTO child (name, birthdate, development, parent_id) 
                    VALUES (:child_name, :birthdate, :development, :parent_id)";
        $stmt = $db->prepare($query);
        return $stmt->execute([
           ':child_name' => $child->child_name,
           ':birthdate' => $child->birthdate,
            ':development' => $child->development,
            ':parent_id' => $child->parent_id
        ]);
    }

    /**
     * @param \PDO $db
     * @return bool
     */
    public function delete(\PDO $db): bool
    {
        $query = "DELETE FROM child
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([':id' => $this->id]);
    }

    /**
     * @param \PDO $db
     * @return bool
     */
    public function update(\PDO $db): bool
    {
        $query = "UPDATE child
                  SET name = :name, birthdate = :birthdate, development = :development
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':name' => $this->child_name,
            ':birthdate' => $this->birthdate,
            ':development' => $this->development,
            ':id' => $this->id
        ]);
    }

    /**
     * @param int $id
     * @param \PDO $db
     * @return Child
     * @throws \Exception
     */
    static public function getByParenId(int $id, \PDO $db): array
    {

        $query = "SELECT * FROM child WHERE parent_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS,"System\\Children\\Child");

        return $result;

    }



    /**
     * @param int $id
     * @param \PDO $db
     * @return Child
     * @throws \Exception
     */
    static public function getById(int $id, \PDO $db): Child
    {
        $statement = $db->prepare("SELECT * FROM child WHERE id = :id");
        $statement->execute([':id' => $id]);

        if (($child = $statement->fetchObject("System\\Children\\Child")) === false) {
            throw new \Exception("Child ID {$id} is not available in the database");
        }

        return $child;
    }

}