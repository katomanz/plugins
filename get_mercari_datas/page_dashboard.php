<?php
global $wpdb;
	$pdir = plugin_dir_path( __FILE__ );
	$myPluginPath = str_replace(basename( __FILE__), "", plugin_basename(__FILE__));
	$plugin_dir = WP_PLUGIN_URL . "/" . $myPluginPath;

if (isset($_POST['setup'])) {//初期設定
global $wpdb;
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

//新規テーブル追加
$table_name = "wp_merukari_items";
$sql = "CREATE TABLE `wp_merukari_items` (
`id` int(11) NOT NULL,
`merukari_id` varchar(50) NOT NULL DEFAULT '',
`title` varchar(255) NOT NULL DEFAULT '',
`url` varchar(900) NOT NULL DEFAULT '',
`price` varchar(100) NOT NULL DEFAULT '',
`sold` varchar(100) NOT NULL DEFAULT '',
`category` varchar(100) NOT NULL DEFAULT '',
`sub_category` varchar(100) NOT NULL DEFAULT '',
`sub_sub_category` varchar(100) NOT NULL DEFAULT '',
`brand` varchar(100) NOT NULL DEFAULT '',
`imgUrl` varchar(255) NOT NULL DEFAULT '',
`ownerId` varchar(255) NOT NULL DEFAULT '',
`ownerName` varchar(255) NOT NULL DEFAULT '',
`post_timestamp` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
 UNIQUE KEY id (id)
) $charset_collate;";
dbDelta( $sql );

$wpdb->query("ALTER TABLE `wp_merukari_items` ADD PRIMARY KEY (`id`),ADD KEY `merukari_id` (`merukari_id`)");
$wpdb->query("ALTER TABLE `wp_merukari_items` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

}

if (isset($_POST['delete_item'])) {//削除
$id = (int)$_POST['delete_item'];
	$wpdb->delete( 'wp_merukari_items', array( 'id'=> $id ), array( '%d' ) );
echo <<< EOM
<div class="updated fade"><p><strong>削除しました</strong></p></div>
EOM;
}

date_default_timezone_set('Asia/Tokyo');
$page_top = "./admin.php?page=get_mercari_datas_page_1";
//******************** データここまで *********************//
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo $plugin_dir.'admin-style.css'; ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">

<?php
$tblname = "wp_merukari_items";
$table_search = $wpdb->query("SELECT * FROM {$tblname} LIMIT 1");
if(!$table_search and $table_search !== 0){
?>

<div class="configs_area">
<h3>初期設定</h3>

<form action="" method="POST">
<input type="hidden" name="setup" value="1">
<input type="submit" class="button" value="初期設定" />
</form>

</div>

<?php }else{ ?>



<div class="configs_area" style="margin-top:15px;">
<h3>取得</h3>

<div style="display:inline-block;vertical-align:top;margin-right:25px;">
<a href="<?php echo $plugin_dir; ?>post_ex.php" class="button" target="_blank">取得実行</a><br>
設定に基づき取得投稿します
</div>

<div style="display:inline-block;vertical-align:top;">
<a href="<?php echo $plugin_dir; ?>post_ex.php?debug=1" class="button" target="_blank">デバッグモード</a><br>
投稿はせず取得データを表示します
</div>


</div>

<div class="configs_area" style="margin-top:15px;">
<h3>取得一覧</h3>
<?php
$limit = 50;
$da = $wpdb->get_results("SELECT id FROM `wp_merukari_items`");
$list_int = $wpdb->num_rows;
if (isset($_GET['pr'])) {
	$np = (int)$_GET['pr'];
	$ofs = (int)$_GET['pr'] * $limit - $limit;
	$nxt = (int)$_GET['pr'] + 1;
	$prv = (int)$_GET['pr'] - 1;
}else{
	$np = 1;
	$ofs = 0;
	$nxt = 2;
	$prv = 1;
}
if($list_int !== 0){
$end_page = ceil($all_num / $limit);
?>
<div style="margin-bottom:10px;">

	<?php if (isset($_GET['pr'])) { ?><span style="margin-right:7px;"><a href="<?php echo $page_top; ?>" class="button"><i class="fas fa-angle-double-left"></i></a></span><?php } ?>
	<?php if (isset($_GET['pr'])) { ?><span style="margin-right:7px;"><a href="<?php echo $page_top; ?>&pr=<?php echo $prv; ?>" class="button prev_b"><i class="fas fa-angle-left"></i></a></span><?php } ?>
	<?php if($np < $end_page){ ?>
	<span style="margin-right:7px;"><a href="<?php echo $page_top; ?>&pr=<?php echo $nxt; ?>" class="button next_b"><i class="fas fa-angle-right"></i></a></span>
	<span><a href="<?php echo $page_top; ?>&pr=<?php echo $end_page; ?>" class="button"><i class="fas fa-angle-double-right"></i></a></span>
	<?php } ?>
	<div style="display:inline-block;vertical-align:top;font-size:14px;color:#777;padding-top:4px;margin-left:15px;"><?php echo $list_int; ?>件</div>

</div>

<table>
<?php
$data_results = $wpdb->get_results("SELECT * FROM `wp_merukari_items` order by id desc limit {$limit}");
$r_int = $wpdb->num_rows;
	if($r_int >= 1){foreach ($data_results as $value) { ?>
	<tr>
		<td><?php echo $value->id; ?></td>
		<td><a href="<?php echo $value->url; ?>" target="_blank"><?php echo $value->title; ?></a></td>
		<td><?php echo $value->category; ?></td>
		<td style="font-size:20px;"><i class="fas fa-times-circle del_item" value="<?php echo $value->id; ?>"></i></td>
	</tr>
	<?php }
}else{echo 'データが存在しません';}
?>
</table>

<?php } ?>

</div>

<form method="post" id="delf" action="<?php echo $page_top; ?>">
<input type="hidden" id="delf_id" name="delete_item" value="">
</form>

<script>
$(".del_item").click(function() {
var post_id = $(this).attr("value");
if(!confirm("削除しますか？")){
	return false;
}else{
	$("#delf_id").attr("value",post_id);
	$('#delf').submit();
}
});
</script>

<style>
table {
border-collapse: separate;
border-top: 1px solid #ccc;
border-left: 1px solid #ccc;
}
table td {
border-right: 1px solid #ccc;
border-bottom: 1px solid #ccc;
border-top:none;
border-left:none;
padding:4px 6px;
}
</style>

<?php } ?>

