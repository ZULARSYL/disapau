<?php

class Login_model
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUser($username, $password)
    {
        $this->db->query("SELECT * FROM user WHERE username = :username AND hash_password = :password");
        $this->db->bind('username', $username);
        $this->db->bind('password', md5($password));
        $this->db->execute();
        return $this->db->single();
    }
}
