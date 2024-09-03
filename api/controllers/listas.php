<?php

include_once 'models/Lista.php';
include_once 'models/ListaItem.php';

class listas
{

    public function lista($post, $id)
    {
        $usuarios_id = DB::check_login();
        $lista = new Lista();
        $res = $lista->selectById($usuarios_id, $id);
        $lista_item = new ListaItem();
        $itens = $lista_item->selectAll($usuarios_id, $id);
        $res['itens'] = $itens ? $itens : [];
        return $res;
    }

    public function listas($post, $page, $limit)
    {
        $usuarios_id = DB::check_login();
        $lista = new Lista();
        return $lista->selectAll($usuarios_id, $page, $limit);
    }

    public function cadastrar_lista($post)
    {
        $usuarios_id = DB::check_login();
        $lista = new Lista();
        return $lista->cadastrar($usuarios_id);
    }

    public function excluir_lista($post, $listas_id)
    {
        $usuarios_id = DB::check_login();
        $lista = new Lista();
        return $lista->excluir($usuarios_id, $listas_id);
    }
}
