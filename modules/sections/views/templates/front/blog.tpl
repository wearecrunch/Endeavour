		<section class="container" id="content-section">
			{include file="{$tpl_dir}top.tpl"}
			<div class="posts">
				{foreach $items as $item}
				<article class="post col-xs-12 {if $item->is_big}col-md-8{else}col-md-4{/if}">
					<div class="post-cover" style="background-image: url({$item->getURL()});">
						<img src="{$item->getURL()}" alt="{$item->title}">
					</div>
					<footer class="post-meta" style="background-color: {$item->color};">
						<div class="post-heading">
							<strong class="post-heading-title">{$item->title}</strong>
							<span class="post-heading-date">{$item->getDate()}</span>
						</div>
						<div class="post-content">
							{$item->content}
						</div>
					</footer>
				</article>
				{/foreach}
			</div>
			<nav id="pagination" class="hidden">
				<a href="#" class="btn pagination-left"><i class="icon icon-left"></i>Newer</a>
				<a href="#" class="btn pagination-right">Older<i class="icon icon-right"></i></a>
			</nav>
		</section>