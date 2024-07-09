<?php
class Turma {
    private $id;
    private $nome;
    private $disciplina_id;
    private $alunos = array();

    public function __construct($id, $nome, $disciplina_id) {
        $this->id = $id;
        $this->nome = $nome;
        $this->disciplina_id = $disciplina_id;
    }

    public function adicionar_aluno($aluno) {
        $this->alunos[] = $aluno;
    }

    public function remover_aluno($aluno) {
        $key = array_search($aluno, $this->alunos);
        if ($key !== false) {
            unset($this->alunos[$key]);
        }
    }

    public function registrar_presenca($aluno, $data, $presente) {
        // Lógica para registrar a presença de um aluno
    }
}
