pdo_mysql_functions
===================

Designed as a dropin replacement pdo wrapper for the mysql_ functions.

Overview
========

Each mysql_ function has its own pdo_mysql_ equivalent (or will do) and will work out of the box like this.  This is designed
so that you can do a find and replace adding pdo_ infront of the mysql function calls and still have your code work.  

Then little by little you can update the individual calls to take advantage of more of the features of PDO to increase performance and security.


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

New Functions
=============

These are functions that do not have a simple equivalent in mysql_ functions but add important functionality

    function pdo_mysql_query_wfields($SQL, $Fields,  $Connection = false)

One of the very important and very useful reasons for changing to PDO is the use of prepared statements.  The `pdo_mysql_query_wfields` allows you to pass an array of field values with your 
sql statement and have it executed as a PDO prepared statement.


    function pdo_mysql_fetchall_assoc($PDO_RS)

Returns an array with every Row as an associative array.  This is a shortcut for the standard While loop we all use.


