<?php

include 'models/Usuario.php';
include 'helpers/mail.php';

class usuarios
{
    public function login($post)
    {
        $usuario = new Usuario();
        $data = $usuario->selectSenhaByEmail($post->email);

        if ($data) {
            $senha = crypt($post->senha, $_ENV['CRYPT_SALT']);
            if ($data['senha'] == $senha) {
                $token = crypt($data['id'], $_ENV['CRYPT_SALT']);
                $token .= crypt($data['email'], $_ENV['CRYPT_SALT']);
                return [
                    'token' => $token,
                    'id' => $data['id'],
                    'email' => $data['email'],
                ];
            } else {
                return ['error' => 'Senha inválida'.$senha];
            }
        } else {
            return ['error' => 'Usuário não encontrado'];
        }
    }

    public function enviar_recuperar($post)
    {
        $usuario = new Usuario();
        $data = $usuario->selectByEmail($post->email);
        if ($data) {
            try {
                $codigo = rand(1, 9) . rand(1, 9) . rand(1, 9) . rand(1, 9);
                $to      = $post->email;
                $subject = 'Recuperação de Senha';
                $message = '
                    <h3>Recuperação de Senha</h3>
                    <h5>Seu código para recuerar a senha:</h5>
                    <h1>' . $codigo . '</h1>
                ';
                $usuario->updateCodigo($data['id'], $codigo);
                $mail = new Mail();
                $mail->send($to, $subject, $message);
                return ['data' => []];
            } catch (Exception $e) {
                return ['error' => $e->getMessage()];
            }
        } else {
            return ['error' => 'Usuário não existe'];
        }
    }

    public function recuperar($post)
    {
        $usuario = new Usuario();
        $data = $usuario->selectByEmail($post->email);
        if ($data) {
            try {
                if ($data['codigo'] == $post->codigo) {
                    $senha = crypt($post->senha, $_ENV['CRYPT_SALT']);
                    $usuario->updateSenha($data['id'], $senha);
                    return ['data' => []];
                }
                return ['error' => 'Código incorreto'];
            } catch (Exception $e) {
                return ['error' => $e->getMessage()];
            }
        } else {
            return ['error' => 'Usuário não existe'];
        }
    }

    public function get_usuario()
    {
        $usuario_id = DB::check_login();
        $usuario = new Usuario();
        return $usuario->selectById($usuario_id);
    }

    public function insert_usuario()
    {
        $usuario = new Usuario();
        return $usuario->insert(['email' => 'teste', 'senha' => 'teste']);
    }
}
