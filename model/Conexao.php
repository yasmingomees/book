<?php

class Conexao {

    private static $servername = "ec2-52-207-15-147.compute-1.amazonaws.com";
    private static $username = "ywopnzkxlgusiy";
    private static $password = "589642b6a20a8c8250bd1aa70083e0d33a3b7c2ea48890f56c3b332f1d0f2bc3";
    private static $dbname = "dem87spf8tk6d0";
    private static $erro = "";
    private static $data = null;
    private static $conn = null;

    public static function getErro() {
        $message = self::$erro;
        self::$erro = "";
        return $message;
    }

    public static function getData() {
        $data = self::$data;
        self::$data = null;
        return $data;
    }

    public static function getLastId() {
        return self::$conn
                ->query("SELECT LAST_INSERT_ID();")
                ->fetchColumn();
    }

    public static function isConnected() {
        if (self::$conn == null) {
            return self::connect();
        }
        return true;
    }

    public static function exec($sql) {
        if (self::isConnected()) {
            try {
                return self::$conn->query($sql);
            } catch (PDOException $ex) {
                self::$erro = "Erro ao executar: " . $ex->getMessage();
            } catch (Exception $ex) {
                self::$erro = "Erro genérico: " . $ex->getMessage();
            }
        }
        return false;
    }

    public static function execWithReturn($sql) {
        if (self::isConnected()) {
            try {
                $result = self::$conn->query($sql);
                return self::fetchResult($result);
            } catch (PDOException $ex) {
                self::$erro = "Erro ao consultar: " . $ex->getMessage();
            } catch (Exception $ex) {
                self::$erro = "Erro genérico: " . $ex->getMessage();
            }
        }
        return false;
    }
    
    public function __destruct() {
        self::$conn = null;
    }

    private static function fetchResult($result){
        if ($result->rowCount() > 0) {
            $result->setFetchMode(PDO::FETCH_ASSOC);
            self::$data = $result->fetchAll();
            return true;
        } else {
            self::$erro = "Nenhum registro encontrado!";
            return false;
        }
    }
    
    private static function connect() {
        try {
            self::$conn = new PDO("pgsql:host=" . self::$servername .
                    ";dbname=" . self::$dbname . ";port=5432",
                    self::$username,
                    self::$password);
            // set the PDO error mode to exception
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            self::$erro = "Falha na conexão com o banco de dados: " . $e->getMessage();
            self::$conn = null;
            return false;
        }
    }

}