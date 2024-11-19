<?php

namespace app\Interfaces;

use app\Models\Categoria;

interface CategoriaDaoInterface{
    public function create(Categoria $categoria);
    public function update(Categoria $categoria);
    public function findAll();
    public function findByid($id);
    public function delete($id);
}
