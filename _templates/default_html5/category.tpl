{include file="header.tpl"}
		
		<section id="content">
			<section id="job-listings">
				{if $jobs}
				<div id="sort-by-type">
				{$translations.category.display_only}&nbsp; 
					{section name=tmp loop=$types}
						<a href="{$BASE_URL}{$URL_JOBS}/{$current_category}/{$types[tmp].var_name}/" title="{$current_category} {$types[tmp].name}"><img src="{$BASE_URL}_templates/{$THEME}/img/icon-{$types[tmp].var_name}.png" alt="{$types[tmp].name}" /></a>
					{/section}
				</div><!-- #sort-by-type -->
				{/if}
				<h2>
					{$translations.category.jobs_for} {$current_category_name}
				</h2>
				{include file="posts-loop.tpl"}
			</section><!-- #job-listings -->
		</section><!-- #content -->

{include file="footer.tpl"}