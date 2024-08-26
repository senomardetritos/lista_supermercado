<?php

include 'helpers/db.php';

class Usuario
{
    public function selectById($id)
    {
        $db = new DB();
        $query = 'select id, email, created_at from usuarios where id = ' . DB::data($id);
        return $db->query($query);
    }

    public function selectByEmail($email)
    {
        $db = new DB();
        $query = 'select id, email, created_at from usuarios where email = ' . DB::data($email);
        return $db->query($query);
    }

    public function insert($data)
    {
        $db = new DB();
        $data = DB::dataArray($data);
        $query = 'insert into usuarios (email, senha) values (' . $data['email'] . ',' . $data['senha'] . ')';
        return $db->execute($query);
    }
}
