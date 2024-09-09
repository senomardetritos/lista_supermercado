<?php

include_once 'models/Lista.php';
include_once 'models/ListaItem.php';

class listas_itens
{

    public function salvar_item($post)
    {
        $usuarios_id = DB::check_login();
        $lista_item = new ListaItem();
        if ($post->id) {
            // UPDATE
            return $lista_item->atualizar($usuarios_id, $post->id, $post->nome, $post->preco, $post->quantidade);
        } else {
            // INSERT
            return $lista_item->cadastrar($usuarios_id, $post->listas_id, $post->nome);
        }
    }

    public function lista_item($post, $id)
    {
        $usuarios_id = DB::check_login();
        $lista_item = new ListaItem();
        return $lista_item->selectById($usuarios_id, $id);
    }

    public function alterar_peguei($post, $id)
    {
        $usuarios_id = DB::check_login();
        $lista_item = new ListaItem();
        $res = $lista_item->selectById($usuarios_id, $id);
        $resolvido = 0;
        if ($res['resolvido'] == 0) $resolvido = 1;
        return $lista_item->alterarPeguei($usuarios_id, $id, $resolvido);
    }

    public function excluir_item($post, $id)
    {
        $usuarios_id = DB::check_login();
        $lista_item = new ListaItem();
        return $lista_item->excluirItem($usuarios_id, $id);
    }
}
