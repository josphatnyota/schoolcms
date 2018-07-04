<?php

namespace Core;

/**
 * Description of View
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class View {
    
    protected $_template = TEMPLATE,$_head,$_body,$_content,$_errors = [],$_title = TITLE;
    
    public function __construct() {
        
    }
    
    public function render($view,$data = []):void{
        
        $except = ["error404","error401"];
       
        if (file_exists('../App/views/'.$view.'.php')) {
                
            include_once '../App/views/'.$view.'.php';
        
            if(!in_array($view,$except)){
                
                include_once $this->_template.'.php';
                
            }
            
        } else {
            /*
             *   ==========================
             *     404 redirect goes here
             *   ==========================
             */
            
            $this->_errors[] =  '../App/views/'.$view.'.php doesnt exist';
            
        }
        
    }
 
    public function open($type):void{
        
        $this->_content = $type;
        ob_start();
        
    }
    
    public function close():void{
        
        switch ($this->_content) {
            
            case 'head':
                
                $this->_head = ob_get_clean();
                break;
            
            case 'body':
                
                $this->_body = ob_get_clean();
                break;
            
            default:
                
                $this->_errors[] = "run open() method first to turn output buffering";
                break;
            
        }
        
    }
    
    public function title():string{
        
        return $this->_title;
        
    }
    
    public function head(){
        
        return $this->_head;
        
    }
    
    public function body(){
        
        return $this->_body;
        
    }
    
    public function setTitle($title){
        
        $this->_title = $title;
        
    }
    
}
