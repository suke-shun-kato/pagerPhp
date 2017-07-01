<?php
// $currentPage = 11;
// $numAllPage = 12;
// $numPageNoInPager = 7;
// $aaa = makePager(
//     $currentPage,
//     $numAllPage,
//     $numPageNoInPager,
//     'http://aaaaaffffaaaaaa'
// );
// var_dump($aaa);

/**
* ページャーに関する値などを作成する関数
* @param int $currentPage 現在のページ
* @param int $numAllPage 全ページ数
* @param int $numPageNoInPager ページャーに表示されるページ番号の数
* @param string $url ページ番号のリンク先のベースURL
* @param string $keyName key名
* @return array $pagerAsso[] ページャーの2次元配列
* <code>
* $pagerAsso = [
*   'pageNo'     => (int),        // ページ番号
*   'url'        => (string),     // リンク先のURL
*   'isCurrent'  => (boolean)',   // 現在のページかどうか
* ];
*
* </code>
*/
function makePager($currentPage, $numAllPage, $numPageNoInPager, $url, $keyName='page') {
    $pageNoAry = makePagerNoAry($currentPage, $numAllPage, $numPageNoInPager);
    $pagerUrlAry = makePagerLinkAry($pageNoAry, $url, $keyName);
    $isCurrentAry= makeIsCurrentPageAry($pageNoAry, $currentPage);

    $rtn2dAry = [];
    foreach ($pageNoAry as $key => $value) {
        $rtn2dAry[$key]['pageNo'] = $pageNoAry[$key];
        $rtn2dAry[$key]['url'] = $pagerUrlAry[$key];
        $rtn2dAry[$key]['isCurrent'] = $isCurrentAry[$key];
    }
    return $rtn2dAry;
}

/**
* 現在のページかどうかのtrue,falseの配列を作成する関数
* @param int[] ページ番号の配列（ページャー表示用）
* @param int $currentPage 現在のページ番号
* @return boolean[] ページ番号が今のページだとtrue
*/
function makeIsCurrentPageAry($pageNoAry, $currentPage) {
    $pagerTrueAry = [];
    foreach ($pageNoAry as $key => $pageNo) {
        if (is_null($pageNo)) {
            $pagerTrueAry[$key] = null;
        } elseif ($pageNo === $currentPage) {
            $pagerTrueAry[$key] = true;
        } else {
            $pagerTrueAry[$key] = false;
        }
    }
    return $pagerTrueAry;
}

/**
* ページャーのリンク先URLを作成する関数、getでページ番号を指定できる
* @param int[] $pageNoAry ページ番号の配列（ページャー表示用）
* @param string $url ページ番号のリンク先のベースURL
* @param string $keyName key名
* @param string[] ページャーのリンクURL, ページ番号がnullのときはnull
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
            $pagerLinkAry[$key] = "{$url}{$setuzokushi}{$keyName}={$pageNo}";
        }

    }
    return $pagerLinkAry;
}
/**
* ページャーのページを作成する関数
* @param int $currentPage 現在のページ
* @param int $numAllPage 全ページ数
* @param int $numPageNoInPager ページャーに表示されるページ番号の数
* @return int[] ページャーに表示されるページ番号の配列
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
