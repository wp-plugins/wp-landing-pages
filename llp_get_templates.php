<h2>Select Template</h2>
<?php
$llp_sql_tmp = "SELECT * FROM " . $llp_db_prefix . "llp_templates WHERE tmp_status = 1";
$llp_rows = $wpdb->get_results($llp_sql_tmp);
?>
<div class="theme-browser rendered">
    <div class="themes">
        <?php foreach ($llp_rows as $llp_row) {
            ?>
            <div class="theme">
                <div class="theme-screenshot"> <img src="<?php echo llp_URL . '/images/' . $llp_row->tmp_preview; ?>" alt=""> </div>
                <span class="more-details"><?php echo $llp_row->tmp_name; ?></span>
                <div class="theme-author">By the WordPress team</div>
                <h3 class="theme-name"><?php echo $llp_row->tmp_name; ?></h3>
                <div class="theme-actions"> <a target="_blank" class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo home_url(); ?>/?tpl_id=<?php echo $llp_row->id; ?>&do=create">Use This Template</a> </div>
            </div>
        <?php } ?>
    </div>
    <br class="clear">
</div>