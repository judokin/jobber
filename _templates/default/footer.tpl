	</div><!-- #container -->
	<div class="footer">
		<div id="footer-contents">
			<div id="footer-col1">
				{$translations.footer.column_use}:<br />
				{if $navigation.footer1 != ''}
					{section name=tmp loop=$navigation.footer1}
						{if $smarty.const.ENABLE_NEW_JOBS || (!$smarty.const.ENABLE_NEW_JOBS && $navigation.footer1[tmp].url != 'post')}
							<a href="{if $navigation.footer1[tmp].outside != 1}{$BASE_URL}{/if}{$navigation.footer1[tmp].url}/" title="{$navigation.footer1[tmp].title}" >{$navigation.footer1[tmp].name}</a><br />
						{/if}
					{/section}
				{/if}
			</div>
			<div id="footer-col2">
				{$translations.footer.column_find}:<br />
				{if $navigation.footer2 != ''}
					{section name=tmp loop=$navigation.footer2}
						{if $smarty.const.ENABLE_NEW_JOBS || (!$smarty.const.ENABLE_NEW_JOBS && $navigation.footer2[tmp].url != 'post')}
							<a href="{if $navigation.footer2[tmp].outside != 1}{$BASE_URL}{/if}{$navigation.footer2[tmp].url}/" title="{$navigation.footer2[tmp].title}" >{$navigation.footer2[tmp].name}</a><br />
						{/if}
					{/section}
				{/if}
			</div>
			<div id="footer-col3">
				{$translations.footer.column_misc}:<br />
				{if $navigation.footer3 != ''}
					{section name=tmp loop=$navigation.footer3}
						{if $smarty.const.ENABLE_NEW_JOBS || (!$smarty.const.ENABLE_NEW_JOBS && $navigation.footer3[tmp].url != 'post')}
							<a href="{if $navigation.footer3[tmp].outside != 1}{$BASE_URL}{/if}{$navigation.footer3[tmp].url}/" title="{$navigation.footer3[tmp].title}" >{$navigation.footer3[tmp].name}</a><br />
						{/if}
					{/section}
				{/if}
			</div>
            <div id="footer-col4">
				{$translations.footer.friend_link}:<br />
				{if $navigation.footer4 != ''}
					{section name=tmp loop=$navigation.footer4}
						{if $smarty.const.ENABLE_NEW_JOBS || (!$smarty.const.ENABLE_NEW_JOBS && $navigation.footer4[tmp].url != 'post')}
							<a target="_blank" href="{if $navigation.footer4[tmp].outside != 1}{$BASE_URL}{/if}{$navigation.footer4[tmp].url}/" title="{$navigation.footer4[tmp].title}" >{$navigation.footer4[tmp].name}</a><br />
						{/if}
					{/section}
				{/if}
			</div>
			<div id="footer-copyright">
				{$translations.footer.powered_by}
				<a href="http://www.zhuzhenjin.com.cn" target="_blank" title="">zhu</a>
			</div>
			<div class="clear"></div>
		</div><!-- #footer-contents -->
	</div><!-- .footer -->
	{literal}
	<script type="text/javascript">
		//<![CDATA[
		
 		$(document).ready(function()
		{
		   var keywords = $('#keywords');
			// setup search box
			keywords.bind('click', function() {
				if (this.value == '{/literal}{$translations.search.default}{literal}')
				{
					keywords.clearFields();
				}
			});

			keywords.bind('blur', function() {  
				if (this.value == '{/literal}{$translations.search.default}{literal}' || this.value == '')
				{
					this.value = '{/literal}{$translations.search.default}{literal}';
				}
			});

			// setup live search
			keywords.keyup(function(key) {
				var searchKeywords = jQuery.trim(this.value);
				var len = searchKeywords.length;
				
			    if (key.keyCode != 9 && len >= 3)
				{
					$("#indicator").show();	
					clearTimeout(window.search_timer);	
					window.search_timer = setTimeout(function(){Jobber.PerformSearch('{/literal}{$BASE_URL}{literal}search/{/literal}{$current_category}{literal}|', searchKeywords)}, 800);
			    }
			});
		});
		Jobber.jobber_url = "{/literal}{$BASE_URL}{literal}";
		//]]>
	</script>
	{/literal}
	{php}
	  if (isset($_SESSION['status']))
		{
			unset($_SESSION['status']);
		}
		if (isset($_SESSION['apply_mail_sent']))
		{
			unset($_SESSION['apply_mail_sent']);
		}
		if (isset($_SESSION['apply_errors']))
		{
			unset($_SESSION['apply_errors']);
		}
		if (isset($_SESSION['apply_fields']))
		{
			unset($_SESSION['apply_fields']);
		}
		if (isset($_SESSION['apply_allowed']))
		{
			unset($_SESSION['apply_allowed']);
		}
		if (isset($_SESSION['apply_successful']))
		{
			unset($_SESSION['apply_successful']);
		}
		if (isset($_SESSION['contact_msg_sent']))
		{
			unset($_SESSION['contact_msg_sent']);
		}
		if (isset($_SESSION['contact_errors']))
		{
			unset($_SESSION['contact_errors']);
		}
		if (isset($_SESSION['contact_fields']))
		{
			unset($_SESSION['contact_fields']);
		}
	{/php}
    {literal}
        <script type="text/javascript">
		var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F576dc9a2751bc1e6beb0d0a2d147db78' type='text/javascript'%3E%3C/script%3E"));
		</script>
        <script src="http://s15.cnzz.com/stat.php?id=5208590&web_id=5208590&show=pic1" language="JavaScript"></script>
        <a href="http://webscan.360.cn/index/checkwebsite/url/www.zjwebjob.com"><img border="0" src="http://img.webscan.360.cn/status/pai/hash/6e60738f07f3a4b12580bfdb5c8c6e66"/></a>
    {/literal}
</body>
</html>