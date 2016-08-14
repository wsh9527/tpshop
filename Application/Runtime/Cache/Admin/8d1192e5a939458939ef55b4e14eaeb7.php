<?php if (!defined('THINK_PATH')) exit();?><ul>
    <?php if(is_array($ajax_tree_list)): foreach($ajax_tree_list as $k=>$vo): ?><li>
        <span class="tree_span" data-id="<?php echo ($vo["user_id"]); ?>">
        <i class="icon-folder-open"></i>
        <?php echo ($vo["tree_id"]); ?>:
        <?php echo ($vo["user_name"]); ?>
        </span>
    </li><?php endforeach; endif; ?>
</ul>