<?php


// Function to change "posts" to "news" in the admin side menu
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = '_Posts';
    $submenu['edit.php'][5][0] = '_Posts';
    $submenu['edit.php'][10][0] = 'Add _Post';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );
// Function to change post object labels to "news"
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = '_Posts';
    $labels->singular_name = '_Post';
    $labels->add_new = 'Add _Post';
    $labels->add_new_item = 'Add _Post';
    $labels->edit_item = 'Edit _Post';
    $labels->new_item = '_Post';
    $labels->view_item = 'View _Post';
    $labels->search_items = 'Search _Posts';
    $labels->not_found = 'No _Posts found';
    $labels->not_found_in_trash = 'No _Posts found in Trash';
}
add_action( 'init', 'change_post_object_label' );



// add_action( 'init', 'register_projekte_custom_post_types' );

// function register_projekte_custom_post_types() {
//     // Projekte
//      $labels = array(
//          "name" => "Projekte",
//          "singular_name" => "Projekte",
//          "menu_name" => "Projekte",
//          "add_new" => "Neuer Projekte",
//          "add_new_item" => "Projekte hinzufügen",
//          "edit" => "Projekte bearbeiten",
//          "edit_item" => "Projekte bearbeiten",
//          "new_item" => "Neuer Referenze",
//          "view" => "Referenze anzeigen",
//          "view_item" => "Projekte anzeigen",
//          "search_items" => "Projekte suchen",
//          "not_found" => "Nichts gefunden",
//          "not_found_in_trash" => "nichts im Papierkorb gefunden",
//          );
 
//      $args = array(
//          "labels" => $labels,
//          "description" => "Projekte",
//          "public" => true,
//          "show_ui" => true,
//          "has_archive" => false,
//          "show_in_menu" => true,
//          'menu_icon' => 'dashicons-category',
//          "exclude_from_search" => false,
//          "capability_type" => "post",
//          "map_meta_cap" => true,
//          "hierarchical" => false,
//          "rewrite" => array( "slug" => "projekte", "with_front" => false ),
//          "query_var" => true,
//          'taxonomies' => array( 'category', 'post_tag' ),
//          "supports" => array( 'title', 'thumbnail','page-attributes' ),
//     );
//      register_post_type( "projekte", $args );
//  }

