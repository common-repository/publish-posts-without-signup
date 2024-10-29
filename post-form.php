<?php
include("../../../wp-blog-header.php");

function create_post($author, $status, $category){
	global $title, $text, $tags;
	
	$my_post = array();
	$my_post['post_title'] = $title;
	$my_post['post_content'] = $text;
	$my_post['post_status'] = $status;
	$my_post['post_author'] = $author;
	$my_post['post_category'] = array($category);
	$my_post['tags_input'] = $tags;

// Insert the post into the database
	return wp_insert_post( $my_post );
}

$title = isset($_POST["title"])?$_POST["title"]:"";
$text = isset($_POST["text"])?$_POST["text"]:"";
$tags = isset($_POST["tags"])?$_POST["tags"]:"";
$submit = isset($_POST["submit"])?$_POST["submit"]:"";

if(!empty($submit)){
	if(empty($title) || empty($text)){
		echo "<script>alert('" . __('Post Title and Post Text cannot be empty','Anderson_Makiyama_Publish_Posts_Without_Signup') ."');</script>";	
	}elseif(exceeded_limit()){
		echo "<script>alert('" . __('You have exceeded the maximum number of post creation per day limit.','Anderson_Makiyama_Publish_Posts_Without_Signup') . ' \\n' . __('Come back tomorrow!','Anderson_Makiyama_Publish_Posts_Without_Signup') . "');</script>";	
	}else{
		
		$options = get_option("anderson_makiyama_publish_posts_without_signup_options");
		$author = $options["anderson_makiyama_publish_posts_without_signup_user"]; if(!$author) $author = 1;
		$status = $options["anderson_makiyama_publish_posts_without_signup_status"]; if(!$status) $status = 'pending';
		$category = $options["anderson_makiyama_publish_posts_without_signup_category"]; if(!$category) $category = 1;
		
		create_post($author, $status, $category);
		$msg = 'publish' == $status?__('Your Post has been Published!','Anderson_Makiyama_Publish_Posts_Without_Signup'):__('Your Post has been submited for Moderation!','Anderson_Makiyama_Publish_Posts_Without_Signup');
		
		//clear variables
		$title = '';
		$text = '';
		$tags = '';
		//---------------
		echo "<script>alert('$msg');</script>";	
	}
}

function exceeded_limit(){
	$total_posts = 0;
	$options = get_option("anderson_makiyama_publish_posts_without_signup_options");

	$limit = $options["anderson_makiyama_publish_posts_without_signup_max"];
	if($limit==-1 || $limit==false) return false;
	$ip = $_SERVER['REMOTE_ADDR'];
	$new_ips = array();
	
	$day_hora = date('Y_m_d');
	$pap_ip = $day_hora . "_" . $ip;
	$ips = $options["anderson_makiyama_publish_posts_without_signup_ips"];
	if($ips){
		//$ips = explode(",", $ips);
		//clear old entries		
		for($i=0;$i<count($ips);$i++){
			if(strpos($ips[$i], $day_hora)!==false) $new_ips[] = $ips[$i];
		}
		//-----------------
		
		for($i=0;$i<count($new_ips);$i++){
			if(strpos($new_ips[$i], $ip)!==false) $total_posts++;
			if($total_posts >= $limit) return true;
		}
	}
	//$new_ips = implode(",",$new_ips);
	//print_r($new_ips);
	$new_ips[]= $day_hora . "_" . $ip;
	$options["anderson_makiyama_publish_posts_without_signup_ips"] = $new_ips;
	update_option("anderson_makiyama_publish_posts_without_signup_options",$options);
	return false;
}
?>
<html>
<head>
</head>
<body>
<div id="postbox" style="background-color:#EEE; padding: 15px; margin: 5px 0px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px;" >

<form id="new_post" name="new_post" method="post" action="">

		<input type="hidden" name="action" value="post" />


		<label for="title"><?php _e('Post Title: (*)','Anderson_Makiyama_Publish_Posts_Without_Signup')?></label>

		<br />

		<input type="text" name="title" id="title" style="width:100%; height: 25px; border: 1px solid #99afbc; margin: 5px 0 10px 0;" value="<?php echo $title?>" />

		<br />

		<label for="text"><?php _e('Post Text','Anderson_Makiyama_Publish_Posts_Without_Signup')?></label>
		:
		(*)
    <br />

		<textarea name="text" id="text" rows="3" style="width:100%; height: 80px; border: 1px solid #99afbc; margin: 5px 0 10px 0;"><?php echo $text?></textarea>

	  <br />

		<label for="tags">Tags (<?php _e('separated with comma','Anderson_Makiyama_Publish_Posts_Without_Signup')?>)</label>

		<br />

		<input type="text" name="tags" id="tags" style="width:100%; height: 25px; border: 1px solid #99afbc; margin: 5px 0 10px 0;" value="<?php echo $tags?>" />

		<br />

		<input id="submit" type="submit" name="submit" value="<?php _e('Post it','Anderson_Makiyama_Publish_Posts_Without_Signup')?>" style='padding:10px; font-size:20px; width:250px;'  />

	</form>

</div> <!-- // postbox -->
</body>
</html>