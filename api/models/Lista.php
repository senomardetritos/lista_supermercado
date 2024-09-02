<?php

include_once 'helpers/db.php';

class Lista
{
    public function selectById($usuarios_id, $id)
    {
        $db = new DB();
        $query = 'select id, created_at from listas where usuarios_id = ' . DB::data($usuarios_id) . ' and id = ' . DB::data($id);
        return $db->query($query);
    }

    public function selectAll($usuarios_id, $page, $limit)
    {
        $db = new DB();
        $query = 'select id, created_at from listas where usuarios_id = ' . DB::data($usuarios_id) . ' limit ' . DB::value($page) . ', ' . DB::value($limit);
        return $db->query($query);
    }

    public function cadastrar($usuarios_id)
    {
        $db = new DB();
        $query = 'insert into listas (usuarios_id) values (' . DB::data($usuarios_id) . ')';
        return $db->execute($query);
    }
}
