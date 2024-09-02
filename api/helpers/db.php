<?php
include_once './header.php';

class DB
{
    protected $mysql;

    function __construct()
    {
        $this->mysql = $this->connet();
    }

    public function connet()
    {
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysql = new mysqli($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
            /* Defina o conjunto de caracteres desejado após estabelecer uma conexão */
            $mysql->set_charset('utf8mb4');
            return $mysql;
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            die();
        }
    }

    public function query($query)
    {
        $result = $this->mysql->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        if (count($data) == 1) {
            return $data[0];
        } else if (count($data) == 0) {
            return null;
        } else {
            return $data;
        }
    }

    public function execute($query)
    {
        $this->mysql->query($query);
        return $this->mysql->insert_id;
    }

    public static function value($value)
    {
        $chars = ['\'', '`', '"'];
        foreach ($chars as $char) {
            $value = implode('', explode($char, $value));
        }
        return $value;
    }

    public static function data($value)
    {
        $chars = ['\'', '`', '"'];
        foreach ($chars as $char) {
            $value = implode('', explode($char, $value));
        }
        return '\'' . $value . '\'';
    }

    public static function dataArray($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = DB::data($value);
        }
        return $data;
    }

    public static function check_login()
    {
        $header = apache_request_headers();
        if (!isset($header['Authorization'])) {
            echo json_encode(['error' => 'Authorization não encontrado']);
            die();
        }
        try {
            $auth = $header['Authorization'];
            $auth = explode(' ', $auth)[1];
            $id = explode('_', $auth)[0];
            $token = explode('_', $auth)[1];

            $db = new DB();
            $result = $db->query('select * from usuarios where id = ' . DB::data($id));

            $valid = crypt($result['id'], $_ENV['CRYPT_SALT']);
            $valid .= crypt($result['email'], $_ENV['CRYPT_SALT']);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Authorization inválido']);
            die();
        }
        if ($token == $valid) {
            return $id;
        } else {
            echo json_encode(['error' => 'Token inválido: ' . $token]);
            die();
        }
    }
}
