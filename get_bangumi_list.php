<!--
    追番列表展示API By Hans362
	Version: 1.0
	感谢 @ohmyga233
-->

<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/mdui.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/fancybox.min.css">
<script src="assets/js/mdui.min.js"></script>
<script src="assets/js/jquery3.3.1.min.js"></script>
<script src="assets/js/jquery.pjax.min.js"></script>
<style>.moe-card-t { background-color: rgba(255, 255, 255, 0.8) } .moe-text-color { color: #fff!important } .moe-bg { background-image: url(https://ohmyga.net/usr/img/sad.jpg); } @media (max-width: 600px){ .moe-bg { background-image: url(https://ohmyga.net/usr/img/wake.webp); }} .moe-page-title::before { color: #E91E63; content: "• " } .moe-page-title::after { color: #E91E63; content: " •" } .moe-bangumi-img { background-image: url(https://ohmyga.net/usr/themes/CastleME/others/img/pic_load.gif); }</style>

<div id="moe-body">
<div class="mdui-container">
<div class="mdui-row-sm-2 mdui-row-md-4">

<?php

/* 
	追番列表展示API By Hans362
	Version: 1.0
	感谢 @ohmyga233
*/

$uid = $_GET["uid"]; //获取提交的UID

//Step#1 获取页数（Bilibili API存在单页显示数限制，先通过API调取总页数）
$file = curl_get_https('https://space.bilibili.com/ajax/Bangumi/getList?mid=' . $uid);
$origin = json_decode($file);
$pages = $origin->data->pages;
//Step#1 End

//Step#2 利用for循环和foreach遍历每一页的数据，逐个获取需要的信息并输出（总页数来源于Step#1中获取的）
for ($x = 1; $x <= $pages; $x++) {
    if ($uid != null) {
        $file_contents = curl_get_https('https://space.bilibili.com/ajax/Bangumi/getList?mid=' . $uid . '&page=' . $x);
        $arr = json_decode($file_contents, true);
        if (is_array($arr) || is_object($arr)) {
            foreach ($arr as $obj) {
                if (is_array($obj['result']) || is_object($obj['result'])) {
                    foreach ($obj['result'] as $result) {
                        //echo $result['title'] . "</br>";
                        $url = $result['cover'];
                        $path = 'cache/';
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                        $img = curl_exec($ch);
                        curl_close($ch);
                        $filename = pathinfo($url, PATHINFO_BASENAME);
                        if (file_exists($filename)) {
                            if ($result['is_finish'] == 1) {
                                echo "<div class=\"mdui-col\"><a href=\"" . $result['share_url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result['title'] . "\" target=\"_blank\"><div class=\"mdui-card moe-bangumi-card moe-card-t\"><div class=\"mdui-card-media\" style=\"overflow: hidden;\"><main class=\"moe-bangumi-img moe-post-wzimg-f\" data-original=\"cache/" . $filename . "\" style=\"background-image: url(&quot;cache/" . $filename . "&quot;);\"></main><div class=\"mdui-card-media-covered moe-card-media-covered\"><div class=\"mdui-card-primary\"><div class=\"mdui-card-primary-title moe-bangumi-title\">" . $result['title'] . "</div><div class=\"mdui-card-primary-subtitle\">" . $result['brief'] . "</div></div></div></div><div class=\"mdui-card-actions\"><div class=\"mdui-float-right\">" . $result['total_count'] . "</div><div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: 50%;\"></div></div></div></div></a></div>";
                            } else {
                                echo "<div class=\"mdui-col\"><a href=\"" . $result['share_url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result['title'] . "\" target=\"_blank\"><div class=\"mdui-card moe-bangumi-card moe-card-t\"><div class=\"mdui-card-media\" style=\"overflow: hidden;\"><main class=\"moe-bangumi-img moe-post-wzimg-f\" data-original=\"cache/" . $filename . "\" style=\"background-image: url(&quot;cache/" . $filename . "&quot;);\"></main><div class=\"mdui-card-media-covered moe-card-media-covered\"><div class=\"mdui-card-primary\"><div class=\"mdui-card-primary-title moe-bangumi-title\">" . $result['title'] . "</div><div class=\"mdui-card-primary-subtitle\">" . $result['brief'] . "</div></div></div></div><div class=\"mdui-card-actions\"><div class=\"mdui-float-right\">" . $result['newest_ep_index'] . "</div><div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: 50%;\"></div></div></div></div></a></div>";
                            }
                        } else {
                            $resource = fopen($path . $filename, 'a');
                            fwrite($resource, $img);
                            fclose($resource);
                            if ($result['is_finish'] == 1) {
                                echo "<div class=\"mdui-col\"><a href=\"" . $result['share_url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result['title'] . "\" target=\"_blank\"><div class=\"mdui-card moe-bangumi-card moe-card-t\"><div class=\"mdui-card-media\" style=\"overflow: hidden;\"><main class=\"moe-bangumi-img moe-post-wzimg-f\" data-original=\"cache/" . $filename . "\" style=\"background-image: url(&quot;cache/" . $filename . "&quot;);\"></main><div class=\"mdui-card-media-covered moe-card-media-covered\"><div class=\"mdui-card-primary\"><div class=\"mdui-card-primary-title moe-bangumi-title\">" . $result['title'] . "</div><div class=\"mdui-card-primary-subtitle\">" . $result['brief'] . "</div></div></div></div><div class=\"mdui-card-actions\"><div class=\"mdui-float-right\">" . $result['total_count'] . "</div><div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: 50%;\"></div></div></div></div></a></div>";
                            } else {
                                echo "<div class=\"mdui-col\"><a href=\"" . $result['share_url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result['title'] . "\" target=\"_blank\"><div class=\"mdui-card moe-bangumi-card moe-card-t\"><div class=\"mdui-card-media\" style=\"overflow: hidden;\"><main class=\"moe-bangumi-img moe-post-wzimg-f\" data-original=\"cache/" . $filename . "\" style=\"background-image: url(&quot;cache/" . $filename . "&quot;);\"></main><div class=\"mdui-card-media-covered moe-card-media-covered\"><div class=\"mdui-card-primary\"><div class=\"mdui-card-primary-title moe-bangumi-title\">" . $result['title'] . "</div><div class=\"mdui-card-primary-subtitle\">" . $result['brief'] . "</div></div></div></div><div class=\"mdui-card-actions\"><div class=\"mdui-float-right\">" . $result['newest_ep_index'] . "</div><div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: 50%;\"></div></div></div></div></a></div>";
                            }
                        }
                    }
                }
            }
        }
    }
}
//Step#2 End

//Step#0 配置curl参数
function curl_get_https($url) {
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    $tmpInfo = curl_exec($curl); // 返回api的json对象
    curl_close($curl);
    return $tmpInfo; // 返回json对象
    
}
//Step#0 End

?>

</div>
</div>
</div>