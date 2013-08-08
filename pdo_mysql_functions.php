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
	 * Date: 29/6/2013
	 * url: http://github.com/tobya/
	 *
	 * Simple PDO wrapper for mysql_ functions
	 */

	$__pdo_mysql_CONNECTION = false;

	function pdo_mysql_PDOConnection()
	{
		 global $__pdo_mysql_CONNECTION;

		 return $__pdo_mysql_CONNECTION;
	}

	function pdo_mysql_Set_PDOConnection($pdo)
	{
		 global $__pdo_mysql_CONNECTION;

		 $__pdo_mysql_CONNECTION = $pdo;
	}

	function pdo_mysql_CreateConnection($host, $username, $password, $database)
	{
		global $__pdo_mysql_CONNECTION;

		$__pdo_mysql_CONNECTION = new PDO("mysql:host=$host;dbname=$database;charset=utf8",$username ,$password);

		return $__pdo_mysql_CONNECTION;
	}

	function pdo_mysql_query($sql, $connection = false, $batchsize_ignored = false)
	{
		return __pdo_mysql_query($sql, $connection);
	}

	function pdo_mysql_query_wfields($sql, $fields, $connection = false)
	{
		return __pdo_mysql_query($sql, $connection, $fields);
	}

	function __pdo_mysql_query($sql, $connection = false, $fields = false)
	{
		if (! $connection)
		{
			$pdo = pdo_mysql_PDOConnection();
		}
		else
		{
			$pdo = $connection;
		}

		// No fields info provided, just execute sql and return.
		//
		if ($fields == false)
		{
			return __pdo_mysql_query_nofields($sql, $pdo);
		}

		// Fields info is available so prepare sql and execute.
		//
		$pdo_rs = $pdo->prepare($sql);
		$pdo_rs->execute($fields);

		return $pdo_rs;
	}

	function __pdo_mysql_query_nofields($sql, $pdo)
	{
		 $pdo_rs = $pdo->query($sql);
		 return $pdo_rs;
	}

	function pdo_mysql_fetch_assoc($pdo_rs)
	{
		 $row = $pdo_rs->fetch(PDO::FETCH_ASSOC);

		 return $row;
	}

	function pdo_mysql_fetch_array($pdo_rs)
	{
		 $row = $pdo_rs->fetch(PDO::FETCH_BOTH);

		 return $row;
	}

	function pdo_mysql_fetch_row($pdo_rs)
	{
		 $row = $pdo_rs->fetch(PDO::FETCH_NUM);

		 return $row;
	}

	function pdo_mysql_error($pdo_rs)
	{
		// I'm not sure this will return last message
		//
		return $pdo->errorInfo();
	}

	function pdo_mysql_fetchall_assoc($pdo_rs)
	{
		return $pdo_rs->fetchAll(PDO::FETCH_ASSOC);
	}

?>
