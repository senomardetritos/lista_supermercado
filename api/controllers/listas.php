<?php

include_once 'models/Usuario.php';
include_once 'models/Lista.php';
include_once 'models/ListaItem.php';

include_once 'helpers/mail.php';
include_once 'mails/lista_compras.php';

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

    public function enviar_lista_email($post, $listas_id)
    {
        $usuarios_id = DB::check_login();
        $usuario = new Usuario();
        $dados_usuario = $usuario->selectById($usuarios_id);
        $lista = new Lista();
        $dados_lista = $lista->selectById($usuarios_id, $listas_id);
        $lista_item = new ListaItem();
        $dados_lista_itens = $lista_item->selectAll($usuarios_id, $listas_id);
        $to      = $dados_usuario['email'];
        $subject = 'Lista de compras';
        $email_lista = new EmailListaCompras();
        $message = $email_lista->getTexto($dados_usuario, $dados_lista, $dados_lista_itens);
        $mail = new Mail();
        $mail->send($to, $subject, $message);
        return ['data' => 'Email enviado'];
    }
}
