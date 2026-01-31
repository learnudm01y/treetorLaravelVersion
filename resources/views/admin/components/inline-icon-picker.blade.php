{{--
    Inline Icon Picker for Dynamic Lists
    Works with x-model inside template loops
--}}

<div x-data="inlineIconPicker()" class="inline-icon-picker relative">
    {{-- Trigger Button --}}
    <button type="button"
            @click="togglePicker()"
            class="w-full flex items-center gap-2 rounded-lg border border-gray-200 bg-transparent px-3 py-2 text-left text-gray-800 hover:border-brand-300 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:border-gray-700 transition-colors">
        <span x-show="$el.closest('[x-data]').querySelector('input[type=hidden]')?.value" class="w-6 h-6 flex items-center justify-center">
            <i :class="$el.closest('[x-data]').querySelector('input[type=hidden]')?.value || ''" class="text-brand-500"></i>
        </span>
        <span x-show="!$el.closest('[x-data]').querySelector('input[type=hidden]')?.value" class="text-gray-400 text-sm">Choose icon</span>
        <svg class="w-4 h-4 text-gray-400 ml-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9l6 6 6-6"/>
        </svg>
    </button>

    {{-- Dropdown Picker --}}
    <div x-show="isOpen"
         x-transition
         @click.away="closePicker()"
         class="absolute z-50 mt-1 w-80 bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
         style="display: none;">

        {{-- Search --}}
        <div class="p-3 border-b border-gray-100 dark:border-gray-800">
            <input type="text"
                   x-model="search"
                   @input="filterIcons()"
                   placeholder="Search icons..."
                   class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:border-brand-300">
        </div>

        {{-- Quick Categories --}}
        <div class="flex gap-1 px-3 py-2 border-b border-gray-100 dark:border-gray-800 overflow-x-auto">
            <template x-for="cat in quickCategories" :key="cat.name">
                <button type="button"
                        @click="filterByCategory(cat.name)"
                        :class="activeCategory === cat.name ? 'bg-brand-500 text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300'"
                        class="px-2 py-1 text-xs rounded-md whitespace-nowrap"
                        x-text="cat.label"></button>
            </template>
        </div>

        {{-- Icons Grid --}}
        <div class="max-h-48 overflow-y-auto p-2">
            <div class="grid grid-cols-8 gap-1">
                <template x-for="icon in displayedIcons.slice(0, 64)" :key="icon">
                    <button type="button"
                            @click="selectIcon(icon)"
                            :title="icon"
                            class="w-8 h-8 flex items-center justify-center rounded hover:bg-brand-100 dark:hover:bg-gray-700 transition-colors">
                        <i :class="icon" class="text-gray-700 dark:text-gray-300"></i>
                    </button>
                </template>
            </div>
            <p x-show="displayedIcons.length === 0" class="text-center text-sm text-gray-400 py-4">No icons found</p>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('inlineIconPicker', () => ({
        isOpen: false,
        search: '',
        activeCategory: 'popular',
        displayedIcons: [],

        quickCategories: [
            { name: 'popular', label: 'Popular' },
            { name: 'business', label: 'Business' },
            { name: 'ui', label: 'UI' },
            { name: 'social', label: 'Social' },
        ],

        icons: {
            popular: ['fas fa-star','fas fa-heart','fas fa-check','fas fa-check-circle','fas fa-cog','fas fa-cogs','fas fa-home','fas fa-user','fas fa-users','fas fa-bell','fas fa-envelope','fas fa-phone','fas fa-map-marker-alt','fas fa-search','fas fa-plus','fas fa-minus','fas fa-times','fas fa-edit','fas fa-trash','fas fa-download','fas fa-upload','fas fa-share','fas fa-link','fas fa-lock','fas fa-unlock','fas fa-key','fas fa-eye','fas fa-eye-slash','fas fa-info-circle','fas fa-question-circle','fas fa-exclamation-circle','fas fa-thumbs-up','fas fa-thumbs-down','fas fa-comment','fas fa-comments','fas fa-calendar','fas fa-clock','fas fa-bookmark','fas fa-flag','fas fa-tag','fas fa-tags','fas fa-folder','fas fa-file','fas fa-image','fas fa-camera','fas fa-video','fas fa-music','fas fa-headphones','fas fa-microphone','fas fa-play','fas fa-pause','fas fa-stop','fas fa-forward','fas fa-backward','fas fa-arrow-up','fas fa-arrow-down','fas fa-arrow-left','fas fa-arrow-right','fas fa-chevron-up','fas fa-chevron-down','fas fa-chevron-left','fas fa-chevron-right','fas fa-bars'],
            business: ['fas fa-briefcase','fas fa-building','fas fa-chart-line','fas fa-chart-bar','fas fa-chart-pie','fas fa-coins','fas fa-credit-card','fas fa-dollar-sign','fas fa-euro-sign','fas fa-file-invoice','fas fa-file-invoice-dollar','fas fa-hand-holding-dollar','fas fa-landmark','fas fa-money-bill','fas fa-money-bill-wave','fas fa-money-check','fas fa-piggy-bank','fas fa-receipt','fas fa-sack-dollar','fas fa-scale-balanced','fas fa-vault','fas fa-wallet','fas fa-handshake','fas fa-user-tie','fas fa-users-cog','fas fa-id-card','fas fa-id-badge','fas fa-address-book','fas fa-address-card','fas fa-calendar-check','fas fa-clipboard','fas fa-clipboard-check','fas fa-clipboard-list','fas fa-tasks','fas fa-bullhorn','fas fa-bullseye','fas fa-certificate','fas fa-award','fas fa-medal','fas fa-trophy','fas fa-crown','fas fa-gem','fas fa-ring','fas fa-spa','fas fa-leaf','fas fa-seedling','fas fa-tree','fas fa-fan','fas fa-bath','fas fa-pump-soap','fas fa-spray-can','fas fa-wand-magic-sparkles','fas fa-lightbulb','fas fa-brain','fas fa-rocket','fas fa-bolt','fas fa-fire','fas fa-globe','fas fa-earth-americas','fas fa-network-wired','fas fa-server','fas fa-database','fas fa-cloud','fas fa-code'],
            ui: ['fas fa-bars','fas fa-grip','fas fa-grip-lines','fas fa-grip-vertical','fas fa-ellipsis','fas fa-ellipsis-vertical','fas fa-angle-down','fas fa-angle-up','fas fa-angle-left','fas fa-angle-right','fas fa-angles-down','fas fa-angles-up','fas fa-angles-left','fas fa-angles-right','fas fa-caret-down','fas fa-caret-up','fas fa-caret-left','fas fa-caret-right','fas fa-circle','fas fa-circle-dot','fas fa-square','fas fa-square-check','fas fa-toggle-on','fas fa-toggle-off','fas fa-sliders','fas fa-filter','fas fa-sort','fas fa-sort-up','fas fa-sort-down','fas fa-expand','fas fa-compress','fas fa-maximize','fas fa-minimize','fas fa-arrows-rotate','fas fa-rotate','fas fa-redo','fas fa-undo','fas fa-sync','fas fa-spinner','fas fa-circle-notch','fas fa-gear','fas fa-gears','fas fa-wrench','fas fa-screwdriver','fas fa-hammer','fas fa-toolbox','fas fa-paint-brush','fas fa-palette','fas fa-fill','fas fa-eraser','fas fa-pen','fas fa-pencil','fas fa-marker','fas fa-highlighter','fas fa-copy','fas fa-paste','fas fa-cut','fas fa-scissors','fas fa-trash-can','fas fa-box-archive','fas fa-window-maximize','fas fa-window-minimize','fas fa-window-restore','fas fa-layer-group'],
            social: ['fab fa-facebook','fab fa-facebook-f','fab fa-twitter','fab fa-x-twitter','fab fa-instagram','fab fa-linkedin','fab fa-linkedin-in','fab fa-youtube','fab fa-tiktok','fab fa-pinterest','fab fa-pinterest-p','fab fa-snapchat','fab fa-whatsapp','fab fa-telegram','fab fa-discord','fab fa-slack','fab fa-skype','fab fa-viber','fab fa-line','fab fa-wechat','fab fa-qq','fab fa-weibo','fab fa-reddit','fab fa-reddit-alien','fab fa-tumblr','fab fa-medium','fab fa-blogger','fab fa-wordpress','fab fa-dribbble','fab fa-behance','fab fa-github','fab fa-gitlab','fab fa-bitbucket','fab fa-stack-overflow','fab fa-codepen','fab fa-jsfiddle','fab fa-figma','fab fa-sketch','fab fa-invision','fab fa-trello','fab fa-asana','fab fa-jira','fab fa-confluence','fab fa-notion','fab fa-dropbox','fab fa-google-drive','fab fa-amazon','fab fa-ebay','fab fa-shopify','fab fa-etsy','fab fa-stripe','fab fa-paypal','fab fa-apple-pay','fab fa-google-pay','fab fa-cc-visa','fab fa-cc-mastercard','fab fa-cc-amex','fab fa-btc','fab fa-ethereum','fab fa-spotify','fab fa-soundcloud','fab fa-apple','fab fa-android']
        },

        init() {
            this.displayedIcons = this.icons.popular;
        },

        togglePicker() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.search = '';
                this.activeCategory = 'popular';
                this.displayedIcons = this.icons.popular;
            }
        },

        closePicker() {
            this.isOpen = false;
        },

        filterByCategory(category) {
            this.activeCategory = category;
            this.search = '';
            this.displayedIcons = this.icons[category] || [];
        },

        filterIcons() {
            if (!this.search.trim()) {
                this.displayedIcons = this.icons[this.activeCategory] || [];
                return;
            }

            const query = this.search.toLowerCase();
            let allIcons = [];
            Object.values(this.icons).forEach(arr => allIcons = allIcons.concat(arr));
            this.displayedIcons = allIcons.filter(icon => icon.toLowerCase().includes(query));
        },

        selectIcon(iconClass) {
            // Find the parent component and update its model
            const wrapper = this.$el.closest('.inline-icon-picker');
            const hiddenInput = wrapper.previousElementSibling;
            if (hiddenInput && hiddenInput.tagName === 'INPUT') {
                hiddenInput.value = iconClass;
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            this.closePicker();
        }
    }));
});
</script>
@endpush
@endonce
