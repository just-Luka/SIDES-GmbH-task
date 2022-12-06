<?php

namespace App\data\controllers\interfaces;

interface ICrud
{
    public function create();
    public function read($id);
    public function update($id);
    public function delete($id);
}