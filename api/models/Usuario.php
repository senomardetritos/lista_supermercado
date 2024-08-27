<?php

include 'helpers/db.php';

class Usuario
{
    public function selectById($id)
    {
        $db = new DB();
        $query = 'select id, email, codigo, created_at from usuarios where id = ' . DB::data($id);
        return $db->query($query);
    }

    public function selectByEmail($email)
    {
        $db = new DB();
        $query = 'select id, email, codigo, created_at from usuarios where email = ' . DB::data($email);
        return $db->query($query);
    }

    public function selectSenhaByEmail($email)
    {
        $db = new DB();
        $query = 'select id, email, senha from usuarios where email = ' . DB::data($email);
        return $db->query($query);
    }

    public function updateCodigo($id, $codigo)
    {
        $db = new DB();
        $query = "update usuarios set codigo = '" . $codigo . "' where id = " . $id;
        return $db->execute($query);
    }

    public function updateSenha($id, $senha)
    {
        $db = new DB();
        $query = "update usuarios set senha = '" . $senha . "', codigo = '' where id = " . $id;
        return $db->execute($query);
    }

    public function insert($data)
    {
        $db = new DB();
        $data = DB::dataArray($data);
        $query = 'insert into usuarios (email, senha) values (' . $data['email'] . ',' . $data['senha'] . ')';
        return $db->execute($query);
    }
}
