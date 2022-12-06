<?php

namespace App\data\controllers;

use App\data\controllers\interfaces\ICrud;
use App\data\models\PizzaModel;
use App\domain\AuthToken;
use Rakit\Validation\Validator;

class PizzaController implements ICrud
{
    private $model;

    public function __construct()
    {
        $this->model = new PizzaModel();
    }

    /**
     * @param $id
     * @return void
     */
    public function read($id = null)
    {
        if ($id == null) {
            $data = $this->model->all();
        }else {
            $data = $this->model->findById($id);
        }

        echo $data == null ? "data does not exist" : json_encode($data);
    }

    /**
     * @return bool|int|void
     */
    public function create()
    {
        $validation = (new Validator())->make($_POST, [
            'name' => 'required',
            'pizza_type_id'=> 'required|numeric',
            'quantity' => 'required|numeric|min:1'
        ]);
        $validation->validate();

        if ($validation->fails()){
            print_r($validation->errors()->firstOfAll());
            return http_response_code(400);
        }

        $created = $this->model->addPizza($_POST['name'], $_POST['pizza_type_id'], $_POST['quantity']);

        $created ? http_response_code(200) : http_response_code(400);
    }

    /**
     * @param $id
     * @return bool|int|void
     */
    public function update($id)
    {
        $pizza = $this->model->findById($id);

        if (!$pizza) {
            print_r("data does not exist");
            return http_response_code(404);
        }

        $validation = (new Validator())->make($_POST, [
            'name' => 'max:200',
            'pizza_type_id'=> 'numeric',
            'quantity' => 'numeric|min:1'
        ]);
        $validation->validate();

        if ($validation->fails()){
            print_r($validation->errors()->firstOfAll());
            return http_response_code(400);
        }

        $name = isset($_POST['name']) ? $_POST['name'] : $pizza['name'];
        $pizzaTypeId = isset($_POST['pizza_type_id']) ? $_POST['pizza_type_id'] : $pizza['pizza_type_id'];
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : $pizza['quantity'];

        $updated = $this->model->updatePizza($id, $name, $pizzaTypeId, $quantity);
        $updated ? http_response_code(200) : http_response_code(400);
    }

    /**
     * @param $id
     * @return bool|int
     */
    public function delete($id)
    {
        $pizza = $this->model->findById($id);
        if (!$pizza) {
            print_r("data does not exist");
            return http_response_code(404);
        }

        $deleted = $this->model->deletePizza($id);

        return $deleted ? http_response_code(200) : http_response_code(400);
    }
}