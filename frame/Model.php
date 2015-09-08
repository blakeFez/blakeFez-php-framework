<?php
class Model{
    
    protected $dbName;
    protected $table;
    protected $db;
    
    public function __construct($host, $port, $user, $passwd = '', $dbName = '', $table = ''){
        if(empty($port)) $port = 3306;
        if(empty($host) || empty($user)) return;

        $this->dbName = $dbName;
        $this->table = $table;
        $dsn = "mysql:host={$host}:{$port}" . ($dbName) ? ";dbname={$dbName}" : '';
        $this->db = CommonMysql::getInstance($dsn, $user, $passwd);
    }
}