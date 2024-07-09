<?php
require_once 'Conexao.php';
require_once 'Usuario.php';
require_once 'Aluno.php';
require_once 'Professor.php';
require_once 'Turma.php';
//require_once 'Materia.php';
require_once 'Nota.php';
require_once 'Presenca.php';
//require_once 'Trabalho.php';
require_once 'Permissao.php';

class App {
    public static $db;
    public static $logger;
    public static $usuario;
    public static $aluno;
    public static $professor;
    public static $turma;
    public static $materia;
    public static $nota;
    public static $presenca;
    public static $trabalho;
    public static $permissao;

    public static function init() {
        self::$db = new Conexao();
        self::$usuario = new Usuario(self::$db, self::$logger);
        self::$aluno = new Aluno(self::$db, self::$logger);
        self::$professor = new Professor(self::$db, self::$logger);
        //self::$turma = new Turma(self::$db, self::$logger);
        //self::$materia = new Disciplina(self::$db, self::$logger);
        //self::$nota = new Nota(self::$db, self::$logger);
        //self::$presenca = new Presenca(self::$db, self::$logger);
        //self::$trabalho = new Trabalho(self::$db, self::$logger);
        self::$permissao = new Permissao(self::$db, self::$logger);
    }
}

// Inicializa o aplicativo
App::init();
