<?php
// $currentPage = 1;
// $numAllPage = 3;
// $numPageNoInPager = 10;
// $aaa = makePagerAry($currentPage, $numAllPage, $numPageNoInPager);
// var_dump($aaa);

function makePagerAry($currentPage, $numAllPage, $numPageNoInPager) {
    $pageNoAry = makePagerNoAry($currentPage, $numAllPage, $numPageNoInPager);
    $pagerUrlAry = makePagerLinkAry($pageNoAry, 'http://aaaaaaaaaaa/?dddd=f', 'no');
    return $rtnAry;
}

/**
*
*/
// function trueFalseAry($pageNoAry, $currentPage) {
//
// }

/**
* ページャーのリンク先URLを作成する関数（）
*
* @param int[] $pageNoAry ページャーに表示するページ番号
* @param string $url ページャーに表示するページ番号
* @param string $keyName key名
* @param string[]
*/
function makePagerLinkAry($pageNoAry, $url, $keyName) {
    $pagerLinkAry = [];
    foreach ($pageNoAry as $key => $pageNo) {
        if (is_null($pageNo)) {
            $pagerLinkAry[$key] = null;
        } else {
            if (strpos($url,'?') === false) {
                $setuzokushi = '?';
            } else {
                $setuzokushi = '&';
            }
            $pagerLinkAry[$key] = "{$url}?{$keyName}={$pageNo}";
        }

    }
    return $pagerLinkAry;
}
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
