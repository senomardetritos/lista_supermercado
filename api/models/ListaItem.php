<?php

include_once './helpers/db.php';

class ListaItem
{
    public function selectById($usuarios_id, $id)
    {
        $db = new DB();
        $query = 'select id, nome, quantidade, preco, resolvido, created_at from lista_itens where usuarios_id = ' . DB::data($usuarios_id) . ' and id = ' . DB::data($id);
        return $db->query($query);
    }

    public function selectAll($usuarios_id, $listas_id)
    {
        $db = new DB();
        $query = 'select id, nome, quantidade, preco, resolvido, created_at from lista_itens where usuarios_id = ' . DB::data($usuarios_id) . ' and listas_id = ' . DB::data($listas_id);
        return $db->query($query);
    }

    public function cadastrar($usuarios_id, $listas_id, $nome)
    {
        $db = new DB();
        $query = 'insert into lista_itens (usuarios_id, listas_id, nome) values (' . DB::data($usuarios_id) . ', ' . DB::data($listas_id) . ', ' . DB::data($nome) . ')';
        return $db->execute($query);
    }

    public function atualizar($usuarios_id, $id, $nome, $preco, $quantidade)
    {
        $db = new DB();
        $query = 'update lista_itens set nome = ' . DB::data($nome) . ', preco = ' . DB::value($preco) . ', quantidade = ' . DB::value($quantidade) . ' where usuarios_id = ' . DB::data($usuarios_id) . ' and id = ' . DB::value($id);
        return $db->execute($query);
    }

    public function alterarPeguei($usuarios_id, $id, $resolvido)
    {
        $db = new DB();
        $query = 'update lista_itens set resolvido = ' . DB::data($resolvido) . ' where usuarios_id = ' . DB::data($usuarios_id) . ' and id = ' . DB::value($id);
        return $db->execute($query);
    }

    public function excluirItem($usuarios_id, $id)
    {
        $db = new DB();
        $query = 'delete from lista_itens where usuarios_id = ' . DB::data($usuarios_id) . ' and id = ' . DB::value($id);
        return $db->execute($query);
    }
}
