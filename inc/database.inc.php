<?php

// Connected to Database if it is there
try{
$dbHandle = new PDO("sqlite:$sqlite_dir/$sqlite_database");
}catch( PDOException $exception ){
        echo "Can NOT connect to database - ";
        die($exception->getMessage());
}

// check if table/s needs to be created
$table_check_alias = $dbHandle->exec('SELECT address FROM servers WHERE type = \'table\'');
if ( $table_check_alias === false ){
  $sqlCreateTable = "CREATE TABLE servers (
  address varchar(255) NOT NULL,
  port int(5) NOT NULL,
  contact varchar(255) NOT NULL,
  keycount bigint(20) NOT NULL default '0',
  created datetime NOT NULL default '0000-00-00 00:00:00',
  modified datetime NOT NULL default '0000-00-00 00:00:00',
  active tinyint(1) NOT NULL default '1');";
  $dbHandle->exec($sqlCreateTable);
  
  $sqlCreateIndex = "CREATE UNIQUE INDEX IF NOT EXISTS servers_index ON servers (address);";
  $dbHandle->exec($sqlCreateIndex);
}

$table_check_options = $dbHandle->exec('SELECT option FROM options WHERE type = \'table\'');
if ( $table_check_options === false ){
  $sqlCreateTable = "CREATE TABLE options (
  option varchar(32) NOT NULL,
  value varchar(32) NOT NULL);";
  $dbHandle->exec($sqlCreateTable);

  $sqlCreateIndex = "CREATE UNIQUE INDEX IF NOT EXISTS option_index ON options (option);";
  $dbHandle->exec($sqlCreateIndex);
}

?>
