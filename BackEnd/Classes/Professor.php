<?php
class Professor {
    private $id;
    private $usuario_id;
    private $disciplinas = array();

    public function __construct($id, $usuario_id) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
    }

    public function atribuir_disciplina($disciplina) {
        $this->disciplinas[] = $disciplina;
    }

    public function desatribuir_disciplina($disciplina) {
        $key = array_search($disciplina, $this->disciplinas);
        if ($key !== false) {
            unset($this->disciplinas[$key]);
        }
    }

    public function lancar_nota($aluno, $turma, $valor) {
        // Lógica para lançar uma nota para um aluno
    }
}
