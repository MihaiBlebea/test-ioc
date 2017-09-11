<?php
/* Smarty version 3.1.31, created on 2017-09-11 13:53:35
  from "C:\Laragon\www\Tests\test-IOC\views\templates\error.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59b6955f4e31e6_61353364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5d1c9862133ed032307846744436af389c09cb8' => 
    array (
      0 => 'C:\\Laragon\\www\\Tests\\test-IOC\\views\\templates\\error.tpl',
      1 => 1505138012,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59b6955f4e31e6_61353364 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_199950678759b6955f4d4992_23230931', "body");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_34334135059b6955f4e1d85_42921627', "footer");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'misc_layout.tpl');
}
/* {block "body"} */
class Block_199950678759b6955f4d4992_23230931 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_199950678759b6955f4d4992_23230931',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

                    <?php if ($_smarty_tpl->tpl_vars['error']->value !== false) {?>
                        <div class="col-md-8 col-sm-12">
                            <h4 class="card-title">404 - Un cod ciudat</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Nu intra in panica,asta inseamna doar ca pagina pe care o cauti nu exista</h6>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['app_path']->value;?>
/select"><button type="button" class="btn btn-primary btn-lg">Vreau sa ajung acasa</button></a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block "body"} */
/* {block "footer"} */
class Block_34334135059b6955f4e1d85_42921627 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_34334135059b6955f4e1d85_42921627',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "footer"} */
}
