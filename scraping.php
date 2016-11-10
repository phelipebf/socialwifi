<?php
/*
 *
 * Copyright 2015 Michael Haas
 *
 * This file is part of FBWLAN.

 * FBWLAN is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation in version 3.
 *
 * FBWLAN is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


require_once('include/flight/flight/Flight.php');

require_once('config.php');

Flight::register('db', 'PDO', array('mysql:host='. DB_HOST . ';port=' . DB_PORT .';dbname='. DB_NAME,
    DB_USER, DB_PASS), function($db) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});


function init_scraping_db() {
    $db = Flight::db();
    // TODO: add index on date column
    # fields=name,category,id,created_time
    $db->exec('CREATE TABLE IF NOT EXISTS likes (id INT AUTO_INCREMENT PRIMARY KEY, fb_id INT NOT NULL, name CHAR(255) NOT NULL, category CHAR(255) NOT NULL, created_time CHAR (255) NOT NULL)');
}

function generate_token() {
    // Taken from wifidog Token.php, but use sha1 instead of md5sum
    return sha1(uniqid(rand(), 1));
}

function save_likes($params) {
    // Temporary: purge tokens more often
    // Tokens are cleared on GW communication,
    // but there is no gateway right now
    $db = Flight::db();
    $stmt = $db->prepare('INSERT INTO likes (fb_id, name, category, created_time) VALUES (:fb_id, :name, :category, :created_time)');
    $stmt->bindParam(':fb_id', $params['id']);
    $stmt->bindParam(':name', $params['name']);
    $stmt->bindParam(':category', $params['category']);
    $stmt->bindParam(':created_time', $params['created_time']);
    $stmt->execute();
    return true;
}


function clear_token($key, $value) {
    $db = Flight::db();
    $stmt = $db->prepare('DELETE FROM tokens WHERE token = :token');
    $stmt->bindParam(':token', $token);
    $stmt->execute();
}

function clear_old_tokens() {
    
    $db = Flight::db();
    //$stmt = $db->prepare('DELETE FROM tokens WHERE date < DATE_SUB(NOW(), INTERVAL :duration MINUTES)');
    // Cannot pass a constant by reference in $stmt->bindParam
    // As there is no security problem, simply concatenate SESSION_DURATION into string
    // http://stackoverflow.com/questions/6130077
    //$stmt->bindParam(':duration', SESSION_DURATION);
    $stmt = $db->prepare('DELETE FROM tokens WHERE date < DATE_SUB(NOW(), INTERVAL ' . SESSION_DURATION . ' MINUTE)');
    $stmt->execute();
    // http://stackoverflow.com/a/13009906
}

function is_token_valid($token) {
    $db = Flight::db();
    $stmt = $db->prepare('SELECT token FROM tokens WHERE token = :token');
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($data)) {
        return false;
    }
    if ($data['token'] == $token) {
        return true;
    }
    return false;
}

