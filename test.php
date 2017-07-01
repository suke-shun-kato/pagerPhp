<?php
require_once( __DIR__ . '/pager.php' );

$url = 'http://aaaaaffffaaaaaa?dddd=8';
$key = 'page';
$numAllPage = 10;
$numPageNoInPager = 5;

$currentPage = 1;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);

$currentPage = 4;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);

$currentPage = 9;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);

$currentPage = 10;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);
////////////////////////////////////////
$url = 'http://tetetetetete';
$key = 'no';
$numAllPage = 3;
$numPageNoInPager = 7;

$currentPage = 1;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);

$currentPage = 2;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);

$currentPage = 3;
$aaa = makePagerFull(
    $currentPage, $numAllPage, $numPageNoInPager, $url, $key
);
var_dump($aaa);
