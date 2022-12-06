<?php

namespace App\data\models;

use App\domain\AuthToken;

class PizzaModel extends BaseModel
{
    private $table = 'pizza';
    public $userId;

    public function __construct()
    {
        $this->userId = (new AuthToken())->decode(isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null);
    }

    /**
     * @return array|mixed|void
     */
    public function all()
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE user_id='.$this->userId;
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
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id.' AND user_id='.$this->userId;
        $query = $this->db()->query($sql);

        if ($query->num_rows == 1) {
            return $query->fetch_assoc();
        } else {
            http_response_code(404);
        }
    }

    /**
     * @param $name
     * @param $pizzaTypeId
     * @param $quantity
     * @return bool
     */
    public function addPizza($name, $pizzaTypeId, $quantity)
    {
        $query = 'INSERT INTO pizza (user_id, name, piza_type_id, quantity)
                VALUES ("'.$this->userId.'", "'.$name.'", "'.$pizzaTypeId.'", "'.$quantity.'")';

        return $this->isQuerySuccess($query);
    }

    /**
     * @param $id
     * @param $name
     * @param $pizzaTypeId
     * @param $quantity
     * @return bool
     */
    public function updatePizza($id, $name, $pizzaTypeId, $quantity)
    {
        $query = 'UPDATE pizza SET name="'.$name.'", piza_type_id="'.$pizzaTypeId.'", quantity="'.$quantity.'" WHERE id='.$id.' AND user_id='.$this->userId;

        return $this->isQuerySuccess($query);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePizza($id)
    {
        $query = 'DELETE FROM pizza WHERE id='.$id.' AND user_id='.$this->userId;

        return $this->isQuerySuccess($query);
    }
}