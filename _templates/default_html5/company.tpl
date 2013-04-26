{include file="header.tpl"}
		
		<section id="content">
			<section id="job-listings">
				<h2>
					{$translations.companies.jobs_at} {$current_company}
				</h2>
				{include file="posts-loop.tpl"}
			</section><!-- #job-listings -->
		</section><!-- #content -->

{include file="footer.tpl"}