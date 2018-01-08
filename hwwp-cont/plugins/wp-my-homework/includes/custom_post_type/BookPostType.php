<?php

namespace includes\custom_post_type;

class BookPostType

{

   public function getInstance()

   {

       /*

        * Регистрируем Custom Post Type

        */

       add_action( ‘init’, array( &$this, ‘registerBookPostType’ ) );

       // хук, через который подключается функция

       // регистрирующая новые таксономии  createBookTaxonomies

       add_action( ‘init’, array( &$this, ‘createBookTaxonomies’ ) );

 

       // Сообщения при публикации или изменении типа записи book

       add_filter(‘post_updated_messages’,  array( &$this, ‘bookUpdatedMessages’ ));

       // Раздел “помощь” типа записи book

       add_action( ‘contextual_help’, array( &$this, ‘addHelpText’ ), 10, 3 );

   }

   public function registerBookPostType(){

       /*

       * Регистрируем новый тип записи

       */

       register_post_type(‘book’, array(

           ‘labels’             => array(

               ‘name’               => "Home Work Custom Post Type", // Основное название типа записи

               ‘singular_name’      => "Книга", // отдельное название записи типа Book

               ‘add_new’            => "Добавить новую",

               ‘add_new_item’       => "Добавить новую книгу",

               ‘edit_item’          => "Редактировать книгу",

               ‘new_item’           => "Новая книга",

               ‘view_item’          => "Посмотреть книгу",

               ‘search_items’       => "Найти книгу",

               ‘not_found’          =>  "Книг не найдено",

               ‘not_found_in_trash’ => "В корзине книг не найдено",

               ‘parent_item_colon’  => "",

               ‘menu_name’          => "Home Work Custom Post Type"

           ),

           ‘public’             => true,

           ‘publicly_queryable’ => true,

           ‘show_ui’            => true,

           ‘show_in_menu’       => true,

           ‘query_var’          => true,

           ‘rewrite’            => true,

           ‘capability_type’    => ‘post’,

           ‘has_archive’        => true,

           ‘hierarchical’       => false,

           ‘menu_position’      => null,

           ‘supports’           => array(‘title’,’editor’,’author’,’thumbnail’,’excerpt’,’comments’),

           ‘taxonomies’          => array( ‘genre’, ‘writer’ ),

       ) );

   }

   public function createBookTaxonomies(){

       // определяем заголовки для ‘genre’

       $labels = array(

           ‘name’ => _x( ‘Genres’, "taxonomy general name" ),

           ‘singular_name’ => _x( ‘Genre’, "taxonomy singular name" ),

           ‘search_items’ =>  __( "Search Genres" ),

           ‘all_items’ => __( "All Genres" ),

           ‘parent_item’ => __( "Parent Genre" ),

           ‘parent_item_colon’ => __( "Parent Genre:" ),

           ‘edit_item’ => __( "Edit Genre" ),

           ‘update_item’ => __( "Update Genre" ),

           ‘add_new_item’ => __( "Add New Genre" ),

           ‘new_item_name’ => __( "New Genre Name" ),

           ‘menu_name’ => __( "Genre" ),

       );

       // Добавляем древовидную таксономию ‘genre’ (как категории) жанр

       register_taxonomy(‘genre’, array(‘book’), array(

           ‘hierarchical’ => true,

           ‘labels’ => $labels,

           ‘show_ui’ => true,

           ‘query_var’ => true,

           ‘rewrite’ => array( ‘slug’ => ‘genre’ ),

       ));

       // определяем заголовки для ‘writer’

       $labels = array(

           ‘name’ => _x( ‘Writers’, "taxonomy general name" ),

           ‘singular_name’ => _x( ‘Writer’, "taxonomy singular name" ),

           ‘search_items’ =>  __( "Search Writers" ),

           ‘popular_items’ => __( "Popular Writers" ),

           ‘all_items’ => __( "All Writers" ),

           ‘parent_item’ => null,

           ‘parent_item_colon’ => null,

           ‘edit_item’ => __( "Edit Writer" ),

           ‘update_item’ => __( "Update Writer" ),

           ‘add_new_item’ => __( "Add New Writer" ),

           ‘new_item_name’ => __( "New Writer Name" ),

           ‘separate_items_with_commas’ => __( "Separate writers with commas" ),

           ‘add_or_remove_items’ => __( "Add or remove writers" ),

           ‘choose_from_most_used’ => __( "Choose from the most used writers" ),

           ‘menu_name’ => __( ‘Writers’ ),

       );

       // Добавляем НЕ древовидную таксономию ‘writer’ (как метки)

       register_taxonomy(‘writer’, ‘book’,array(

           ‘hierarchical’ => false,

           ‘labels’ => $labels,

           ‘show_ui’ => true,

           ‘query_var’ => true,

           ‘rewrite’ => array( ‘slug’ => ‘writer’ ),

       ));

   }

}