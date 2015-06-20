<?php
/**
 * NGF Sprekeste Theme functions and definitions
 *
 */
 
add_theme_support( 'post-thumbnails' ); 
 
function register_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_menu' );

// Show the Admin Bar only to administrators
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');


/*
 * CREATE QUESTIONS POST TYPE
 * 
 */
add_action('init', 'create_questions');

function create_questions() {
    register_post_type('questions', array(
        'labels' => array(
            'name' => 'Questions',
            'singular_name' => 'List of Questions',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Questions',
            'edit' => 'Edit',
            'edit_item' => 'Edit Questions',
            'new_item' => 'New Questions',
            'view' => 'View',
            'view_item' => 'View Questions',
            'search_items' => 'Search Questions',
            'not_found' => 'No Questions',
            'not_found_in_trash' => 'No Questions found in Trash',
            'parent' => 'Parent Questions'
        ),
        'public' => true,
        'menu_position' => 15,
        'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
        //'taxonomies' => array('category', 'post_tag'),
        //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
        'has_archive' => true
            )
    );
}

add_action('init', 'question_taxonomies', 0);

function question_taxonomies() {
    register_taxonomy('question_category', 'questions', array('hierarchical' => true, 'label' => 'Questions Categories', 'query_var' => true, 'rewrite' => true));
}

function questions_taxonomy() {
    register_taxonomy(
            'question_tags', 'questions'
    );
}

add_action('init', 'questions_taxonomy');



/*
 * CREATE ANSWERES POST TYPE
 * 
 */
add_action('init', 'create_answers');

function create_answers() {
    register_post_type('answers', array(
        'labels' => array(
            'name' => 'Answers',
            'singular_name' => 'List of Answers',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Answers',
            'edit' => 'Edit',
            'edit_item' => 'Edit Answers',
            'new_item' => 'New Answers',
            'view' => 'View',
            'view_item' => 'View Answers',
            'search_items' => 'Search Answers',
            'not_found' => 'No Answers',
            'not_found_in_trash' => 'No Answers found in Trash',
            'parent' => 'Parent Answers'
        ),
        'public' => true,
        'menu_position' => 15,
        'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
        //'taxonomies' => array('category', 'post_tag'),
        //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
        'has_archive' => true
            )
    );
}

add_action('init', 'answers_taxonomies', 0);

function answers_taxonomies() {
    register_taxonomy('answers_category', 'answers', array('hierarchical' => true, 'label' => 'Answers Categories', 'query_var' => true, 'rewrite' => true));
}

function answers_taxonomy() {
    register_taxonomy(
            'answers_tags', 'answers'
    );
}

add_action('init', 'answers_taxonomy');


add_action( 'wp_ajax_calculate', 'calculate' );
add_action( 'wp_ajax_nopriv_calculate', 'calculate' );


function calculate()
{
    
//    $xml=simplexml_load_file("http://localhost/woo/wp-content/themes/hogskolene/coursefeed.xml") or die("Error: Cannot create object");
//print_r($xml);
//    
//    exit();
    
    session_start();
    $answerValue = $_POST['answer'];

    $count = 0;

    $questionValue = $_POST['question'];

    $linkedCategories = wp_get_post_terms($_POST['answer'], 'answers_category', array("fields" => "ids"));
    // print_r($linkedCategories);exit();
    // unset($_SESSION['category']);

    $count = $count + 1;
    // $_SESSION['category'][]=array($linkedCategories[$k] => $count);
    //print_r($_SESSION);
    //  print_r($linkedCategories);

    if (!empty($_SESSION['category'])) {
        for ($items = 0; $items < sizeof($linkedCategories); $items++) {
            // print_r($_SESSION['category'][$items]);

            if($_SESSION['category'][$items]){
            foreach ($_SESSION['category'][$items] as $key => $value) {
                //echo $value;

                if (in_array($key, $linkedCategories)) {
                    $_SESSION['category'][$items] = array($key => $value + 1);
                } else {
                    $_SESSION['category'][$items] = array($key => $value);
                }
            }
            }else
            {
               $_SESSION['category'][$items] = array($linkedCategories[$items] => 1);  
            }
        }
    } else {

        for ($newItems = 0; $newItems < sizeof($linkedCategories); $newItems++) {
            $_SESSION['category'][$newItems] = array($linkedCategories[$newItems] => 1);
        }
    }

   //print_r($_SESSION['category']);

  echo $questionValue;die();
  //print_r($_SESSION['category']);exit();
  
      }
      
      
      function get_final_course($category){
          $course=array();
    $xml=simplexml_load_file("http://solidmediagroup.com/apps/web/folkehogskole/wp-content/themes/hogskolene/coursefeed.xml") or die("Error: Cannot create object");
//print_r($xml);
  
    //print_r($xml->categories->category);
    
    //print_r(sizeof($xml->categories->category));
    
    
    for($i=0;$i<sizeof($xml->categories->category);$i++)
    {
       // echo $xml->categories->category[$i]->categoryname;
        
       // is_nu
        foreach($xml->categories->category[$i]->subcategories as $key=>$value)
        {
         
           for($j=0;$j<sizeof($value->subcategory);$j++)
           {
               // $value->subcategory[$j]->subcategoryname; sub category to compare
               //exit();
               if($value->subcategory[$j]->subcategoryname == $category){
               foreach($value->subcategory[$j]->courses as $coursekey=>$coursevalue)
               {
                  for($l=0;$l<sizeof($coursevalue->course);$l++)
                   {
                       $course[]=$coursevalue->course[$l];
                   }
                   
               }
               break;
               }
               
               
           }
            
            
        }
        
    }
    
   // print_r($course);
    return $course;
    //exit();

      }
            function fetch_relevant_categories($category){
          $course=array();
    $xml=simplexml_load_file("http://solidmediagroup.com/apps/web/folkehogskole/wp-content/themes/hogskolene/coursefeed.xml") or die("Error: Cannot create object");
//print_r($xml);
  
    //print_r($xml->categories->category);
    
    //print_r(sizeof($xml->categories->category));
    
    
    for ($i = 0; $i < sizeof($xml->categories->category); $i++) {
        // echo $xml->categories->category[$i]->categoryname;
        // is_nu
        foreach ($xml->categories->category[$i]->subcategories as $key => $value) {

            for ($j = 0; $j < sizeof($value->subcategory); $j++) {
                // $value->subcategory[$j]->subcategoryname; sub category to compare
                //exit();
                if ($value->subcategory[$j]->subcategoryname == $category) {

                    $iNew = $i;

                    foreach ($xml->categories->category[$iNew]->subcategories as $newkey => $newvalue) {

            for ($j = 0; $j < sizeof($newvalue->subcategory); $j++) {
               $newsub[]=$value->subcategory[$j]->subcategoryname;
                }
            }
        }
    }
        }
    }
   // exit();
//print_r($newsub);exit();
    // print_r($course);
    return $newsub;
    //exit();

      }
      
      
      function toArray($obj)
{
    if (is_object($obj)) $obj = (array)$obj;
    if (is_array($obj)) {
        $new = array();
        foreach ($obj as $key => $val) {
            $new[$key] = toArray($val);
        }
    } else {
        $new = $obj;
    }

    return $new;
}