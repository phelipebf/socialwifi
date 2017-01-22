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
    $db->exec('CREATE TABLE IF NOT EXISTS likes (id INT AUTO_INCREMENT PRIMARY KEY, fb_id INT, name CHAR(255), category CHAR(255), created_time CHAR (255))');
}

function save_likes($params) {
    // Temporary: purge tokens more often
    // Tokens are cleared on GW communication,
    // but there is no gateway right now
    $db = Flight::db();
    #$stmt = $db->prepare('INSERT INTO likes (fb_id, name, category, created_time) VALUES (:fb_id, :name, :category, :created_time)');
    $stmt = $db->prepare('INSERT INTO likes (fb_id, name, category, created_time) VALUES (:fb_id, :name, :category)');
    $stmt->bindParam(':fb_id', $params['id']);
    $stmt->bindParam(':name', $params['name']);
    $stmt->bindParam(':category', $params['category']);
    #$stmt->bindParam(':created_time', $params['created_time']);
    $stmt->execute();
    return true;
}
