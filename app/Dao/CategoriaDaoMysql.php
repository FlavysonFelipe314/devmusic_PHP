<?php

namespace app\Dao;

use PDO;
use app\Interfaces\CategoriaDaoInterface;
use app\Models\Categoria;

class CategoriaDaoMysql implements CategoriaDaoInterface{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function create(Categoria $categoria)
    {
        $sql = $this->pdo->prepare("INSERT INTO categorias (categoria) VALUES (:categoria)");
        $sql->bindValue(":categoria", $categoria->getCategoria());
        $sql->execute();
    }

    public function update(Categoria $categoria){}

    public function findAll()
    {
        $sql = $this->pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                
            $array = [];
            foreach($data as $item){
                $Categoria = new Categoria;
                $Categoria->setId($item["id"]);
                $Categoria->setCategoria($item["categoria"]);
                $array[] = $Categoria;
            }

            return $array;
            exit;
        }

        return false;
    }

    public function findByid($id){}

    public function delete($id){}
}