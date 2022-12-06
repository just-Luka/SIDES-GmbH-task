<?php

namespace App\data\controllers;

use App\data\controllers\interfaces\ICrud;
use App\data\models\PizzaModel;
use App\data\models\PizzaTypeModel;
use Rakit\Validation\Validator;

class PizzaTypeController implements ICrud
{
    private $model;

    public function __construct()
    {
        $this->model = new PizzaTypeModel();
    }

    /**
     * @return bool|int|void
     */
    public function create()
    {
        $validation = (new Validator())->make($_POST, [
            'name' => 'required|min:1',
        ]);
        $validation->validate();

        if ($validation->fails()){
            print_r($validation->errors()->firstOfAll());
            return http_response_code(400);
        }

        $created = $this->model->addPizzaType($_POST['name']);
        $created ? http_response_code(200) : http_response_code(400);
    }

    /**
     * @param $id
     * @return void
     */
    public function read($id)
    {
        if ($id == null) {
            $data = $this->model->all();
        }else {
            $data = $this->model->findById($id);
        }

        echo $data == null ? "data does not exist" : json_encode($data);
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}