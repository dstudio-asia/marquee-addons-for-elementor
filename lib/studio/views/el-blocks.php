<script type="text/template" id="tmpl-ma-el-studio-blocks">
	<div class="ma-el-studio__listing">
		<div class="ma-el-studio__filters">
			<# 
			for (const key in data.filters) { 
				const label = data.filters[key];
			#>

				<a class="ma-el-studio__filters__item" data-filter="{{ key }}">{{ label }}</a>

			<# } #>

		</div>

		<div class="ma-el-studio__items"></div>
	</div>
</script>
