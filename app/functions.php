<?php

function _md5($data){
    $myKey = 'asasASJJ#@LJj*(0@!--!DASad';
	$key = !isset($myKey)?exit('_md5 is error!'):$myKey;
	return md5($key.sha1(md5($data).$key));
}