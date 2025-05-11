/**
 * MarqueeAddons Template Library Studio.
 */
(function($, _) {
	'use strict';
	const marqueeStudio = {
		atIndex: 0,
		modal: null,
		modalEl: {},
		contentEl: {},
		allItems: {},
		items: {},
		filters: {},
		activeTab: 'blocks',
		importing: false,
		
		init() {
			elementor.on('preview:loaded', this.setup.bind(this));
			this.modifyAddTemplate();
		},

		setup() {
			if (!this.modal) {
				this.modal = elementor.dialogsManager.createWidget('lightbox', {
					id: 'ma-el-studio',
					closeButton: false
				});
			}

			// Modal button events.
			if (!elementor.$previewContents) {
				return;
			}

			elementor.$previewContents.on(
				'click.ts-studio',
				'.ma-el-studio-launch',
				this.launchModal.bind(this)
			);

		},

		modifyAddTemplate() {
			const tpl = $('#tmpl-elementor-add-section');
			const content = tpl.text().replace(
				'<div class="elementor-add-section-drag-title',
				`<img class="ma-el-studio-launch" src="${marqueeStudioData.libraryIcon}" alt=""><div class="elementor-add-section-drag-title`
			);

			tpl.text(content);
		},

		

		/**
		 * The main modal initialization.
		 */
		initModal() {

			this.modalEl = $('#ma-el-studio');
			this.modalEl.addClass('ma-el-studio');

			this.initData();
			this.renderModalView();

			// Event: Close.
			$(this.modalEl).on('click', '.elementor-templates-modal__header__close', () => this.modal.hide());

			// Event: Tab.
			$(this.modalEl).on('click', '.ma-el-studio__header__tab', e => {
				e.preventDefault();

				const ele = $(e.currentTarget);
				this.activeTab = ele.data('tab');
				this.renderListing(this.activeTab);

				ele.parent().find('.elementor-active').removeClass('elementor-active');
				ele.addClass('elementor-active');
			});

			// Event: Filter.
			$(this.modalEl).on('click', '.ma-el-studio__filters__item', e => {
				e.preventDefault();

				const ele = $(e.currentTarget);
				this.renderItems(this.activeTab, ele.data('filter'));

				ele.parent().find('.active').removeClass('active');
				ele.addClass('active');
			});

			// Event: Item Preview.
			$(this.modalEl).on('click', '.ma-el-studio__item__preview', e => {
				const ele = $(e.currentTarget);
				this.renderPreview(ele.data('id'));

				return false;
			});

			// Event: Back in preview.
			$(this.modalEl).on('click', '.ma-el-studio__header__back', e => {
				this.renderModalView();
			});

			// Event: Insert template.
			$(this.modalEl).on('click', '.ma-el-studio__insert', e => {
				const ele = $(e.currentTarget);
				ele.html('Importing...');
				this.showLoader();
				this.importTemplate(ele.data('id'));
			});

			// Event: Insert template - inline.
			$(this.modalEl).on('click', '.ma-el-studio__item__insert', e => {
				const ele = $(e.currentTarget);
				const id  = ele.data('id');

				this.renderPreview(id);
				$(this.modalEl).find('.ma-el-studio__insert').trigger('click');
			});
		},

		initData() {

			this.allItems = marqueeStudioData.elTemplates;

			const toArray = items => Object.entries(items).map(item => {
				return {id: item[0], ...item[1]};
			});

			this.items = {
				blocks: toArray(_.pick(this.allItems, value => value.tab === 'blocks')),
			};

			this.filters = {
				blocks: {
					all: 'All',
					imageMarquee: 'Image Marquee',
					textMarquee: 'Text Marquee',
					videoMarquee: 'Video Marquee',
					testimonialMarquee: 'Testimonial Marquee',
					imageAccordion: 'Image Accordion',
					stackedSlider: 'Stacked Slider',
				}
			};
		},

		renderModalView() {
			// Add header template.
			this.modalEl.find('.dialog-lightbox-header').html(
				wp.template('ma-el-studio-header')({
					activeTab: this.activeTab
				})
			);

			// The content wrapper.
			this.contentEl = this.modalEl.find('.dialog-lightbox-message');

			// Default to block listsing.
			this.renderListing(this.activeTab);
		},

		showLoader() {
			this.contentEl.html(
				wp.template('elementor-template-library-loading')()
			);
		},

		/**
		 * Render a listing and add to content element.
		 * 
		 * @param {String} type 
		 */
		renderListing(type) {
			type = type || 'blocks';

			let template = wp.template('ma-el-studio-' + type)({
				filters: this.filters[type]
			});

			// Default to all filter.
			template = $(template);
			template.find('[data-filter=all]').addClass('active');

			this.contentEl.html(template);
			this.renderItems(type);
		},

		/**
		 * Render items with or without filters.
		 * 
		 * @param {String} type 
		 * @param {String} filter 
		 */
		renderItems(type, filter) {
			type = type || 'blocks';

			const setThumbnails = items => items.map(item => {
				if (item.thumbnail) {
					item.thumbnailSrc = item.thumbnail;
					item.thumbnailSrcset = '';

					if (item.thumbnail.includes('@2x')) {
						item.thumbnailSrc = item.thumbnail.replace('@2x', '@1x');
						item.thumbnailSrcset = `${item.thumbnail} 2x`;
					}
				}
			
				return item;
			});

			const items = setThumbnails(
				this.filterItems(this.items[type], filter)
			);

			let sortedItems = items;
			if (!filter || filter === 'all') {
				sortedItems = items.reverse().sort((a, b) => {
					a.order = a.order || 0;
					b.order = b.order || 0;

					if (a.order < b.order) {
						return 1;
					}

					if (a.order > b.order) {
						return -1;
					}

					return 0;
				});
			}
			
			const template = wp.template('ma-el-studio-items')({
				items: sortedItems
			});

			const itemsEl = this.contentEl.find('.ma-el-studio__items');
			itemsEl.html(template);
			itemsEl.imagesLoaded(() => new Masonry(itemsEl[0]));
		},

		filterItems(items, filter) {
			if (!filter || filter === 'all') {
				return items;
			}
			
			return items.filter(value => value.tags.includes(filter));

		},

		/**
		 * Render preview view.
		 * 
		 * @param {String|Number} id 
		 */
		renderPreview(id) {

			const item = this.getItem(id);

			// Replace header.
			this.modalEl.find('.dialog-lightbox-header').html(
				wp.template('ma-el-studio-header-preview')({
					id: id,
					livePreview: item.livePreview
				})
			);

			if (item.preview) {
				item.previewSrc = item.preview;
				item.previewSrcset = '';

				if (item.preview.includes('@2x')) {
					item.previewSrc = item.preview.replace('@2x', '@1x');
					item.previewSrcset = `${item.preview} 2x`;
				}
			}

			const template = wp.template('ma-el-studio-preview')({item});
			this.contentEl.html(template);
		},

		getItem(id, tab) {
			tab = tab || this.activeTab;
			return this.items[tab].find(e => e.id == id);
		},

		/**
		 * Import a template into the editor.
		 * 
		 * @param {String|Number} id 
		 */
		importTemplate(id, type) {
			// type = type || this.activeTab;

			if (this.importing) {
				return;
			}

			this.importing = true;

			$.get(
				ajaxurl,
				{
					action: 'ma-el-studio-template',
					id: id
				}, 
				response => {

					this.importing = false;
					if (!response.success) {
						return;
					}

					const model = new Backbone.Model({
						title: this.allItems[id].title
					});

					$e.run('document/elements/import', {
						model,
						data: response.data,
						options: {at: this.atIndex}
					});

					this.modal.hide();
				}
			);
		},

		/**
		 * Show the modal.
		 */
		launchModal(e) {

			/**
			 * Dark mode detection.
			 */
			if (elementor.settings.editorPreferences.model) {
				let scheme = elementor.settings.editorPreferences.model.get('ui_theme');
				if (scheme === 'auto') {
					scheme = matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
				}

				$('body').removeClass('ma-el--dark');
				if (scheme === 'dark') {
					$('body').addClass('ma-el--dark');
				}
			}

			/**
			 * Store at position.
			 */
			const section = $(e.currentTarget).closest('.elementor-top-section');
			const modelID = section.data('model-cid');

			// Setup index position.
			if (elementor.getPreviewView && elementor.getPreviewView().collection.length) {
				$.each(elementor.getPreviewView().collection, (index, model) => {
					if (modelID === model.cid) {
						this.atIndex = index;
					}
				});
			}

			this.modal.show();
			this.initModal();
		},
	}

	$(window).on('elementor:init', () => marqueeStudio.init());

})(jQuery, window._);