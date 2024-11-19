<?php

namespace app\Models;

class Music {
    private $id;
    private $music;
    private $id_user;
    private $title;
    private $artista;
    private $categoria;
    private $capa;

    public function setId($id) {
        $this->id = $id;
    }

    public function setMusic($music) {
        $this->music = $music;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setArtista($artista) {
        $this->artista = $artista;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setCapa($capa) {
        $this->capa = $capa;
    }


    public function getId() {
        return $this->id;
    }

    public function getMusic() {
        return $this->music;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getArtista() {
        return $this->artista;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getCapa() {
        return $this->capa;
    }
}
