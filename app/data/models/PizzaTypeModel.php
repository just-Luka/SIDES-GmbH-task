<?php

namespace App\data\models;

class PizzaTypeModel extends BaseModel
{
    private $table = 'pizza_types';

    /**
     * @return array|mixed|void
     */
    public function all()
    {
        $sql = 'SELECT * FROM '.$this->table;
        $query = $this->db()->query($sql);

        if ($query->num_rows > 0) {
            return $query->fetch_all(MYSQLI_ASSOC);
        } else {
            http_response_code(404);
        }
    }

    /**
     * @param $id
     * @return array|false|void|null
     */
    public function findById($id)
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $query = $this->db()->query($sql);

        if ($query->num_rows == 1) {
            return $query->fetch_assoc();
        } else {
            http_response_code(404);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function addPizzaType($name)
    {
        $query = 'INSERT INTO pizza_types (type)
                VALUES ("'.$name.'")';

        return $this->isQuerySuccess($query);
    }
}