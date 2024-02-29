<?php

namespace app\Controllers;

use app\Models\Ramal;

class Ramais
{
    private $model;

    public function __construct()
    {
        $this->model = new Ramal();
    }

    public function index()
    {
        return MainController::view('monitoramento');
    }

    public function getRamais()
    {
        header("Content-type: application/json; charset=utf-8");
        $ramais = file('../public/assets/data/ramais');
        $filas = file('../public/assets/data/filas');
        $status_ramais = array();
        $status_map = array(
            '(Ring)' => 'chamando',
            '(In use)' => 'ocupado',
            '(Not in use)' => 'disponivel',
            '(paused)' => 'pausado',
            '(Unavailable)' => 'indisponivel'
        );

        foreach ($filas as $linhas) {
            if (strstr($linhas, 'SIP/')) {
                $linha = explode(' ', trim($linhas));
                list($tech, $ramal) = explode('/', $linha[0]);
                list($agente) = explode('/', end($linha));

                foreach ($status_map as $estado => $status) {
                    if (strstr($linhas, $estado)) {
                        $status_ramais[$ramal] = array(
                            'status' => $status,
                            'agente' => $agente
                        );
                    }
                }
            }
        }


        $info_ramais = array();
        foreach ($ramais as $linhas) {
            $linha = array_filter(explode(' ', $linhas));
            $arr = array_values($linha);
            if (trim($arr[1]) == '(Unspecified)' and trim($arr[4]) == 'UNKNOWN') {
                list($name, $username) = explode('/', $arr[0]);
                $info_ramais[$name] = array(
                    'ramal' => $username,
                    'nome' => $name,
                    'online' => 0,
                    'status' => $status_ramais[$name]['status'],
                    'agente' => $status_ramais[$name]['agente'],
                    'ip' => $arr[1],
                    'porta' => "0",
                );
            }
            if (isset($arr[5]) && trim($arr[5]) == "OK") {
                list($name, $username) = explode('/', $arr[0]);
                $info_ramais[$name] = array(
                    'ramal' => $username,
                    'nome' => $name,
                    'online' => 1,
                    'status' => $status_ramais[$name]['status'],
                    'agente' => $status_ramais[$name]['agente'],
                    'ip' => $arr[1],
                    'porta' => $arr[4],
                );
            }
        }

        echo json_encode($info_ramais);
    }

    public function saveRamal()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $storagedRamais = $this->model->getAll()->fetch_all(MYSQLI_ASSOC);

        if (count($storagedRamais) == 0) {
            $this->model->save($data);
        } else {
            if (array_diff_assoc($data, $storagedRamais[0])) {
                $this->model->update($data);
            }
        }
    }
}
