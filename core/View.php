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
    
    public function render($view):void{
        if (file_exists('../app/views/'.$view.'.php')) {
            include_once '../app/views/'.$view.'.php';
            include_once $this->_template.'.php';
        } else {
            /*
             *   ==========================
             *     404 redirect goes here
             *   ==========================
             */
            $this->_errors[] =  '../app/views/'.$view.'.php doesnt exist';
        }
    }
    /*
    public function content($type){
        switch ($type) {
            case 'head':
                return $this->_head;
            case 'body':
                return $this->_body;
            default:
                return false;
        }
    }
     * 
     * 
     */
    
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
