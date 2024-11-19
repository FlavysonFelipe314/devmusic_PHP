<?php

namespace app\Models;

class Usuario
{
    private $id;
    private $email;
    private $usuario;
    private $password;
    private $token;
    private $avatar;
    private $bio;
    private $created_at;

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
