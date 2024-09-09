<?php

include_once './helpers/db.php';

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
        $query = 'update usuarios set codigo = ' . DB::data($codigo) . ' where id = ' . DB::data($id);
        return $db->execute($query);
    }

    public function updateSenha($id, $senha)
    {
        $db = new DB();
        $query = 'update usuarios set senha = ' . DB::data($senha) . ', codigo = \'\' where id = ' . DB::data($id);
        return $db->execute($query);
    }

    public function cadastrar($email, $senha)
    {
        $db = new DB();
        $query = 'insert into usuarios (email, senha) values (' . DB::data($email) . ',' . DB::data($senha)  . ')';
        return $db->execute($query);
    }
}
