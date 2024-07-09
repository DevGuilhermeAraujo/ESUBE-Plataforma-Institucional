<?php
class Disciplina {
    private $id;
    private $nome;
    private $curso_id;
    private $turmas = array();

    public function __construct($id, $nome, $curso_id) {
        $this->id = $id;
        $this->nome = $nome;
        $this->curso_id = $curso_id;
    }

    public function associar_curso($curso) {
        $this->curso_id = $curso->getId();
    }

    public function desassociar_curso() {
        $this->curso_id = null;
    }
}
