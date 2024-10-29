<div class="wrap">
<h2><?php echo strtoupper(self::PLUGIN_NAME) .' '. __('options page',self::CLASS_NAME)?>:</h2>

<form name="form" action="" method="post">
  <p><?php _e('If you want you can add a new user called (anonymous) and enter his ID on the field &quot;Default User&quot;, so, any new posts will be published using that user credentials.',self::CLASS_NAME)?></p>

<h3><?php _e('Default Informations',self::CLASS_NAME)?></h3>

<table class="form-table">
	<tr>
		<th><label><?php _e('Default Status',self::CLASS_NAME);?></label></th>
    <td><select name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_status">
        		<option value="publish" <?php echo self::is_selected('publish',$options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_status"])?>>Publish (<?php _e('Post will be published',self::CLASS_NAME)?>)</option>
                <option value="pending" <?php echo self::is_selected('pending',$options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_status"])?>>Pending (<?php _e('Post will be sent for moderation',self::CLASS_NAME)?>)</option>
        	</select>&nbsp;<span class="description"><?php _e('Select the default status for new posts',self::CLASS_NAME)?></span></td>
	</tr>
	<tr>
		<th><label ><?php _e('Default User',self::CLASS_NAME)?></label></th>
		<td> <input name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_user" type="text" value="<?php echo $options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_user"];?>" class="small-text" />&nbsp;<span class="description"><?php _e('Default User Id to create new posts. If not informed, ID 1 is assumed',self::CLASS_NAME)?> </span></td>
	</tr> 
	<tr>
		<th><label ><?php _e('Default Category',self::CLASS_NAME)?></label></th>
		<td> <input name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_category" type="text" value="<?php echo $options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_category"];?>" class="small-text" />&nbsp;<span class="description"><?php _e('Default Category ID to create new posts. If not informed, ID 1 is assumed',self::CLASS_NAME)?> </span></td>
	</tr>       
</table>
<br />
<h3><?php _e('Limits Informations',self::CLASS_NAME)?></h3>

<table class="form-table">
	<tr>
		<th><label ><?php _e('Max Posts Per IP Per Day',self::CLASS_NAME)?></label></th>
		<td> <input name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_max" type="text" value="<?php echo $options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_max"]?>" class="small-text" />
		&nbsp;<span class="description"><?php _e('Number of posts can be created by one IP daily. <strong>-1</strong> for no limits. It is interesting to avoid abuses and spams',self::CLASS_NAME)?></span></td>
	</tr>       
</table>

<p class="submit">
	 <input type="submit" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_submit" value="<?php _e('Save Changes',self::CLASS_NAME)?>" class="button-primary" />
</p>
  </form>
  
<hr />
<p>
<ul>
<li><?php _e("Visit Plugin's page:",self::CLASS_NAME)?> <a href="<?php echo self::PLUGIN_PAGE ?>" target="_blank"><?php echo self::PLUGIN_NAME ?></a>
</li>
<li>
<?php _e("Visit Autor's blog:",self::CLASS_NAME)?> <a href="<?php _e('http://blogwordpress.ws',self::CLASS_NAME)?>" target="_blank">Anderson Makiyama</a>
</li>
</ul>
</p>  
</div>