<?php
//管理ページ 設定
if ( isset($_POST['conf_1'])) {//変更
	$opt_name = "gmp_post_conf_1";
	$set1 = $_POST['conf_1'];
	$set2 = $_POST['conf_2'];
	$set3 = $_POST['conf_3'];
	$set4 = $_POST['conf_4'];
	$set5 = $_POST['conf_5'];
	$set6 = $_POST['conf_6'];
	$set7 = $_POST['conf_7'];
	$set8 = $_POST['conf_8'];
	$set9 = $_POST['conf_9'];
	$set10 = $_POST['conf_10'];

$opt_val = array(
	'conf_1' => $set1,
	'conf_2' => $set2,
	'conf_3' => $set3,
	'conf_4' => $set4,
	'conf_5' => $set5,
	'conf_6' => $set6,
	'conf_7' => $set7,
	'conf_8' => $set8,
	'conf_9' => $set9,
	'conf_10' => $set10,
);

	if(get_option($opt_name) !== false){
	update_option($opt_name, $opt_val);}
	else{add_option($opt_name, $opt_val);}

echo <<< EOM
<div class="updated fade"><p><strong>設定を変更しました</strong></p></div>
EOM;
}

//******************** データここまで *********************//
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/admin-style.css">

<?php
//設定オプション
if(get_option('gmp_post_conf_1') !== false){
$conf1 = get_option('gmp_post_conf_1');
	$set1 = (int)$conf1['conf_1'];
	$set2 = (int)$conf1['conf_2'];
	$set3 = $conf1['conf_3'];
	$set4 = $conf1['conf_4'];
	$set5 = $conf1['conf_5'];
	$set6 = $conf1['conf_6'];
	$set7 = $conf1['conf_7'];
	$set8 = $conf1['conf_8'];
	$set9 = $conf1['conf_9'];
	$set10 = $conf1['conf_10'];
}else{
	$set1 = 20;
	$set2 = 1;
	$set3 = '';
	$set4 = '';
	$set5 = '';
	$set6 = 'status_on_sale=1';
	$set7 = '0';
	$set8 = 'created_desc';
	$set9 = 0;
	$set10 = array('item_condition_id[1]=1');
}
//var_dump($set9);
?>


<div class="configs_area" style="margin-top:15px;">
<h3>設定</h3>
<form method="post" action="">

<div style="margin-bottom:15px;">
<div>取得ページ数</div>
<input name="conf_1" type="text" style="width:80px" value="<?php echo $set1; ?>" placeholder="" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')">
</div>

<div style="margin-bottom:15px;">
<div>取得開始ページ</div>
<input name="conf_2" type="text" style="width:80px" value="<?php echo $set2; ?>" placeholder="" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')">
</div>

<div style="margin-bottom:15px;">
<div>キーワード</div>
<input name="conf_3" type="text" style="width:200px" value="<?php echo $set3; ?>" placeholder="">
</div>

<div style="margin-bottom:15px;">
<div>最低購入金額</div>
<input name="conf_4" type="text" style="width:120px" value="<?php echo $set4; ?>" placeholder="" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')">
</div>

<div style="margin-bottom:15px;">
<div>最高購入金額</div>
<input name="conf_5" type="text" style="width:120px" value="<?php echo $set5; ?>" placeholder="" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')">
</div>

<div style="margin-bottom:15px;">
<div>商品の状態</div>
<label><input id="inpall" type="checkbox" name="conf_10[]" value="condition_all=1" <?php if (in_array('condition_all=1', $set10)){echo "checked";} ?>>すべて</label>
<span id="boxes">
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[1]=1" <?php if (in_array('item_condition_id[1]=1', $set10)){echo "checked";} ?>>新品・未使用</label>
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[2]=1" <?php if (in_array('item_condition_id[2]=1', $set10)){echo "checked";} ?>>未使用に近い</label>
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[3]=1" <?php if (in_array('item_condition_id[3]=1', $set10)){echo "checked";} ?>>目立った傷や汚れなし</label>
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[4]=1" <?php if (in_array('item_condition_id[4]=1', $set10)){echo "checked";} ?>>やや傷や汚れあり</label>
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[5]=1" <?php if (in_array('item_condition_id[5]=1', $set10)){echo "checked";} ?>>傷や汚れあり</label>
<label><input class="sta_in" type="checkbox" name="conf_10[]" value="item_condition_id[6]=1" <?php if (in_array('item_condition_id[6]=1', $set10)){echo "checked";} ?>>全体的に状態が悪い</label>
</span>
</div>

<div style="margin-bottom:15px;">
<div>販売状況</div>
<label><span class="raido"><input type="radio" name="conf_6" value="status_on_sale=1&status_trading_sold_out=1" <?php if($set6 == 'status_on_sale=1&status_trading_sold_out=1'){echo "checked";} ?>>すべて</span></label>
<label><span class="raido"><input type="radio" name="conf_6" value="status_on_sale=1" <?php if($set6 == 'status_on_sale=1'){echo "checked";} ?>>販売中</span></label>
<label><span class="raido"><input type="radio" name="conf_6" value="status_trading_sold_out=1" <?php if($set6 == 'status_trading_sold_out=1'){echo "checked";} ?>>売り切れ</span></label>
</div>

<div style="margin-bottom:15px;">
<div>カテゴリ</div>
<select name="conf_7">
<option value="0" <?php if($set7 == '0'){echo "selected";} ?>>すべて</option>
<option value="1" <?php if($set7 == '1'){echo "selected";} ?>>レディース</option>
<option value="2" <?php if($set7 == '2'){echo "selected";} ?>>メンズ</option>
<option value="3" <?php if($set7 == '3'){echo "selected";} ?>>ベビー・キッズ</option>
<option value="4" <?php if($set7 == '4'){echo "selected";} ?>>インテリア・住まい</option>
<option value="5" <?php if($set7 == '5'){echo "selected";} ?>>本・音楽・ゲーム</option>
<option value="1328" <?php if($set7 == '1328'){echo "selected";} ?>>おもちゃ・ホビー・グッズ</option>
<option value="6" <?php if($set7 == '6'){echo "selected";} ?>>コスメ・香水・美容</option>
<option value="7" <?php if($set7 == '7'){echo "selected";} ?>>家電・スマホ・カメラ</option>
<option value="8" <?php if($set7 == '8'){echo "selected";} ?>>スポーツ・レジャー</option>
<option value="9" <?php if($set7 == '9'){echo "selected";} ?>> ハンドメイド</option>
<option value="1027" <?php if($set7 == '1027'){echo "selected";} ?>>チケット</option>
<option value="1318" <?php if($set7 == '1318'){echo "selected";} ?>>自動車・オートバイ</option>
<option value="10" <?php if($set7 == '10'){echo "selected";} ?>>その他</option>

</select>

</div>

<div style="margin-bottom:15px;">
<div>ソート</div>
<select name="conf_8">
<option value="price_asc" <?php if($set8 == 'price_asc'){echo "selected";} ?>>価格の安い順</option>
<option value="price_desc" <?php if($set8 == 'price_desc'){echo "selected";} ?>>価格の高い順</option>
<option value="created_asc" <?php if($set8 == 'created_asc'){echo "selected";} ?>>出品の古い順</option>
<option value="created_desc" <?php if($set8 == 'created_desc'){echo "selected";} ?>>出品の新しい順</option>
<option value="like_desc" <?php if($set8 == 'like_desc'){echo "selected";} ?>>いいね!の多い順</option>

</select>
</div>

<div style="margin-bottom:15px;">
<div>投稿ステータス</div>
<label><span class="raido"><input type="radio" name="conf_9" value="0" <?php if($set9 == 0){echo "checked";} ?>>通常</span></label>
<label><span class="raido"><input type="radio" name="conf_9" value="1" <?php if($set9 == 1){echo "checked";} ?>>下書き</span></label>
</div>


<br>
<div>
<input type="submit" class="button-primary" value="設定">
</div>

</form>
</div>

<script>
$(function() {
	$('#inpall').on('click', function() {
		$("input[class='sta_in']").prop('checked', this.checked);
	});
});
</script>
