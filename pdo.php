<?php
// PDO helper functions.
// Copyright (c) 2012-2013 PHP Desktop Authors. All rights reserved.
// License: New BSD License.
// Website: http://code.google.com/p/phpdesktop/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function setUserLoggedIn()
{
	$_SESSION['user'] = 0;
}

function isUserSignedIn() 
	{
	
		if( isset($_SESSION['user']) && ($_SESSION['user'] ==1 ) )
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

function PDO_Connect($dsn, $user="", $password="")
{
    global $PDO;
    $PDO = new PDO($dsn, $user, $password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
function PDO_FetchOne($query, $params=null)
{
    global $PDO;
    if (isset($params)) {
        $stmt = $PDO->prepare($query);
        $stmt->execute($params);
    } else {
        $stmt = $PDO->query($query);
    }
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if ($row) {
        return $row[0];
    } else {
        return false;
    }
}
function PDO_FetchRow($query, $params=null)
{
    global $PDO;
    if (isset($params)) {
        $stmt = $PDO->prepare($query);
        $stmt->execute($params);
    } else {
        $stmt = $PDO->query($query);
    }
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function PDO_FetchAll($query, $params=null)
{
    global $PDO;
    if (isset($params)) {
        $stmt = $PDO->prepare($query);
        $stmt->execute($params);
    } else {
        $stmt = $PDO->query($query);
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function PDO_FetchAssoc($query, $params=null)
{
    global $PDO;
    if (isset($params)) {
        $stmt = $PDO->prepare($query);
        $stmt->execute($params);
    } else {
        $stmt = $PDO->query($query);
    }
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);
    $assoc = array();
    foreach ($rows as $row) {
        $assoc[$row[0]] = $row[1];
    }
    return $assoc;
}
function PDO_Execute($query, $params=null)
{
    global $PDO;
    if (isset($params)) {
        $stmt = $PDO->prepare($query);
        $stmt->execute($params);
    } else {
        $PDO->query($query);
    }
}
function PDO_LastInsertId()
{
    global $PDO;
    return $PDO->lastInsertId();
}

?>