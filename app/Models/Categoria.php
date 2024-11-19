<?php

namespace app\Models;

class Categoria {
    private $id;
    private $categoria;

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


    public function getId() {
        return $this->id;
    }

    public function getCategoria() {
        return $this->categoria;
    }

}
