<?php

namespace app\Dao;

use PDO;
use app\Interfaces\MusicDaoInterface;
use app\Models\Music;

class MusicDaoMysql implements MusicDaoInterface{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function create(Music $music)
    {
        $sql = $this->pdo->prepare("INSERT INTO musics
        (music, title, capa, artista, categoria, id_user) VALUES (:music, :title, :capa, :artista, :categoria, :id_user)");
        $sql->bindValue(":music", $music->getMusic());
        $sql->bindValue(":title", $music->getTitle());
        $sql->bindValue(":capa", $music->getCapa());
        $sql->bindValue(":artista", $music->getArtista());
        $sql->bindValue(":categoria", $music->getCategoria());
        $sql->bindValue(":id_user", $music->getIdUser());
        $sql->execute(); 
    }

    public function update(Music $music)
    {
        $sql = $this->pdo->prepare("UPDATE musics
        SET music = :music,
        SET title = :title,
        SET artista = :artista
        SET categoria = :categoria
        ");
        $sql->bindValue(":music", $music->getMusic());
        $sql->bindValue(":title", $music->getTitle());
        $sql->bindValue(":capa", $music->getCapa());
        $sql->bindValue(":artista", $music->getArtista());
        $sql->bindValue(":categoria", $music->getCategoria());
        $sql->execute(); 
    }
    
    public function findAll()
    {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM musics ORDER BY id DESC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $musics = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($musics as $item){
                $MusicModel = new Music; 
                $MusicModel->setId($item["id"]);
                $MusicModel->setTitle($item["title"]);
                $MusicModel->setMusic($item["music"]);
                $MusicModel->setCapa($item["capa"]);
                $MusicModel->setArtista($item["artista"]);
                $MusicModel->setCategoria($item["categoria"]);

                $array[] = $MusicModel; 
            }

            return $array;
            exit;
        }

        return false;
    }

    public function findAllArtistas()
    {
        $array = [];
        $sql = $this->pdo->prepare("SELECT * FROM musics
        GROUP BY artista
        ORDER BY id ASC
        LIMIT 10");
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($data as $item) {
                    $artista = new Music;
                    $artista->setId($item["id"]);
                    $artista->setArtista($item["artista"]);
                    $artista->setCapa($item["capa"]);
                    $artista->setCategoria($item["categoria"]);

                    $array[] = $artista;
            }
        }
    
        return $array;
    }
    
    public function findByid($id)
    {
        $array =  [];

        $sql = $this->pdo->prepare("SELECT * FROM musics
        WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $item = $sql->fetch(PDO::FETCH_ASSOC);
            
            $MusicModel = new Music; 
            $MusicModel->setId($item["id"]);
            $MusicModel->setTitle($item["title"]);
            $MusicModel->setMusic($item["music"]);
            $MusicModel->setCapa($item["capa"]);
            $MusicModel->setArtista($item["artista"]);
            $MusicModel->setCategoria($item["categoria"]);

            $array = $MusicModel; 

            return $array;
        }

        return false;   
    }

    public function findByidUser($id_user)
    {
        $array =  [];

        $sql = $this->pdo->prepare("SELECT * FROM musics
        WHERE id_user = :id_user");
        $sql->bindValue(":id_user", $id_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $musics = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($musics as $item){
                $MusicModel = new Music; 
                $MusicModel->setId($item["id"]);
                $MusicModel->setTitle($item["title"]);
                $MusicModel->setMusic($item["music"]);
                $MusicModel->setCapa($item["capa"]);
                $MusicModel->setArtista($item["artista"]);
                $MusicModel->setCategoria($item["categoria"]);

                $array[] = $MusicModel; 
            }

            return $array;
            exit;
        }

        return false;   
        exit;
    }
    
    public function findByName($name)
    {
        $array =  [];

        $sql = $this->pdo->prepare("SELECT * FROM musics
        WHERE title LIKE :query
           OR artista LIKE :query
           OR categoria LIKE :query");
    
        $sql->bindValue(":query", "%".$name."%");
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($data as $item){
                $MusicModel = new Music; 
                $MusicModel->setId($item["id"]);
                $MusicModel->setTitle($item["title"]);
                $MusicModel->setMusic($item["music"]);
                $MusicModel->setCapa($item["capa"]);
                $MusicModel->setArtista($item["artista"]);
                $MusicModel->setCategoria($item["categoria"]);

                $array[] = $MusicModel; 
            }


            return $array;
        }

        return false;   
    }
    
    public function delete($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM musics
        WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}