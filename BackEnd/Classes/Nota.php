<?php
class Nota {
    private $id;
    private $aluno_id;
    private $turma_id;
    private $valor;

    public function __construct($id, $aluno_id, $turma_id, $valor) {
        $this->id = $id;
        $this->aluno_id = $aluno_id;
        $this->turma_id = $turma_id;
        $this->valor = $valor;
    }

    public function registrar_nota($aluno, $turma, $valor) {
        // Lógica para registrar uma nota
    }

    public function atualizar_nota($valor) {
        $this->valor = $valor;
    }
}
