<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '公告详情 - ';

require_once 'inc_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pager.php';
?>

<div class="not">
	<div class="box">
	<?php
    news_show();
    function news_show(){
        global $id;
        global $db;
        
        $id = intval($id);
        
        $sql = "select * from `h_article` where h_menuId = 108 and id = '{$id}' LIMIT 1";
        $rs = $db->get_one($sql);
        if($rs){
            echo '<b>' , $rs['h_title'] , '</b>';
            echo '<p>' , $rs['h_info'] , '</p>';
        }
    }
    ?>
	</div>
</div>

<?php
require_once 'inc_footer.php';
?>