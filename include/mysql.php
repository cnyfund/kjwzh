<?php
# 文件名称:mysql.php 2009-11-1 16:18:23
# 数据库操作类
class dbmysql {
	var $querynum = 0;
	var $link;
	function  dbconn($con_db_host,$con_db_id,$con_db_pass, $con_db_name = '',$db_charset='utf8',$pconnect = 0) {
                if (!$this->link=mysqli_connect($con_db_host, $con_db_id, $con_db_pass)) {
                     $this->halt('Can not connect to MySQL server');
                }
                
                if($db_charset!='latin1') {
                     @mysqli_query("SET character_set_connection=$db_charset, character_set_results=$db_charset, character_set_client=binary", $this->link);
                }
                @mysqli_query("SET sql_mode=''", $this->link);
		/*if($pconnect) {
			if(!$this->link = @mysql_pconnect($con_db_host,$con_db_id,$con_db_pass)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			if(!$this->link = @mysql_connect($con_db_host,$con_db_id,$con_db_pass, 1)) {
				$this->halt('Can not connect to MySQL server');
			}
		}
		if($this->version() > '4.1') {
			if($db_charset!='latin1') {
				@mysql_query("SET character_set_connection=$db_charset, character_set_results=$db_charset, character_set_client=binary", $this->link);
			}

			if($this->version() > '5.0.1') {
				@mysqli_query("SET sql_mode=''", $this->link);
			}
		}*/

		if($con_db_name) {
			@mysqli_select_db($con_db_name, $this->link);
		}

	}
	
	function move_first($query) {
		mysqli_data_seek($query,0);
	}

	function select_db($dbname) {
		return mysqli_select_db($dbname, $this->link);
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		if(!$query)
		{
			return "";
		}
		else
		{
			return mysqli_fetch_array($query,$result_type);
		}
	}
	
	function update($table, $bind=array(),$where = '')
	{
	    $set = array();
	    foreach ($bind as $col => $val) {
	        $set[] = "$col = '$val'";
	        unset($set[$col]);
	    }
	    $sql = "UPDATE "
             . $table
             . ' SET ' . implode(',', $set)
             . (($where) ? " WHERE $where" : '');
        $this->query($sql);
	}
	
	
	function insert($table, $bind=array())
	{
	    $set = array();
	    foreach ($bind as $col => $val) {
	        $set[] = "`$col`";
	        $vals[] = "'$val'";
	    }
	   $sql = "INSERT INTO "
             . $table
             . ' (' . implode(', ', $set).') '
             . 'VALUES (' . implode(', ', $vals).')';
        $this->query($sql);
        return $this->insert_id();
	}
	
	/**
	* 执行sql语句，只得到一条记录
	* @param string sql语句
	* @return array
	*/
	function get_one($sql, $type = '')
	{
		$query = $this->query($sql, $type);
		$rs = $this->fetch_array($query);
		$this->free_result($query);
		return $rs ;
	}
	


	function query($sql, $type = '') {
	   /*$func = $type == 'UNBUFFERED' && @function_exists('mysqli_unbuffered_query') ?
			'mysqli_unbuffered_query' : 'mysqli_query';*/
           $func = 'mysqli_query';
		if(!($query = $func($sql, $this->link))) {
			if(in_array($this->errno(), array(2006, 2013)) && substr($type, 0, 5) != 'RETRY') {
				$this->close();
				global $config_db;
				$db_settings = parse_ini_file("$config_db");
	            @extract($db_settings);
				$this->dbconn($con_db_host,$con_db_id,$con_db_pass, $con_db_name = '',$pconnect);
				$this->query($sql, 'RETRY'.$type);
			} 
		}
		$this->querynum++;
		return $query;
	}
	
	function counter($table_name,$where_str="", $field_name="*")
	{
	    $where_str = trim($where_str);
	    if(strtolower(substr($where_str,0,5))!='where' && $where_str) $where_str = "WHERE ".$where_str;
	    $query = " SELECT COUNT($field_name) FROM $table_name $where_str ";
	    $result = $this->query($query);
	    $fetch_row = mysqli_fetch_row($result);
	    return $fetch_row[0];
	}

	function affected_rows() {
		return mysqli_affected_rows($this->link);
	}
	function list_fields($con_db_name,$table) {
		$fields=mysqli_list_fields($con_db_name,$table,$this->link);
	    $columns=$this->num_fields($fields);
	    for ($i = 0; $i < $columns; $i++) {
	        $tables[]=mysqli_field_name($fields, $i);
	    }
	    return $tables;
	}

	function error() {
		return (($this->link) ? mysqli_error($this->link) : mysqli_error());
	}

	function errno() {
		return intval(($this->link) ? mysqli_errno($this->link) : mysqli_errno());
	}

	function result($query, $row) {
		$query = @mysqli_result($query, $row);
		return $query;
	}

	function num_rows($query) {
		$query = mysqli_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysqli_num_fields($query);
	}

	function free_result($query) {
		return mysqli_free_result($query);
	}

	function insert_id() {
		return ($id = mysqli_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysqli_fetch_row($query);
		return $query;
	}

	function fetch_fields($query) {
		return mysqli_fetch_field($query);
	}

	function version() {
		return mysqli_get_server_info($this->link);
	}

	function close() {
		return mysqli_close($this->link);
	}

	function halt($message = '',$sql) {
	     $sqlerror = mysqli_error();
		 $sqlerrno = mysqli_errno();
		 $sqlerror = str_replace($dbhost,'dbhost',$sqlerror);
		 echo"<html><head><title>CSSInfo</title><style type='text/css'>P,BODY{FONT-FAMILY:tahoma,arial,sans-serif;FONT-SIZE:10px;}A { TEXT-DECORATION: none;}a:hover{ text-decoration: underline;}TD { BORDER-RIGHT: 1px; BORDER-TOP: 0px; FONT-SIZE: 16pt; COLOR: #000000;}</style><body>\n\n";
		echo"<table style='TABLE-LAYOUT:fixed;WORD-WRAP: break-word'><tr><td>";
		echo"<br><br><b>The URL Is</b>:<br>http://$_SERVER[HTTP_HOST]$REQUEST_URI";
		echo"<br><br><b>MySQL Server Error</b>:<br>$sqlerror  ( $sqlerrno )";
		echo"</td></tr></table>";
		exit;
	}
}
?>
