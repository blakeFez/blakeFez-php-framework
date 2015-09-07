<?php
/**
 * @author: blakeFez
 * @date: 2015-07-19
 * @note: command基类
 */
class Command{
    
    /**
     * 运行
     */
    public function run($actionName){
        $this->$actionName();
    }
}