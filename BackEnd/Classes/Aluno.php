<?php
class Aluno {
    private $id;
    private $usuario_id;
    private $turmas = array();

    public function __construct($id, $usuario_id) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
    }

    public function matricular_turma($turma) {
        $this->turmas[] = $turma;
    }

    public function desmatricular_turma($turma) {
        $key = array_search($turma, $this->turmas);
        if ($key !== false) {
            unset($this->turmas[$key]);
        }
    }
}
