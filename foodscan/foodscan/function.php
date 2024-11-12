<?php
function escape($value)
{
    $data = trim(htmlentities(htmlspecialchars(stripslashes($value))));
    return filter_var($data, FILTER_SANITIZE_STRING);

}

function security_get($request)
{

    if (preg_match("/[\-]{2,}|[;]|[‘]|[\\\*]/", $request)) {

        redirect_url("/");

    } else {
        return intval($request);
    }

}

function textShorter($kelime, $str = 10)
{
    if (strlen($kelime) > $str) {
        if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8") . '..';
        else $kelime = substr($kelime, 0, $str) . '..';
    }
    return $kelime;
}

function seo($s)
{
    $tr = array('ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '(', ')', '/', ':', ',');
    $eng = array('s', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '', '', '-', '-', '');
    $s = str_replace($tr, $eng, $s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('.', '', $s);
    $s = str_replace('?', '', $s);
    $s = str_replace('!', '', $s);
    $s = trim($s, '-');
    return $s;
}

function blogID($url)
{
    $parse = explode("?p=", $url);
    return $parse[1];
}

function getBlogImg($id)
{
    require_once("conn-blog.php");
    $db_blog = new Db_Blog();
    $mysqli_blog = Db_Blog::$_mysqli;
    $post_meta = $db_blog->Fetch("*", "wp_postmeta", "post_id='$id' AND meta_key = '_thumbnail_id' ");
    $img_data = $db_blog->Fetch("*", "wp_posts", "ID =" . $post_meta['meta_value']);
    return str_replace("http", "https", $img_data['guid']);
}

function removeWidthBlogImg($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

function redirect_url($url)
{
    header("location: " . $url);
}


function postToUpdateQ($post_)
{
    foreach ($post_ as $col => $val) {
        $str = $col . "='" . escape($val) . "'";
        $result_[] = $str;
    }
    $query = implode(',', $result_);
    return $query;
}

function postToInsertQ($post_, $table)
{
    foreach ($post_ as $key => $val) {
        $valStr = "'" . escape($val) . "'";
        $val_[] = $valStr;

        $keyStr = escape($key);
        $key_[] = $keyStr;
    }
    if (!in_array($table . "_id", $key_)) {
        array_unshift($key_, $table . "_id");
    }

    $q_['val_'] = implode(',', $val_);
    $q_['key_'] = implode(',', $key_);
    return $q_;
}

function dd($val, $print_r = true)
{
    dumper($val, $print_r);
    exit();
}

function dumper($val, $print_r = true, $br = false)
{
    if ($br) {
        echo str_repeat('<br />', $br);
    }

    if (is_string($val)) {
        echo $val;
    } elseif ($print_r) {
        echo '<pre>' . print_r($val, true) . '</pre>';
    } else {
        echo var_dump($val);
    }
}


function dateColor($date)
{
    $currentDate = time();
    $expiryTimestamp = strtotime($date);
    $threeDaysInSeconds = 3 * 24 * 60 * 60;
    $timeDifference = $expiryTimestamp - $currentDate;
    if ($expiryTimestamp < $currentDate) {
        return 'bg-danger text-white';
    } elseif ($timeDifference <= $threeDaysInSeconds) {
        return 'bg-warning text-white';
    }
    return 'bg-success text-white';
}

function getDateType($date)
{
    $currentDate = time();
    $expiryTimestamp = strtotime($date);
    $threeDaysInSeconds = 3 * 24 * 60 * 60;
    $timeDifference = $expiryTimestamp - $currentDate;
    if ($expiryTimestamp < $currentDate) {
        return 'expired';
    } elseif ($timeDifference <= $threeDaysInSeconds) {
        return 'almost';
    }
    return 'consume';
}

function isDatePast($date)
{
    $time = strtotime($date) - strtotime(date('Y-m-d'));
    return ($time < 0) ? TRUE : FALSE;
}

?>