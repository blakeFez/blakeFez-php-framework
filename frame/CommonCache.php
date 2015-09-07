<?php
/**
 * @author: blakeFez
 * @date: 2015-07-20
 * @note: 缓存类
 */
class CommonCache{
	private static $cacheInstance = array();
	/**
	 * 获取memcache实例
	 */
	public static function getInstance($host, $port){
		$key = substr(md5($host,$port), 0, 10);
		if(isset(self::$cacheInstance[$key])){
			return self::$cacheInstance[$key];
		}else{
			$cache = new Memcache();
			$cache->connect($host,$port);
			self::$cacheInstance[$key] = $cache;
			return $cache;
		}
	}
}