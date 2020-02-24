<?php
if (! function_exists('aroute')){
    function aroute($name=null){
        return route('admin.'.$name);
    }
}

if (! function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}
