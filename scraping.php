<?php
/*
 *
 * Copyright 2016 Phelipe Folgierini
 *
 * This file is part of Social Wifi Project.
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

    # fields=id,fb_id,name,category,created_time
    $db->exec('CREATE TABLE IF NOT EXISTS user_likes (id INT AUTO_INCREMENT PRIMARY KEY, fb_id INT, name CHAR(255), category CHAR(255), created_time CHAR (255))');

    # fields=id,fb_id,name,first_name,middle_name,last_name,birthday
    $db->exec('CREATE TABLE IF NOT EXISTS user_profile (id INT AUTO_INCREMENT PRIMARY KEY, fb_id INT, name CHAR(255), about VARCHAR(4000), birthday CHAR (255), age_range CHAR (255))');
}

function save_user_info($params)
{
    $db = Flight::db();
    #$stmt = $db->prepare('INSERT INTO user_profile (fb_id, name, birthday, age_range) VALUES (:fb_id, :name, :birthday, :age_range)');
    $stmt = $db->prepare('INSERT INTO user_profile (fb_id, name, about, birthday) VALUES (:fb_id, :name, :about, :birthday)');
    $stmt->bindParam(':fb_id', $params['id']);
    $stmt->bindParam(':name', $params['name']);
    $stmt->bindParam(':about', $params['about']);
    $stmt->bindParam(':birthday', $params['birthday']);
    #$stmt->bindParam(':age_range', $params['age_range']);
    $stmt->execute();
    return true;
}

function save_likes($params)
{
    $db = Flight::db();
    $stmt = $db->prepare('INSERT INTO user_likes (fb_id, name, category, created_time) VALUES (:fb_id, :name, :category, :created_time)');
//    $stmt = $db->prepare('INSERT INTO user_likes (fb_id, name, category) VALUES (:fb_id, :name, :category)');
    $stmt->bindParam(':fb_id', $params['id']);
    $stmt->bindParam(':name', $params['name']);
    $stmt->bindParam(':category', $params['category']);
    $stmt->bindParam(':created_time', $params['created_time']);
    $stmt->execute();
    return true;
}
