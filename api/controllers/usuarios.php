<?php

include 'models/Usuario.php';

class usuarios
{
    public function login()
    {
        $post = json_decode(file_get_contents('php://input'));

        $usuario = new Usuario();
        $data = $usuario->selectByEmail($post->email);

        if ($data) {
            $pass = crypt($post->password, $_ENV['CRYPT_SALT']);
            if ($data[0]['password'] == $pass) {
                $token = crypt($data[0]['id'], $_ENV['CRYPT_SALT']);
                $token .= crypt($data[0]['email'], $_ENV['CRYPT_SALT']);
                echo json_encode(['data' => [
                    'token' => $token,
                    'id' => $data[0]['id'],
                    'nome' => $data[0]['nome'],
                    'email' => $data[0]['email'],
                ]]);
            } else {
                return ['error' => 'Senha inválida'];
            }
        } else {
            return ['error' => 'Usuário não encontrado'];
        }
    }

    public function get_usuario()
    {
        $id = DB::check_login();
        $usuario = new Usuario();
        return $usuario->selectById($id);
    }

    public function insert_usuario()
    {
        $usuario = new Usuario();
        return $usuario->insert(['email' => 'teste', 'senha' => 'teste']);
    }
}
