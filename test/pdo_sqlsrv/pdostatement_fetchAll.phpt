--TEST--
Test the PDOStatement::fetchAll() method with various arguments (Note: FETCH_LAZY/FETCH_INTO/FETCH_BOUND are not tested). 
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php
  
require_once 'MsCommon.inc';

  
function fetchAll_rows( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );

    $result = $stmt->fetchAll();
    var_dump($result);
}

function fetchAll_column( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );  
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 5);
    var_dump($result);
}

function fetchAll_types( $conn )
{
    global $table2;
    $stmt = $conn->query( "Select * from ". $table2 );
    $result = $stmt->fetchAll();
    var_dump ($result); 
}

function fetchAll_both( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );
    $result = $stmt->fetchAll(PDO::FETCH_BOTH);
    var_dump($result[0]);
    $stmt->closeCursor();
}

function fetchAll_assoc( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result[0]);
    $stmt->closeCursor();
}

function fetchAll_obj( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    var_dump($result[1]);
    $stmt->closeCursor();
}

function fetchAll_num( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );
    $result = $stmt->fetchAll(PDO::FETCH_NUM);
    var_dump($result[1]);
    $stmt->closeCursor();
}

function fetchAll_class( $conn )
{
    global $table1;
    global $table1_class;
    $stmt = $conn->query( "Select * from ". $table1 );   
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, $table1_class);
    $result[1]->dumpAll();
    $stmt->closeCursor();
}

function fetchAll_invalid( $conn )
{
    global $table1;
    $stmt = $conn->query( "Select * from ". $table1 );   
    try
    {
        $result = $stmt->fetchAll(PDO::FETCH_UNKNOWN);
    }
    catch(PDOException $err)
    {
        print_r($err);
    }
}

try 
{         
    $db = connect();
    create_and_insert_table1( $db );
    create_and_insert_table2( $db );
    echo "Test_1 : fetch from a table with multiple rows :\n";
    fetchAll_rows($db);
    echo "Test_2 : fetch all values of a single column :\n";
    fetchAll_column($db);
    echo "Test_3 : fetch all SQL types except TimeStamp and Variant :\n";  
    fetchAll_types($db); 
    echo "Test_4 : FETCH_BOTH :\n";
    fetchAll_both($db);
    echo "Test_5 : FETCH_ASSOC :\n";
    fetchAll_assoc($db);
    echo "Test_6 : FETCH_OBJ :\n";
    fetchAll_obj($db);
    echo "Test_7 : FETCH_NUM :\n";
    fetchAll_num($db);
    echo "Test_8 : FETCH_CLASS :\n";
    fetchAll_class($db);
    echo "Test_9 : FETCH_INVALID :\n";
    fetchAll_invalid($db); 
}
catch( PDOException $e ) {
    var_dump( $e );
    exit;
}


?> 
--EXPECTF--
Test_1 : fetch from a table with multiple rows :
array(2) {
  [0]=>
  array(16) {
    ["IntCol"]=>
    string(1) "1"
    [0]=>
    string(1) "1"
    ["CharCol"]=>
    string(10) "STRINGCOL1"
    [1]=>
    string(10) "STRINGCOL1"
    ["NCharCol"]=>
    string(10) "STRINGCOL1"
    [2]=>
    string(10) "STRINGCOL1"
    ["DateTimeCol"]=>
    string(23) "2000-11-11 11:11:11.110"
    [3]=>
    string(23) "2000-11-11 11:11:11.110"
    ["VarcharCol"]=>
    string(10) "STRINGCOL1"
    [4]=>
    string(10) "STRINGCOL1"
    ["NVarCharCol"]=>
    string(10) "STRINGCOL1"
    [5]=>
    string(10) "STRINGCOL1"
    ["FloatCol"]=>
    string(7) "111.111"
    [6]=>
    string(7) "111.111"
    ["XmlCol"]=>
    string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
    [7]=>
    string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
  }
  [1]=>
  array(16) {
    ["IntCol"]=>
    string(1) "2"
    [0]=>
    string(1) "2"
    ["CharCol"]=>
    string(10) "STRINGCOL2"
    [1]=>
    string(10) "STRINGCOL2"
    ["NCharCol"]=>
    string(10) "STRINGCOL2"
    [2]=>
    string(10) "STRINGCOL2"
    ["DateTimeCol"]=>
    string(23) "2000-11-11 11:11:11.223"
    [3]=>
    string(23) "2000-11-11 11:11:11.223"
    ["VarcharCol"]=>
    string(10) "STRINGCOL2"
    [4]=>
    string(10) "STRINGCOL2"
    ["NVarCharCol"]=>
    string(10) "STRINGCOL2"
    [5]=>
    string(10) "STRINGCOL2"
    ["FloatCol"]=>
    string(18) "222.22200000000001"
    [6]=>
    string(18) "222.22200000000001"
    ["XmlCol"]=>
    string(431) "<xml> 2 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
    [7]=>
    string(431) "<xml> 2 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
  }
}
Test_2 : fetch all values of a single column :
array(2) {
  [0]=>
  string(10) "STRINGCOL1"
  [1]=>
  string(10) "STRINGCOL2"
}
Test_3 : fetch all SQL types except TimeStamp and Variant :
array(1) {
  [0]=>
  array(62) {
    ["BigIntCol"]=>
    string(1) "1"
    [0]=>
    string(1) "1"
    ["BinaryCol"]=>
    string(5) "     "
    [1]=>
    string(5) "     "
    ["BitCol"]=>
    string(1) "0"
    [2]=>
    string(1) "0"
    ["CharCol"]=>
    string(10) "STRINGCOL1"
    [3]=>
    string(10) "STRINGCOL1"
    ["DateCol"]=>
    string(10) "2000-11-11"
    [4]=>
    string(10) "2000-11-11"
    ["DateTimeCol"]=>
    string(23) "2000-11-11 11:11:11.110"
    [5]=>
    string(23) "2000-11-11 11:11:11.110"
    ["DateTime2Col"]=>
    string(27) "2000-11-11 11:11:11.1110000"
    [6]=>
    string(27) "2000-11-11 11:11:11.1110000"
    ["DTOffsetCol"]=>
    string(34) "2000-11-11 11:11:11.1110000 +00:00"
    [7]=>
    string(34) "2000-11-11 11:11:11.1110000 +00:00"
    ["DecimalCol"]=>
    string(3) "111"
    [8]=>
    string(3) "111"
    ["FloatCol"]=>
    string(7) "111.111"
    [9]=>
    string(7) "111.111"
    ["ImageCol"]=>
    string(1) " "
    [10]=>
    string(1) " "
    ["IntCol"]=>
    string(1) "1"
    [11]=>
    string(1) "1"
    ["MoneyCol"]=>
    string(8) "111.1110"
    [12]=>
    string(8) "111.1110"
    ["NCharCol"]=>
    string(10) "STRINGCOL1"
    [13]=>
    string(10) "STRINGCOL1"
    ["NTextCol"]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    [14]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    ["NumCol"]=>
    string(1) "1"
    [15]=>
    string(1) "1"
    ["NVarCharCol"]=>
    string(10) "STRINGCOL1"
    [16]=>
    string(10) "STRINGCOL1"
    ["NVarCharMaxCol"]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    [17]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    ["RealCol"]=>
    string(7) "111.111"
    [18]=>
    string(7) "111.111"
    ["SmallDTCol"]=>
    string(19) "2000-11-11 11:11:00"
    [19]=>
    string(19) "2000-11-11 11:11:00"
    ["SmallIntCol"]=>
    string(1) "1"
    [20]=>
    string(1) "1"
    ["SmallMoneyCol"]=>
    string(8) "111.1110"
    [21]=>
    string(8) "111.1110"
    ["TextCol"]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    [22]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    ["TimeCol"]=>
    string(16) "11:11:11.1110000"
    [23]=>
    string(16) "11:11:11.1110000"
    ["TinyIntCol"]=>
    string(1) "1"
    [24]=>
    string(1) "1"
    ["Guidcol"]=>
    string(36) "AAAAAAAA-AAAA-AAAA-AAAA-AAAAAAAAAAAA"
    [25]=>
    string(36) "AAAAAAAA-AAAA-AAAA-AAAA-AAAAAAAAAAAA"
    ["VarbinaryCol"]=>
    string(1) " "
    [26]=>
    string(1) " "
    ["VarbinaryMaxCol"]=>
    string(1) " "
    [27]=>
    string(1) " "
    ["VarcharCol"]=>
    string(10) "STRINGCOL1"
    [28]=>
    string(10) "STRINGCOL1"
    ["VarcharMaxCol"]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    [29]=>
    string(420) " 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417."
    ["XmlCol"]=>
    string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
    [30]=>
    string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
  }
}
Test_4 : FETCH_BOTH :
array(16) {
  ["IntCol"]=>
  string(1) "1"
  [0]=>
  string(1) "1"
  ["CharCol"]=>
  string(10) "STRINGCOL1"
  [1]=>
  string(10) "STRINGCOL1"
  ["NCharCol"]=>
  string(10) "STRINGCOL1"
  [2]=>
  string(10) "STRINGCOL1"
  ["DateTimeCol"]=>
  string(23) "2000-11-11 11:11:11.110"
  [3]=>
  string(23) "2000-11-11 11:11:11.110"
  ["VarcharCol"]=>
  string(10) "STRINGCOL1"
  [4]=>
  string(10) "STRINGCOL1"
  ["NVarCharCol"]=>
  string(10) "STRINGCOL1"
  [5]=>
  string(10) "STRINGCOL1"
  ["FloatCol"]=>
  string(7) "111.111"
  [6]=>
  string(7) "111.111"
  ["XmlCol"]=>
  string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
  [7]=>
  string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
}
Test_5 : FETCH_ASSOC :
array(8) {
  ["IntCol"]=>
  string(1) "1"
  ["CharCol"]=>
  string(10) "STRINGCOL1"
  ["NCharCol"]=>
  string(10) "STRINGCOL1"
  ["DateTimeCol"]=>
  string(23) "2000-11-11 11:11:11.110"
  ["VarcharCol"]=>
  string(10) "STRINGCOL1"
  ["NVarCharCol"]=>
  string(10) "STRINGCOL1"
  ["FloatCol"]=>
  string(7) "111.111"
  ["XmlCol"]=>
  string(431) "<xml> 1 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
}
Test_6 : FETCH_OBJ :
object(stdClass)#%x (%x) {
  ["IntCol"]=>
  string(1) "2"
  ["CharCol"]=>
  string(10) "STRINGCOL2"
  ["NCharCol"]=>
  string(10) "STRINGCOL2"
  ["DateTimeCol"]=>
  string(23) "2000-11-11 11:11:11.223"
  ["VarcharCol"]=>
  string(10) "STRINGCOL2"
  ["NVarCharCol"]=>
  string(10) "STRINGCOL2"
  ["FloatCol"]=>
  string(18) "222.22200000000001"
  ["XmlCol"]=>
  string(431) "<xml> 2 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
}
Test_7 : FETCH_NUM :
array(8) {
  [0]=>
  string(1) "2"
  [1]=>
  string(10) "STRINGCOL2"
  [2]=>
  string(10) "STRINGCOL2"
  [3]=>
  string(23) "2000-11-11 11:11:11.223"
  [4]=>
  string(10) "STRINGCOL2"
  [5]=>
  string(10) "STRINGCOL2"
  [6]=>
  string(18) "222.22200000000001"
  [7]=>
  string(431) "<xml> 2 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
}
Test_8 : FETCH_CLASS :
string(1) "2"
string(10) "STRINGCOL2"
string(10) "STRINGCOL2"
string(23) "2000-11-11 11:11:11.223"
string(10) "STRINGCOL2"
string(10) "STRINGCOL2"
string(18) "222.22200000000001"
string(431) "<xml> 2 This is a really large string used to test certain large data types like xml data type. The length of this string is greater than 256 to correctly test a large data type. This is currently used by atleast varchar type and by xml type. The fetch tests are the primary consumer of this string to validate that fetch on large types work fine. The length of this string as counted in terms of number of characters is 417.</xml>"
Test_9 : FETCH_INVALID :

Fatal error: Uncaught Error: Undefined class constant 'FETCH_UNKNOWN' in %s:%x
Stack trace:
#0 %s: fetchAll_invalid(Object(PDO))
#1 {main}
  thrown in %s on line %x