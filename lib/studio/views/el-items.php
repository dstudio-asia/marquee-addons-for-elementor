<script type="text/template" id="tmpl-ma-el-studio-items">
<# 
for (const item of data.items) {
	const key = item.id;
#>

	<div class="ma-el-studio__item">

		<div class="ma-el-studio__item__body">
			<div class="ma-el-studio__item__preview elementor-template-library-template-preview ma-el-studio__item__preview" data-id="{{ key }}">
				<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
			</div>
			<img src="{{ item.thumbnailSrc }}" srcset="{{ item.thumbnailSrcset }}" alt="{{ item.title }}"  width="{{ item.thumbWidth }}" />
		</div>

		<div class="elementor-template-library-template-footer">
			<div class="ma-el-studio__item__name">{{ item.title }}</div>
			<a class="elementor-template-library-template-action elementor-template-library-template-insert ma-el-studio__item__insert" data-id="{{ key }}">
				<i class="eicon-file-download" aria-hidden="true"></i>
				<?php esc_html_e('Insert', 'marquee-addons-for-elementor'); ?>
			</a>
		</div>

	</div>

<# } #>
</script>