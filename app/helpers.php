<?php
function cctom($string){
    return strtolower(preg_replace('([^A-Za-z0-9])', '', $string));
}