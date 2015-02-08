<?php

	include('pdo_mssql_functions.php');

$mssql_connect_db = null;

function mssql_connect($Host, $Username, $pass, $SelectDB){

	$mssql_connect_db = new PDO("sqlsrv:Server=$Host;Database=$SelectDB;ConnectionPooling=0",$Username, $pass);
	return $mssql_connect_db;
}

functions mssql_query($SQL ){
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

