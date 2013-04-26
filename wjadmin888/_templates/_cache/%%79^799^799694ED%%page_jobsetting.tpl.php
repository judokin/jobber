<?php /* Smarty version 2.6.26, created on 2013-04-26 08:44:33
         compiled from page_jobsetting.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content">
	<h2 id="pages">Pages - <em>职位设置</em></h2>
    <form method="post" action="">
	  <label>
	    更新日期:
	  </label>
	  <input type="submit" value="更新(全部加一天)" name="update" /><?php echo $this->_tpl_vars['updataret']; ?>

	</form>
	<br />
	<h2 id="pages">Pages - <em>职位抓取</em></h2>
	<form method="post" action="">
	  <label>
	    职位抓取:
	  </label>
	  <input type="text" value="http://jobs.zhaopin.com/152249012250005.htm" onclick="this.select();" name="url" size="168" />
	  <br />
	  <input type="submit" value="抓取" name="catch" />
	</form>
	<h2 id="pages">Pages - <em>智联高级职位抓取</em></h2>
	<form method="post" action="">
	  <label>
	    地区:
	  </label>
	  <select name="city_id" id="city_id" <?php if ($this->_tpl_vars['job']['location_outside_ro'] != ''): ?>disabled="disabled"<?php endif; ?> class="ml1">
		<option value="0"><?php echo $this->_tpl_vars['translations']['jobs']['location_anywhere']; ?>
</option>
		<?php 
		  foreach(get_cities() as $k=>$v){
		    echo "<option value='$v[id]'>$v[name]</option>";
		  }
		 ?>
	  </select>
	  <br />
	  关键词： 
	  <input type="text" name="kw" />
	  <br />
	  分类：
	  <select name="category_id" id="category_id">
	    <?php 
		  foreach(get_categories() as $k=>$v){
		    echo "<option value='$v[id]'>$v[name]</option>";
		  }
		 ?>
	  </select>
	  <br />
	  <input type="submit" name="catchzhaopin" value="抓取" />
	</form>
	<h2 id="pages">Pages - <em>职位日期随机</em></h2>
	<form method="post" action="">
	  日期：<select name="date">
	          <option value="<?php echo date('Y-m-d'); ?>">当天</option>
			  <option value="0">指定日期</option>
			</select>
			<br />
	  指定日期：
            <input type="text" value="" name="setdate" />(格式：2013-05-16)
        	<br />
            <input type="submit" name="randdate" value="抓取" /><?php echo $this->_tpl_vars['randdateret']; ?>
			
	</form>
	  <?php 
	    if(isset($_SESSION['catchzhaopin'])){
		  echo '<form method="post" action="">';
		  echo '<table>';
		  echo '<tr><td>职位名称</td><td>URL</td><td><span id="checkall">全选</span></td></tr>';
		  foreach($_SESSION['catchzhaopin'] as $k=>$v){
		    $name = $_SESSION['catchzhaopintitle'][$k];
		    echo "<tr><td>$name</td><td>$v</td><td><input type=\"checkbox\" class=\"check\" name=\"id[]\" value=\"$k\" /></td></tr>";
		  }
		  echo '</table>';
		  echo '<input type="submit" name="savecatchzhaopin" value="抓取" />';
		  echo '</form>';
		}
	   ?>
	  <?php echo '
	  <script>
	  $(document).ready(function(){
	  $("#checkall").click(function(){
	    $("input.check").each(function(){
		  if($(this).attr("checked")){
		    $(this).attr("checked","false");
		  }
		  else{
			$(this).attr("checked","true");
		  }
		});
	  });
	});
	 </script>
	  '; ?>

</div><!-- #content -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>