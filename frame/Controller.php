<?php
/**
 * @author: blakeFez
 * @date: 2015-07-18
 * @note: controller基类
 */
class Controller{
    //用于输出的out
    protected $out = array();
    protected $outType = '';
    public $actionID = '';
    
    /**
     * 运行
     */
    public function run($actionName){
        $this->actionID = $actionName;
        $this->$actionName();
        $this->afterAction();
    }
    
    
    /**
     * 用于结尾调用 ，前端渲染
     */
    function afterAction(){
        if($this->outType == 'json'){
            echo json_encode($this->out);
        }else{
            if(!empty($this->out)){
                if(!is_array($this->out)){
                    $this->out = array('out'=>$this->out);
                }
                foreach($this->out as $key=>$val){
                    $$key = $val;
                }
            }
            $className = lcfirst(get_class($this));
            $className = substr($className, 0, strlen($className) - 10);
            require('./view/'.$className.'/'.$this->actionID.'.php');
        }
    }
}