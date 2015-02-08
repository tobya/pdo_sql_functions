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

include('pdo_mssql_functions.php');

$mssql_connect_db = null;

function mssql_connect($Host, $Username, $pass, $SelectDB){

	$mssql_connect_db = new PDO("sqlsrv:Server=$Host;Database=$SelectDB;ConnectionPooling=0",$Username, $pass);
	return $mssql_connect_db;
}

function mssql_query($SQL ){
	$rs = pdo_mssql_query($SQL);
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

function mssql_get_last_message(){
return pdo_mssql_get_last_message();
}

