<?php define('url', 'https://yavuzozbay.com/foodscan');
date_default_timezone_set('Europe/Istanbul');

class Db
{
    public static $_mysqli = null;
    private $_host = "localhost", $_database = "yavuz_foodscan", $_username = "yavuz_foodscan", $_password = "9UNS!]@BeNk?";

    public function __construct()
    {
        return $this->Connnect();
    }

    public function Connnect()
    {
        self::$_mysqli = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_database);
        self::$_mysqli->set_charset("utf8");
        if (!mysqli_connect_errno()) {
            return self::$_mysqli;
        } else {
            echo "Connection Failed " . mysqli_connect_error();
        }
    }

    public function Query($q)
    {
        // var_dump($q);
        // exit();
        $v = mysqli_query(self::$_mysqli, $q);
        return $v;
    }

    public function Update($table, $colums, $where)
    {
        return $this->Query("UPDATE {$table} SET {$colums} WHERE {$where}");
    }

    public function FetchAll($howmuch, $table, $where, $order, $join = null)
    {
        if ($howmuch == "all") {
            $howmuch = "*";
        }
        $joinQ = '';
        if ($join) {
            if (is_array($join)) {
                foreach ($join as $j) {
                    $joinQ .= 'LEFT JOIN ' . $j['table'] . ' ON (' . $table . '.' . $j['a'] . ' = ' . $j['table'] . '.' . $j['b'] . ') ';
                }
            }
        }
        //$str = "SELECT {$howmuch} FROM {$table} {$joinQ} ORDER BY {$order}";
        //var_dump($str);
        //exit();
        if (isset($where)) {
            $q = $this->Query("SELECT {$howmuch} FROM {$table} {$joinQ} WHERE {$where} ORDER BY {$order}");
        } else {
            $q = $this->Query("SELECT {$howmuch} FROM {$table} {$joinQ} ORDER BY {$order}");
        }

        $fetchArray = array();
        $i = 0;
        while ($fetch = mysqli_fetch_assoc($q)) {
            $fetchArray[$i] = $fetch;
            $i++;
        }
        return $fetchArray;
    }

    public function Fetch($howmuch, $from, $where, $join = null)
    {
        $joinQ = '';
        if ($join) {
            if (is_array($join)) {
                foreach ($join as $j) {
                    $joinQ .= 'LEFT JOIN ' . $j['table'] . ' ON (' . $from . '.' . $j['a'] . ' = ' . $j['table'] . '.' . $j['b'] . ') ';
                }
            }
        }
        if ($where != null) {
            $queryString = "SELECT " . $howmuch . " FROM " . $from . ' ' . $joinQ . " WHERE " . $where;
        } else {
            $queryString = "SELECT " . $howmuch . " FROM " . $from . ' ' . $joinQ;
        }
        $query = $this->Query($queryString);
        $fetch = mysqli_fetch_assoc($query);
        return $fetch;
    }

    public function Insert($table, $values, $key = null)
    {
        if ($key) {
            $q = $this->Query("INSERT INTO {$table}({$key}) VALUES({$values})");
        } else {
            $q = $this->Query("INSERT INTO {$table} VALUES({$values})");
        }
        return $q;
    }

    public function Delete($table, $where)
    {
        $q = $this->Query("DELETE FROM `{$table}` WHERE {$where}");
        return $q;
    }

    public function GetNum($table, $where = null)
    {
        if (is_null($where) == false) {
            $q = $this->Query("SELECT * FROM `{$table}` WHERE {$where}");
            $num = mysqli_num_rows($q);
        } else {
            $q = $this->Query("SELECT * FROM `{$table}`");
            $num = mysqli_num_rows($q);
        }
        return $num;
    }

    public function InsertedId()
    {
        return mysqli_insert_id(self::$_mysqli);
    }
} ?>