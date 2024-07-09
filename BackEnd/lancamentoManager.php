<?php

class NotasManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function lancarNotas($idMateriaSelected, $idBimestreSelected, $idTurmaSelected, $idTipoNota, $notas) {
        foreach ($notas as $idAluno => $nota) {
            $result = $this->db->executar("INSERT INTO notas(nota, id_aluno, id_materia, id_atividade, bimestre) VALUES (:nota, :idAluno, :idMateria, :idTipoNota, :idBimestre)",
                true,
                [
                    ':nota' => $nota,
                    ':idAluno' => $idAluno,
                    ':idMateria' => $idMateriaSelected,
                    ':idTipoNota' => $idTipoNota,
                    ':idBimestre' => $idBimestreSelected
                ]
            );
        }
        return true; // Pode adicionar verificação de sucesso aqui se necessário
    }
}


class PresencaManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registrarPresenca($idMateriaSelected, $idTurmaSelected, $frequencias) {
        foreach ($frequencias as $idAluno => $frequencia) {
            $result = $this->db->executar("INSERT INTO frequencia(id_aluno, id_materia, desc_frequencia) VALUES (:idAluno, :idMateria, :frequencia)",
                true,
                [
                    ':idAluno' => $idAluno,
                    ':idMateria' => $idMateriaSelected,
                    ':frequencia' => $frequencia
                ]
            );
        }
        return true; // Pode adicionar verificação de sucesso aqui se necessário
    }
}
