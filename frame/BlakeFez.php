<?php
/**
 * @author: blakeFez
 * @date: 2015-07-18
 * @note: blakeFez框架主类
 */
class BlakeFez{
    /**
     * 运行
     */
    public function run(){
        $path = ROOTPATH.'/frame'.PATH_SEPARATOR.ROOTPATH.'/controller'.PATH_SEPARATOR.ROOTPATH.'/service'.PATH_SEPARATOR.ROOTPATH.'/command'.PATH_SEPARATOR.ROOTPATH.'/model';
        set_include_path(get_include_path().PATH_SEPARATOR.$path);
        list($controllerName,$actionName) = self::getActionName();
        $control = new $controllerName;
        if(method_exists($control, $actionName)){
            $control->run($actionName);
        }
    }
    
    /**
     * 获取controller和action的名称
     */
    public static function getActionName(){
        if(php_sapi_name() === 'cli'){//cli模式
            $options = getopt("c:a:");
            $controllerName = $options['c'];
            if(!$controllerName) $controllerName = DEFAULTCONTROLLER;
            $actionName = $options['a'];
            if(!$actionName) $actionName = DEFAULTACTION;
            $controllerName = ucfirst($controllerName).'Command';
        }else{
            session_start();
            $controllerName = CommonRequest::getRequest('c');
            if(!$controllerName) $controllerName = DEFAULTCONTROLLER;
            $actionName = CommonRequest::getRequest('a');
            if(!$actionName) $actionName = DEFAULTACTION;
            $controllerName = ucfirst($controllerName).'Controller';
        }
        return array($controllerName,$actionName);
    }
    
    /**
     * autoload函数
     */
    public static function autoload($className){
        include_once($className.'.php');
    }
}
spl_autoload_register(array('BlakeFez','autoload'));