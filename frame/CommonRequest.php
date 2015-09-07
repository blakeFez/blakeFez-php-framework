<?php
/**
 * @author: blakeFez
 * @date: 2015-07-18
 * @note: 获取url参数，并做处理
 */
class CommonRequest{
    
    /**
     * 获取参数
     */
    public static function getRequest($option, $defaultValue = null, $varType = '', $trim=true, $filter=true){
        if(!$option){
            return $defaultValue;
        }

        if(!isset($_REQUEST[$option]) || $_REQUEST[$option] === false) {
            return $defaultValue;
        }else{
            return self::getValue($_REQUEST[$option], $varType, $trim, $filter);
        }
    }
    
    /**
     * 获取值
     */
    public static function getValue($value, $varType, $trim, $filter){
        if(is_array($value)){
            foreach($value as &$v){
                $v = self::getValue($v, $varType, $trim);
            }
        }else{
            if (!empty($varType))
                settype($value, $varType);
        
            if($trim)
                $value = trim($value);
            
            if($filter)
                $value = htmlspecialchars($value);
        }
        
        return $value;
    }
}