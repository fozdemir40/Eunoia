<?php namespace System\Children;


class Child
{
    public $child_id, $parent_id, $child_name, $birthdate, $development;

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

}