<?php

class HomeController extends Controller{

    function index($inputArgs=null){
        
        $this->_view->load('home','view');
        $this->_view->setHeader('home','header');
        $this->_view->setFooter('home','footer');
        
    }
}