<?php
class Presenca {
    private $id;
    private $aluno_id;
    private $turma_id;
    private $data;
    private $presente;

    public function __construct($id, $aluno_id, $turma_id, $data, $presente) {
        $this->id = $id;
        $this->aluno_id = $aluno_id;
        $this->turma_id = $turma_id;
        $this->data = $data;
        $this->presente = $presente;
    }

    public function registrar_presenca($aluno, $turma, $data, $presente) {
        // Lógica para registrar presença
    }

    public function atualizar_presenca($presente) {
        $this->presente = $presente;
    }
}
