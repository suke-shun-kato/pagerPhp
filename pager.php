<?php


/**
* ページャーのページを作成する関数
*
* @param int $currentPage 現在のページ
* @param int $numAllPage 全ページ数
* @param int $numPageNoInPager ページャーに表示されるページ番号の数
* @return int[] ページャーに表示されるページ番号の配列、例えば
*/
function makePagerNoAry($currentPage, $numAllPage, $numPageNoInPager) {
    $pagerNumAry = [];

    // --------------------------------------------------------------------
    // メイン処理
    // --------------------------------------------------------------------
    for ($noPage=1; $noPage<=$numAllPage; $noPage++) {
        // ----------------------------------
        // ページャーのページ番号をエンキュー、デキュー
        // ----------------------------------
        //// エンキュー ////
        array_push($pagerNumAry, $noPage);
        //// デキュー ////
        if(count($pagerNumAry) > $numPageNoInPager) {
            array_shift($pagerNumAry);
        }

        // ----------------------------------
        // 離脱条件、最後
        // ----------------------------------
        if (
            //通常の条件
            ($noPage >= $currentPage + floor($numPageNoInPager/2)) &&
            //1や2のときのキューが埋まってない時の例外条件
            (count($pagerNumAry) >= $numPageNoInPager)
        ) {
            break;
            }
    }

    // --------------------------------------------------------------------
    // 不足分をnullで補う
    // --------------------------------------------------------------------
    while (count($pagerNumAry) < $numPageNoInPager) {
        array_push($pagerNumAry, null);
    }

    return $pagerNumAry;
}
