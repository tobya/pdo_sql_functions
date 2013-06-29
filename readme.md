pdo_mysql_functions
===================

Designed as a dropin replacement pdo wrapper for the mysql_ functions.

Overview
========

Each mysql_ function has its own pdo_mysql_ equivalent (or will do) and will work out of the box like this.  This is designed
so that you can do a find and replace adding pdo_ infront of the mysql function calls and still have your code work.  

Then little by little you can update the individual calls to take advantage of more of the features of PDO to increase performance and security.

* [Functions](#Functions)
* [Connection](#Connection)
* [New Functions](#New-Functions)
* [Examples](#Examples)


Functions
=========

Currently the following functions have been implemented

    function pdo_mysql_query($SQL, $Connection = false, $Batchsize_Ignored = false)

Replacement for `mysql_query` - Batchsize will be ignored though as there is no real equivalent in PDO.  If Connection is false function will use connection object previously set by `Set_PDO_mysql_Connection`

    function pdo_mysql_fetch_assoc($PDO_RS)


Replacement for `mysql_fetch_assoc` will return next row from Recordset as an assosiative array.

    function pdo_mysql_fetch_array($PDO_RS)

Replacement for `mysql_fetch_array` 

    function pdo_mysql_fetch_row($PDO_RS)

Replacement for `mysql_fetch_row` 

    function pdo_mysql_get_last_message()




Connection
----------

You can create a standard PDO connection in the normal way or you can use the supplied `pdo_mysql_CreateConnection` function.  As with the mysql_ functions you 
can either pass the connection to each call to pdo_mysql_query or you can rely on a global connection.

    //Create a standard PDO connection and attach

    $PDO = new  PDO("mysql:host=localhost;dbname=ImporantDB;charset=utf8",'auser' ,'apassword');
    pdo_mysql_set_PDOConnection($PDO); 
    
    //function will use connection passed above.
    $rs = pdo_mysql_query('Select * from my table');  


or


    //Create a PDO connection using new function

     pdo_mysql_CreateConnection('localhost','auser','apass', 'ImportantDB');

    //function will use connection passed above.
    $rs = pdo_mysql_query('Select * from my table'); 

New Functions
=============

These are functions that do not have a simple equivalent in mysql_ functions but add important functionality

    function pdo_mysql_query_wfields($SQL, $Fields,  $Connection = false)

One of the very important and very useful reasons for changing to PDO is the use of prepared statements.  The `pdo_mysql_query_wfields` allows you to pass an array of field values with your 
sql statement and have it executed as a PDO prepared statement.


    function pdo_mysql_fetchall_assoc($PDO_RS)

Returns an array with every Row as an associative array.  This is a shortcut for the standard While loop we all use.

Examples
========

Old Code (with possible hacking vunerability)

	 Define("CURRENTDB_HOST", "Localhost");
	 Define("CURRENTDB_USER", "root");
	 Define("CURRENTDB_PASS", "mypass");
	 Define("CURRENTDB_NAME", "myDB");

    	$DB = mysql_connect(CURRENTDB_HOST,CURRENTDB_USER,CURRENTDB_PASS);
 	mysql_select_db(CURRENTDB_NAME,$DB);

        $rs = mysql_query('Select * from mytable where myID = $_GET[UserValueID]');
	$row = mysql_fetch_Assoc($rs);

	print_r($row);

New Code (minimal changes).  Simple create the connection and change function names to put 'pdo_' in front.  Hacking vulenability is still a possibility, but
code has been moved to pdo with very little difficulty.


	Define("CURRENTDB_HOST", "Localhost");
	Define("CURRENTDB_USER", "root");
	Define("CURRENTDB_PASS", "mypass");
	Define("CURRENTDB_NAME", "myDB");

    	pdo_mysql_CreateConnection(CURRENTDB_HOST,CURRENTDB_USER,CURRENTDB_PASS, CURRENTDB_NAME);
 	

        $rs = pdo_mysql_query('Select * from mytable where myID = $_GET[UserValueID]');
	$row = pdo_mysql_fetch_Assoc($rs);

	print_r($row);

improved code.  change function call and remove hacking vulnerability.

	 Define("CURRENTDB_HOST", "Localhost");
	 Define("CURRENTDB_USER", "root");
	 Define("CURRENTDB_PASS", "mypass");
	 Define("CURRENTDB_NAME", "myDB");

    	pdo_mysql_CreateConnection(CURRENTDB_HOST,CURRENTDB_USER,CURRENTDB_PASS, CURRENTDB_NAME);
 	

        $rs = pdo_mysql_query_wfields('Select * from mytable where myID = :UserValueID', Array(':UserValueID' => $_GET['UserValueID']));
	$row = pdo_mysql_fetch_Assoc($rs);

	print_r($row);

