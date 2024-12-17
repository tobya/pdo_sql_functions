<?php
/*************************************************************
 Copyright © 2013 Toby Allen (http://github.com/tobya)

 Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction,
 including without limitation the rights to use, copy, modify, merge, publish, distribute, sub-license, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 subject to the following conditions:

 The above copyright notice, and every other copyright notice found in this software, and all the attributions in every file, and this permission notice shall be included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT.
 IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ****************************************************************/
/**
 * User: tobya Toby@toflidium.com
 * Date: 16/6/2013
 * url: http://github.com/tobya/
 *
 * Simple PDO wrapper for mssql_ functions
 */

/*
DROPIN REPLACEMENT FOR mssql_ functions

Allows drop in replacement for mssql_ functions usually declared in php_mssql.dll.  I needed a way of moving from 
mssql_ functions to pdo functions.  This file allows a drop in replacement to verify all aspects of your
application are working before using the pdo_mssql function by find and replace throughout your entire codebase.

Please use pdo_mssql_functions.php file once you have seen that this doesnt break anything.

Please note that these wrappers suffer from the same problems for SQL attacks that mssql_ functions do and should
only be used as   a stepping stone to get an old codebase converted with minimum disruption.

*/

include_once('pdo_mssql_functions.php');


$replace_mssql_connect_pdo = array();

/*Will not actually connect until select_db is called.*/
function mssql_connect($Host, $Username, $pass){

	global $replace_mssql_connect_pdo;	

	

	$replace_mssql_connect_pdo = array(
	 
	 'Pass' => $pass,
	 'User' => $Username,
	 'Host' => $Host

	);


	return true;
}

function mssql_select_db($DBName) {

	global $replace_mssql_connect_pdo;

	$mssql_connect_pdo = new PDO(	"sqlsrv:Server=$replace_mssql_connect_pdo[Host];Database=$DBName;ConnectionPooling=0;TrustServerCertificate=true;",
									$replace_mssql_connect_pdo['User'], 
									$replace_mssql_connect_pdo['Pass']);

	$replace_mssql_connect_pdo[	 'PDO_CONN'] = $mssql_connect_pdo;

	return $mssql_connect_pdo;	
}

function mssql_query($SQL ){
	global $replace_mssql_connect_pdo;
	$rs = pdo_mssql_query($SQL,$replace_mssql_connect_pdo['PDO_CONN']);
	return $rs;
}

function mssql_fetch_assoc($rs){
	
	return	pdo_mssql_fetch_assoc($rs);
}

function mssql_fetch_row($rs){

return	pdo_mssql_fetch_row($rs);
}

function mssql_fetch_array($rs){
return	pdo_mssql_fetch_array($rs);
}

function mssql_get_last_message( ){

	global $mssql_connect_pdo;

	$errArray = pdo_mssql_get_last_message();
	$errString = ''; //empty string, no error.
	if ($errArray[0] <> 0){
		foreach ($errArray as $key => $value) {
			$errString .= "$key=$value;";
		}
	}

	return $errString;
}

