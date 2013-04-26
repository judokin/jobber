{include file="header.tpl"}
		
		<section id="content">
			<aside id="job-listings"></aside><!-- #job-listings -->
			<h3 class="page-heading">{$page.title}</h3>
			{$page.content}
			{if $page.has_form == '1'}
			{if $errors}
			<div class="validation-failure">
				{$errors.contact_error}
			</div>
			{elseif $smarty.session.contact_msg_sent == 1}
			<div class="apply-status-ok">
				{$page.form_message}
			</div>
			{/if}
			{if $smarty.session.contact_msg_sent != 1}
			<section id="contact-form">
				<section id="contact-form-contents">
					<form id="apply-online" method="post" action="{$BASE_URL}{$page.url}/">
						<label for="apply_name">{$translations.contact.name_label}:</label><br />
						<input {if $errors.contact_name}class="error"{/if} type="text" name="contact_name" id="contact_name" maxlength="50" size="30" value="{$smarty.post.contact_name}" placeholder="Contact name" /><br />
						<span class="validation-error">{if $errors.contact_name}<img src="{$BASE_URL}img/icon-delete.png" alt="" />{/if}</span>
						<label for="apply_email">{$translations.contact.email_label}:</label><br />
						<input {if $errors.contact_email}class="error"{/if} type="email" name="contact_email" id="contact_email" maxlength="50" size="30" value="{$smarty.post.contact_email}" placeholder="name@domain.co.uk" /><br />
						<span class="validation-error">{if $errors.contact_email}<img src="{$BASE_URL}img/icon-delete.png" alt="" />{/if}</span>
						<label for="apply_msg">{$translations.contact.message_label}:</label><br />
						<textarea {if $errors.contact_msg}class="error"{/if} name="contact_msg" id="contact_msg" cols="50" rows="8" placeholder="Your message" >{$smarty.post.contact_msg}</textarea>
						<span class="validation-error">{if $errors.contact_msg}<img src="{$BASE_URL}img/icon-delete.png" alt="" />{/if}</span>
						{if $ENABLE_RECAPTCHA}
							<br /><br />
							<label for="recaptcha_response_field">{$translations.captcha.captcha_title}:</label><br />
							{literal}
							<script type="text/javascript">
							  var RecaptchaOptions = {
							    theme : 'white',
							    tabindex : 9
							  };
							</script>
							{/literal}
							{$the_captcha}
							<span class="validation-error">{if $errors.captcha}<img src="{$BASE_URL}_templates/{$THEME}/img/icon-delete.png" alt="" /> {$errors.captcha}{/if}</span>
						{/if}
						<br />
						<input type="submit" name="submit" id="submit" value="{$translations.contact.submit}" />
					</form>
				</section><!-- #contact-form-contents -->
				{/if}
			</section><!-- #contact-form -->
			{/if}
		</section><!-- /content -->
		{if $page.has_form == '1'}
		{literal}
		<script type="text/javascript">
	 		$(document).ready(function()
			{
				$("#apply-online").validate({
					rules: {
						contact_name: { required: true },
						contact_email: { required: true, email: true },
						contact_msg: { required: true }
					},
					messages: {
						contact_name: ' <img src="{/literal}{$BASE_URL}_templates/{$THEME}/{literal}img/icon-delete.png" alt="" />',
						contact_email: ' <img src="{/literal}{$BASE_URL}_templates/{$THEME}/{literal}img/icon-delete.png" alt="" />',
						contact_msg: ' <img src="{/literal}{$BASE_URL}_templates/{$THEME}/{literal}img/icon-delete.png" alt="" />'
					}
				});
			});
		</script>
		{/literal}
		{/if}

{include file="footer.tpl"}