<?php
$aaaAry = makePagerNoAry(10, 2, 5);
var_dump($aaaAry);

/**
* ページャーのページを作成する関数
*
* @param int $numAllPage 全ページ数
* @param int $currentPage 現在のページ
* @param int $numPageNoInPager ページャーに表示されるページ番号の数
* @return int[] ページャーに表示されるページ番号の配列、例えば
*/
function makePagerNoAry($numAllPage, $currentPage, $numPageNoInPager) {
    $pagerNumAry = [];
    for ($i=1; $i<=$numAllPage; $i++) {
        // ----------------------------------
        // キューにページャーのページ番号をEnキュー、deキュー
        // ----------------------------------
        ////ここはページ番号の配列を作成している
        array_push($pagerNumAry, $i);
        if(count($pagerNumAry) > $numPageNoInPager) {
            array_shift($pagerNumAry);
        }

        // ----------------------------------
        // キュー動作の終了条件
        // ----------------------------------
        if (
            //通常の条件
            ($i >= $currentPage + floor($numPageNoInPager/2)) &&
            //1や2のときのキューが埋まってない時の例外条件
            (count($pagerNumAry) >= $numPageNoInPager)
        ) {
            break;
        }
    }

    return $pagerNumAry;
}
