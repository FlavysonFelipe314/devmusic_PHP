<?php

namespace app\Interfaces;

use app\Models\Usuario;

interface UsuarioDaoInterface{
    public function create(Usuario $user);
    public function findAll();
    public function findByName($name);
    public function findByEmail($email);
    public function findByToken($token);
    public function update(Usuario $user);
    public function delete($id);
}
