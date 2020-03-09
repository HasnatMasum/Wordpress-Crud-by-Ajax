<?php 
     require_once (plugin_dir_path( __DIR__ ) .'inc/class.personstable.php');
     global $wpdb;
    $all_persons = $wpdb->get_results("SELECT id, name, email, age FROM {$wpdb->prefix}persons ORDER BY id DESC",ARRAY_A);
    
    if($wpdb->num_rows>0){
        
        function person_search_by_name($item){
            $name = strtolower($item['name']);
            $search_name = sanitize_text_field( $_REQUEST['s'] );
            if(strpos($name,$search_name)!==false ){
                return true;
            }
            return false;
        }
        if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
            $search_name = $_REQUEST['s'];
            $all_persons = array_filter($all_persons,'person_search_by_name');
        }

        
?>

<div class="form-wraper dp-person">
    <h2> <?php _e( "All Persons Information",'sa-crud' ); ?></h2>
    <div class="form-content">
        <?php 
            
            $dbpd = new PersonsTable($all_persons);
            $dbpd->prepare_items();
            ?>
        <div class="search-wrap">
            <form method="get">
                <?php 
                    $dbpd->search_box('search','search_id');
                    $dbpd->display();
                ?>
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
            </form>
        </div>
    </div>
</div>
<?php }else{
    echo "<h2>No Persons Were Found </h2><p style='color:red;'>Please Add Persons First</p>";
}
