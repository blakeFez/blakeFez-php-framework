<?php
/**
 * @author: blakeFez
 * @date: 2015-07-18
 * @note: 获取mysql实例
 */
class CommonMysql{
    
    private static $mysqlInstance = array();
    /**
     * 获取MySQL实例
     */
    public static function getInstance($dsn,$user,$passwd){
        $key = substr(md5($dsn), 0, 10);
        if(isset(self::$mysqlInstance[$key])){
            return self::$mysqlInstance[$key];
        }else{
            $mysql = new MysqlPdo($dsn,$user,$passwd);
            self::$mysqlInstance[$key] = $mysql;
            return $mysql;
        }
    }
}

class MysqlPdo{
	
	private $connect;
	
	/**
	 * 构造函数
	 */
	public function __construct($dsn,$user,$passwd){
		$this->connect = new PDO('mysql:host='.$dsn, $user, $passwd);
	}
	
	/**
	 * 获取数据
	 */
	public function query($sql, $args = array()){
		$sth = $this->connect->prepare($sql);
		if(!empty($args)){
			foreach($args as $key=>$val){
				$k = (substr($key, 0, 1) == ':') ? $key : ':'.$key;
				$sth->bindParam($k,$val);
			}
		}
		$sth->execute();
		$result = array();
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * 执行sql
	 */
	public function execute($sql, $args = array()){
		$sth = $this->connect->prepare($sql);
		if(!empty($args)){
			foreach($args as $key=>$val){
				$k = (substr($key, 0, 1) == ':') ? $key : ':'.$key;
				$sth->bindParam($k,$val);
			}
		}
		return $sth->execute();
	}
	
	/**
	 * 插入id
	 */
	public function getInsertID(){
		return $this->connect->lastInsertId();
	}
}