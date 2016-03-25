<?php



function set_post_type_list($arr) 
{
	global $all_posttype_list;
	$all_posttype_list = $arr;
	
	foreach($arr as $val){
		
		$labels = array(
			'name' => $val[1],
			'singular_name' => $val[1],
			'add_new' => '新規追加',
			'add_new_item' => '新規追加：'.$val[1],
			'edit_item' => '編集：'.$val[1],
			'new_item' => '新規追加：'.$val[1],
			'view_item' => 'ページを表示',
			'search_items' => $val[1].'を検索',
			'not_found' =>  $val[1].'は見つかりませんでした。',
			'not_found_in_trash' => $val[1].'はゴミ箱に見つかりませんでした。', 
			'parent_item_colon' => ''
		);
		
		$public = ($val[2]['public']) ? $val[2]['public'] : true;
		$publicly_queryable = ($val[2]['publicly_queryable']) ? $val[2]['publicly_queryable'] : true;
		$show_ui = ($val[2]['show_ui']) ? $val[2]['show_ui'] : true;
		$query_var = ($val[2]['query_var']) ? $val[2]['query_var'] : true;
		$rewrite = ($val[2]['rewrite']) ? $val[2]['rewrite'] : true;
		$capability_type = ($val[2]['capability_type']) ? $val[2]['capability_type'] : 'post';
		$hierarchical = ($val[2]['hierarchical']) ? $val[2]['hierarchical'] : false;
		$menu_position = ($val[2]['menu_position']) ? $val[2]['menu_position'] : null;
		$supports = ($val[2]['supports']) ? $val[2]['supports'] : array('title','editor','author','thumbnail','excerpt','comments');
		
		$args = array(
			'labels' => $labels,
			'public' => $public,
			'publicly_queryable' => $publicly_queryable,
			'show_ui' => $show_ui, 
			'query_var' => $query_var,
			'rewrite' => $rewrite,
			'capability_type' => $capability_type,
			'hierarchical' => $hierarchical,
			'menu_position' => 5,
			'supports' => $supports
		); 
		
		register_post_type($val[0],$args);
	}
	
}


function set_custom_category_list($arr){
	foreach($arr as $val){
		register_taxonomy(
			$val[0], // 分類名
			$val[2],  // 投稿タイプ名
			array(
				'label' => $val[1], // フロントで表示する分類名
				'hierarchical' => true,   // 階層構造か否か（trueの場合はカテゴリー、falseの場合はタグ）
				'query_var' => true,
				'rewrite' => true
			)
		);
	}
}

function set_custom_tag_list($arr){
	foreach($arr as $val){
		register_taxonomy(
			$val[0], // 分類名
			$val[2],  // 投稿タイプ名
			array(
				'label' => $val[1], // フロントで表示する分類名
				'hierarchical' => false,   // 階層構造か否か（trueの場合はカテゴリー、falseの場合はタグ）
				'query_var' => true,
				'rewrite' => true
			)
		);
	}
}
