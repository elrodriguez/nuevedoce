<?php
function cctom($string){
    return strtolower(preg_replace('([^A-Za-z0-9])', '', $string));
}
function rlang($string){
    return \Illuminate\Support\Facades\Lang::get($string);
}