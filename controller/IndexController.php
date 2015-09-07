<?php
class IndexController extends Controller{
    
    public function index(){
        $this->out['title'] = 'Welcome to blakeFez PHP Framework';
    }
}