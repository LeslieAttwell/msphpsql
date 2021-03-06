--TEST--
Test nextRowset method.
--SKIPIF--
<?php require 'skipif.inc'; ?>
--FILE--
<?php
require_once 'MsCommon.inc';

try
{
    $db = connect();
    $qry = "SELECT * FROM " . $table2 . ";";
    $qry2 = "SELECT * FROM " . $table1 . ";";
    $stmt = $db->query( $qry . $qry2 );

    $rowset = $stmt->fetchAll();
    var_dump($rowset);
    $stmt->nextRowset();
    $rowset2 = $stmt->fetchAll();
    var_dump($rowset2);

}
catch (PDOException $e)
{
    var_dump($e);
}



?>

--EXPECT--
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