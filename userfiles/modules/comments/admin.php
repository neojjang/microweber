



<script>


$(document).ready(function(){
    mw.$("#post_select").bind("focus", function(){
        mwd.getElementById('display_from_post').checked = true;
    });
});


</script>





<?
$get_comments_params = array();
 $get_comments_params['to_table'] = 'table_content';
if(isset($params['content-id'])){
	
	 $get_comments_params['to_table_id'] = $params['content-id'];
}

if (!isset($get_comments_params['to_table_id'])) {

 

    if (defined('POST_ID') == true and intval(POST_ID) != 0) {
       $get_comments_params['to_table_id'] = POST_ID;
    }
}
if (!isset($get_comments_params['to_table_id'])) {
    if (defined('PAGE_ID') == true) {
      $get_comments_params['to_table_id'] = PAGE_ID;
    }
}
if (!isset($get_comments_params['to_table_id'])) {

 $get_comments_params['to_table_id'] = $params['id'];
 
}
 

if(isset($params['backend']) == true): ?>
<? include('backend.php'); ?>
<? else : ?>
<div class="mw_simple_tabs mw_tabs_layout_simple">
  <ul class="mw_simple_tabs_nav">
    <li><a class="active" href="javascript:;">New Comments</a></li>
    <li><a href="javascript:;">Skin/Template</a></li>
    <li><a href="javascript:;" class="">Settings</a></li>
  </ul>
  <div class="tab semi_hidden">

    <div class="vSpace"></div>
    <div class="vSpace"></div>

    <?
		
		$get_comments_params['count'] = '1';
		$get_comments_params['is_moderated'] = 'n';

		 ?>
    <?php $new = get_comments($get_comments_params); ?>
    <?php if($new > 0){ ?>
    <?php if($new == 1){ ?>

     <h2 class="relative inline-block left">You have one new comment &nbsp;<span class="comments_number"><? print $new; ?></span></h2>


    <?php } else { ?>
     <h2 class="relative inline-block left">You have <? print $new; ?> new comments &nbsp;<span class="comments_number"><? print $new; ?></span></h2>
    <?php  } ?>
    <a href="<?php print admin_url('view:comments'); ?>/#content_id=<? print  $get_comments_params['to_table_id']; ?>" target="_top" class="mw-ui-btn mw-ui-btn-green right">See new</a>

    <?php }  else { ?>
    <?php
	 unset($get_comments_params['is_moderated']);
		$old = get_comments($get_comments_params); ?>
    <h2 class="relative inline-block left">You don't have new comments <? print $old; ?></h2>


    <a href="<?php print admin_url('view:comments'); ?>/#content_id=<? print  $get_comments_params['to_table_id']; ?>" target="_top" class="mw-ui-btn right">See all</a>




    <?php } ?>

    <div class="mw_clear"></div>

  </div>
  <div class="tab semi_hidden">
    <module type="admin/modules/templates"  />
  </div>
  <div class="tab semi_hidden">
  
  
  
 <? $display_comments_from =  get_option('display_comments_from', $params['id']); ?> 
 <? $display_comments_from_which_post =  get_option('display_comments_from_which_post', $params['id']); ?>  


    <label class="mw-ui-label">Display comments from</label>

    <div class="mw-ui-field-holder checkbox-plus-select">
      <label class="mw-ui-check">
          <input name="display_comments_from" value="post" id="display_from_post" type="radio" <? if($display_comments_from == 'post'): ?>  checked="checked" <? endif ?> />
          <span></span>
      </label>
      <div class="mw-ui-select" style="width: 290px;">
          <select name="display_comments_from_which_post" id="post_select">
              <option value="current_post">Current Post</option>
              <?php $posts = get_posts(""); $html = ''; ?>
              <?php
                  foreach($posts as $post){
                      $html.= '<option value="'.$post['id'].'">'.$post['title'].'</option>';
                  }
                  print $html;
              ?>

          </select>
      </div>
    </div>


    <div class="mw-ui-field-holder">
      <label class="mw-ui-check">
          <input name="display_comments_from" class="mw_option_field"    type="radio" value="recent" <? if($display_comments_from == 'recent'): ?>  checked="checked" <? endif ?> />
          <span></span>
          <span>Recent comments</span>
      </label>
    </div>
    <div class="mw-ui-field-holder">
      <label class="mw-ui-check">
          <input name="display_comments_from" class="mw_option_field"   type="radio" value="popular" <? if($display_comments_from == 'popular'): ?>  checked="checked" <? endif ?> />
          <span></span>
          <span>Most popular comments</span>
      </label>
    </div>


   <hr>



   <label class="mw-ui-check">
        <input type="checkbox"  />
        <span></span>
        <span>Show paging</span>
    </label>

    <div class="mw_clear vSpace"></div>
    <label class="mw-ui-label-inline">Commets per page</label><input type="text" class="left" placeholder="10" style="width:22px;" class="mw_option_field"  name="comments_per_page"   value="<?php print get_option('comments_per_page', $params['id']) ?>" />
   <div class="mw_clear vSpace"></div>
  </div>
</div>
<? endif; ?>
