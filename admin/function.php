<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'rest_api_init', function(){

register_rest_route( 'wp/v2', 'latest-posts', array(
    'methods' => 'GET',
    'callback' => 'get_latest_posts_by_category'
) );

register_rest_route( 'wp/v2', 'post-details', array(
    'method' => 'GET',
    'callback' => 'get_post_by_id'
));

register_rest_route( 'wp/v2', 'get-categories', array(
    'method' => 'GET',
    'callback' => 'get_user_custom_categories'
));

} );


function get_latest_posts_by_category()
{
$args = array('category' => $_REQUEST['c']);

$posts = get_posts( $args );


if(empty($posts)){
    return new WP_Error('empty_category', 'the is no post in this category', array('status' => 404));
}

$post_list = [];

foreach($posts as $post){
    $post_categories = wp_get_post_categories( $post->ID);
    $cats = array();

    foreach($post_categories as $c){
        $cat = get_category($c);
        $cats[] = $cat->name;
    }

    $post_list[] = (object)[
        "id" => $post->ID,
        "post_date" => $post->post_date,
        "title" => $post->post_title,
        "category_name" => array_values($cats)[1],
        "image_url" => get_post_image($post->ID),
    ];
    
}


$response = new WP_REST_Response($post_list);
$response->set_status(200);

return $response;
}


function get_post_by_id($request){
$post = get_post($request["id"]);
$post_categories = wp_get_post_categories( $post->ID );
$post_output =(object)[
    "id" => $post->ID,
    "post_date" => $post->post_date,
    "title" => $post->post_title,
    "category_name" => get_category($post_categories[1])->name,
    "post_content" => $post->post_content,
    "image_url" => get_post_image($post->ID),
];


$response = new WP_REST_Response($post_output);
$response->set_status(200);

return $response;

}


function get_user_custom_categories($request){

//get_cat_from_saved_user_selection

$custom_user_ids = explode(",", get_option( 'RBAPP_categories' )); 
$post_output = [];
$categories = get_categories( array(
    'orderby' => 'id',
    'order'   => 'ASC'
) );
 if(!empty(get_option( 'RBAPP_categories' ))){
    foreach ($custom_user_ids as $ids){
        foreach($categories as $category){
            if($category->term_id == $ids){
                            $post_output[]= (object)[
                                "id" => $category->term_id,
                                "name" => $category->name,
                                "count" => $category->count,
                                "parent" => $category->parent,
                            ];
            }
        }
    }

 }else{
    return new WP_Error('empty_categories', 'categories in plugin not set.', array('status' => 404));
 }

$response = new WP_REST_Response($post_output);
$response->set_status(200);

return $response;

}



function get_post_image($post_id){
$args = array(
    'posts_per_page' =>1,
    'order'=> 'ASC',
    'post_mime_type'=>'image',
    'post_parejt'=>$post_id,
    'post_type'=>'attachment',
);

$attachments = get_children( $args );

return wp_get_attachment_image_src( array_values($attachments)[0]->ID, 'app-thumb')[0];
}