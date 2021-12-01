<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>




<div class="wrap">
    <div class="testbox">
        <form action="" method="post">
            <div class="banner">
                <h1 class="RBAPP_title"><?php _e('Raevant Blog App - Categories','RBAPP') ?></h1>
            </div>
            <!--            <p class="top-info">Want to become a member of our Gym? Then start by filling our form to complete registration. We will contact you shortly to notify you about your membership card.</p>-->
            <p><?php _e('Categories ID','RBAPP') ?><span class="required">*</span></p>
            <div class="item">
                <input type="text" name="apikey"
                    placeholder="<?php _e('eg: 1,5,24','CPW') ?>"
                    value='<?php //echo isset(CPW_SETTING_DATA_New['2']) ? CPW_SETTING_DATA_New['2']:''; ?>' required />
            </div>
            <div class="btn-block">
                <button type="submit" name="saveSettings"><?php _e('Save','RBAPP') ?></button>
            </div>
        </form>
    </div>
</div>






<?php
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
 
foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a href="%1$s" alt="%2$s">%3$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name )
    );
     
    echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
    echo '<p>' . sprintf( esc_html__( 'ID: %s', 'textdomain' ), $category->term_id ) . '</p>';
} 