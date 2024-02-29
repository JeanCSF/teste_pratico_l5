<?php

namespace app\Models;

use app\Config\Database;

class Ramal
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function save(array $dados)
    {
        $sql = "INSERT INTO info_ramais (`ramal`, `nome`, `online`, `status`, `agente`, `ip`, `porta`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);

        $this->conn->begin_transaction();
        foreach ($dados as $data) {
            $online = $data['online'] ? 1 : 0;
            $stmt->bind_param(
                "ssissss",
                $data['nome'],
                $data['ramal'],
                $online,
                $data['status'],
                $data['agente'],
                $data['ip'],
                $data['porta']
            );
            $stmt->execute();
        }
        $this->conn->commit();

        $stmt->close();
    }

    public function update(array $data)
    {
        $this->conn->begin_transaction();
        foreach ($data as $rowData) {
            $ramal = $rowData['ramal'];

            $sql = "UPDATE info_ramais SET ";
            $updates = array();

            foreach ($rowData as $key => $value) {
                if ($value !== null && $key !== 'ramal') {
                    $updates[] = "$key = '$value'";
                }
            }

            if (!empty($updates)) {
                $sql .= implode(', ', $updates);
                $sql .= " WHERE ramal = ?";

                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $ramal);
                $stmt->execute();
            }
        }
        $this->conn->commit();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM info_ramais";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->get_result();
    }
}
