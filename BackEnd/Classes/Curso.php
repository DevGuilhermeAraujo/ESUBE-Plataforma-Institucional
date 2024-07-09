<?php
class Curso {
    private $id;
    private $nome;
    private $disciplinas = array();

    public function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function adicionar_disciplina($disciplina) {
        $this->disciplinas[] = $disciplina;
    }

    public function remover_disciplina($disciplina) {
        $key = array_search($disciplina, $this->disciplinas);
        if ($key !== false) {
            unset($this->disciplinas[$key]);
        }
    }
}
