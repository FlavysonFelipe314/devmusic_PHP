<?php

namespace app\Interfaces;

use app\Models\Music;

interface MusicDaoInterface{
    public function create(Music $music);
    public function update(Music $music);
    public function findAll();
    public function findAllArtistas();
    public function findByid($id);
    public function findByName($name);
    public function findByidUser($id_user);
    public function delete($id);
}
