<?php

add_action('admin_init', 'retrieve_my_terms', 9999);

function retrieve_my_terms() {
if (is_admin()){


  //prefix   
  $prefix = 'dankov_';
  
 /*-----------------------------------------------------------------------------------*/
/*	Blog Post Formats
/*-----------------------------------------------------------------------------------*/  

/*
|--------------------------------------------------------------------------
| Gallery post
|--------------------------------------------------------------------------
*/ 	

	// Metaboxes for Gallery Post Format
	$config = array(
		'id' => 'dankov_gallery_post_custom_fields',	
		'title' => 'Gallery Post Options',	
		'pages' => array('post'),
		'context' => 'normal',	
		'priority' => 'high',	
		'fields' => array(),	
		'local_images' => false,	
		'use_with_theme' => true
	);
	
	$gallery_post =  new AT_Meta_Box($config);
	$gallery_fields[] = $gallery_post->addImage($prefix.'gallery_post',array('desc' => '', 'name'=> 'Photo URL', 'class'=>'image-field'),true);
	$gallery_post->addRepeaterBlock($prefix.'gallery_block',array('desc' => 'Upload images for the gallery.','inline' => true, 'name' => 'Gallery','fields' => $gallery_fields, 'sortable' => true));
	$gallery_post->Finish();		
	
  

    
  	// Metaboxes for Link Post Format
	$config = array(
		'id' => 'dankov_link_post_custom_fields',	
		'title' => 'Link Post Format Options',	
		'pages' => array('post'),
		'context' => 'normal',	
		'priority' => 'high',	
		'fields' => array(),	
		'local_images' => false,	
		'use_with_theme' => true
	);
	
	$link_post =  new AT_Meta_Box($config);
	$link_post->addText($prefix.'link_title_block',array('name'=> 'URL title', 'desc' => 'Add a title for the link.', 'std'=> ''));	
	$link_post->addText($prefix.'link_block',array('name'=> 'Link URL', 'desc' => 'Add a link for the "Link Post Format". The title of the post will link to the URL you`ve set.', 'std'=> ''));	
	$link_post->addRadio($prefix.'link_radio',array('blank'=>'_blank: New window or tab','self'=>'_self: Same window or tab'), array('name'=> 'Target of the link', 'desc' => 'Set the target of the link.', 'std'=> array('blank')));	
	$link_post->addText($prefix.'link_relationship',array('name'=> 'Link Relationship (optional)', 'desc' => 'Set the link "rel" attribute(ex: nofollow, dofollow, etc).', 'std'=> ''));
	$link_post->Finish();	  
	
  
  
	// Metaboxes for Quote Post Format
	$config = array(
		'id' => 'dankov_quote_post_custom_fields',	
		'title' => 'Quote Post Format Options',	
		'pages' => array('post'),
		'context' => 'normal',	
		'priority' => 'high',	
		'fields' => array(),	
		'local_images' => false,	
		'use_with_theme' => true
	);
	
	$quote_post =  new AT_Meta_Box($config);
	$quote_post->addTextarea($prefix.'quote_block',array('name'=> 'Quote', 'desc' => 'Add your text for the quote.', 'std'=> ''));	
	$quote_post->addText($prefix.'quote_author',array('name'=> 'Quote author', 'desc' => 'The person who said that quote.', 'std'=> ''));
	$quote_post->Finish();		
	
  
  
	// Metaboxes for Audio Post Format
	$config = array(
		'id' => 'dankov_audio_post_custom_fields',	
		'title' => 'audio Post Format Options',	
		'pages' => array('post'),
		'context' => 'normal',	
		'priority' => 'high',	
		'fields' => array(),	
		'local_images' => false,	
		'use_with_theme' => true
	);
	
	$audio_post =  new AT_Meta_Box($config);
	$audio_post->addTextarea($prefix.'external_audio_block',array('name'=> 'External URL(embed SoundCloud )', 'desc' => 'Use an SoundCloud page URL. The embed code will be automatically created.', 'std'=> ''));	
	$audio_post->Finish();  
	
  
  
	// Metaboxes for Video Post Format
	$config = array(
		'id' => 'dankov_video_post_custom_fields',	
		'title' => 'Video Post Format Options',	
		'pages' => array('post'),
		'context' => 'normal',	
		'priority' => 'high',	
		'fields' => array(),	
		'local_images' => false,	
		'use_with_theme' => true
	);
	
	$video_post =  new AT_Meta_Box($config);
	$video_post->addText($prefix.'external_video_block',array('name'=> 'External URL(embed YouTube or Vimeo videos )', 'desc' => 'Use an YouTube or Vimeo page URL(ex: http://www.youtube.com/watch?v=x6qe_kVaBpg). The embed code will be automatically created.', 'std'=> ''));	
	$video_post->Finish();

	}
}