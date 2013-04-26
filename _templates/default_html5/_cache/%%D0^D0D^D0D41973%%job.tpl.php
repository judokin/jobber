<?php /* Smarty version 2.6.26, created on 2010-12-09 20:00:17
         compiled from job.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<section id="content">
			<aside id="job-listings"></aside><!-- #job-listings -->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "job-details.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['CURRENT_PAGE'] == $this->_tpl_vars['URL_JOB']): ?>
			<section id="job-bottom">
				<aside id="job-post-utils">
					<a href="<?php echo $this->_tpl_vars['back_link']; ?>
" title="category home">&laquo; <?php echo $this->_tpl_vars['translations']['notfound']['back']; ?>
</a><br />
					<?php echo $this->_tpl_vars['translations']['jobs']['report_fake']; ?>
 <a href="#" onclick="Jobber.ReportSpam('<?php echo $this->_tpl_vars['BASE_URL']; ?>
report-spam/', <?php echo $this->_tpl_vars['job']['id']; ?>
); return false;" title="report fake ad"><?php echo $this->_tpl_vars['translations']['jobs']['report_it']; ?>
</a>
					&nbsp;&nbsp;<span id="report-spam-response"></span><br />
					<a href="#" onclick="Jobber.SendToFriend.showHide(); return false;" title="<?php echo $this->_tpl_vars['translations']['recommend']['title']; ?>
"><?php echo $this->_tpl_vars['translations']['recommend']['title']; ?>
</a>
				</aside><!-- #job-post-utils -->
				<aside id="number-views">
					<?php echo $this->_tpl_vars['translator']->translate("jobs.published_at","<strong>".($this->_tpl_vars['job']['created_on'])."</strong>"); ?>

					<br />
					<?php echo $this->_tpl_vars['translator']->translate("jobs.viewed","<strong>".($this->_tpl_vars['job']['views_count'])."</strong>"); ?>

				</aside><!-- #number-views -->
				<div class="clear"></div>
			</section><!-- #job-bottom -->
			<section id="send-to-friend" style="display: none;">
				<form id="frm-send-to-friend" method="post" action="<?php echo $this->_tpl_vars['BASE_URL']; ?>
send-to-friend/">
					<table>
						<tr>
							<td class="send-to-friend-address-label"><label for="friend_email"><?php echo $this->_tpl_vars['translations']['recommend']['friend_email_label']; ?>
:</label></td>
							<td><input type="text" name="friend_email" id="friend_email" maxlength="50" size="30" /></td>
						</tr>
						<tr>
							<td><label for="my_email"><?php echo $this->_tpl_vars['translations']['recommend']['your_email_label']; ?>
:</label></td>
							<td><input type="text" name="my_email" id="my_email" maxlength="50" size="30" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="submit" id="submit" value="<?php echo $this->_tpl_vars['translations']['recommend']['submit']; ?>
" />
								&nbsp;&nbsp;<span id="send-to-friend-response"></span>
							</td>
						</tr>
					</table>
				</form>
			</section><!-- #send-to-friend -->
			<?php echo '
			<script type="text/javascript">
				$(document).ready(function()
				{
					Jobber.SendToFriend.init();
				});
			</script>
			'; ?>

			<?php endif; ?>
		</section><!-- /content -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>