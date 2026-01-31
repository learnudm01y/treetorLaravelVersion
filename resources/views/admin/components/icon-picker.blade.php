{{--
    FontAwesome Icon Picker Component
    Usage: @include('admin.components.icon-picker', ['name' => 'icon', 'value' => old('icon'), 'label' => 'Select Icon'])
--}}

@props([
    'name' => 'icon',
    'value' => '',
    'label' => 'FontAwesome Icon',
    'required' => false,
    'id' => null
])

@php
    $inputId = $id ?? 'icon-picker-' . Str::random(8);
@endphp

<div x-data="iconPicker('{{ $value }}')" class="icon-picker-wrapper">
    <label for="{{ $inputId }}" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <div class="flex gap-2">
        <input type="hidden" name="{{ $name }}" x-model="selectedIcon">

        <div class="flex-1 relative">
            <button type="button"
                    @click="openModal()"
                    class="w-full flex items-center gap-3 rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-left text-gray-800 hover:border-brand-300 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:border-gray-700 transition-colors">
                <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-900/20 flex items-center justify-center flex-shrink-0">
                    <i x-show="selectedIcon" :class="selectedIcon" class="text-lg text-brand-500"></i>
                    <svg x-show="!selectedIcon" class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                </div>
                <span x-show="selectedIcon" x-text="selectedIcon" class="text-sm font-mono"></span>
                <span x-show="!selectedIcon" class="text-gray-400">Click to choose an icon...</span>
                <svg class="w-5 h-5 text-gray-400 ml-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>
        </div>

        <button type="button"
                x-show="selectedIcon"
                @click="clearIcon()"
                class="w-12 h-12 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-300 dark:border-gray-800 dark:hover:border-red-800 transition-colors"
                title="Clear icon">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Icon Picker Modal --}}
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[99999] overflow-y-auto"
         style="display: none;">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

        {{-- Modal --}}
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div x-show="isOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.away="closeModal()"
                 class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[85vh] overflow-hidden flex flex-col">

                {{-- Modal Header --}}
                <div class="flex-shrink-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-6 py-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Choose an Icon</h3>
                        <button type="button" @click="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 6L6 18M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Search --}}
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                        <input type="text"
                               x-model="searchQuery"
                               @input.debounce.200ms="filterIcons()"
                               placeholder="Search icons... (e.g. home, user, star)"
                               class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    {{-- Category Tabs --}}
                    <div class="flex gap-2 mt-4 overflow-x-auto pb-2">
                        <template x-for="category in categories" :key="category.name">
                            <button type="button"
                                    @click="selectCategory(category.name)"
                                    :class="activeCategory === category.name ? 'bg-brand-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700'"
                                    class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors">
                                <span x-text="category.label"></span>
                                <span class="ml-1 opacity-60" x-text="'(' + category.count + ')'"></span>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Icons Grid --}}
                <div class="flex-1 overflow-y-auto p-6" x-ref="iconsContainer" @scroll="handleScroll()">
                    {{-- No Results --}}
                    <div x-show="displayedIcons.length === 0 && !loading" class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">No icons found</p>
                    </div>

                    {{-- Icons Grid --}}
                    <div x-show="displayedIcons.length > 0" class="icon-grid">
                        <template x-for="icon in displayedIcons" :key="icon.class">
                            <button type="button"
                                    @click="selectIcon(icon.class)"
                                    :class="tempSelection === icon.class ? 'icon-selected' : 'icon-normal'"
                                    :title="icon.name"
                                    class="icon-btn">
                                <i :class="icon.class"></i>
                            </button>
                        </template>
                    </div>

                    {{-- Load More Button --}}
                    <div x-show="hasMore" class="text-center py-4 mt-4">
                        <button type="button" @click="loadMoreIcons()" class="px-6 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-colors">
                            Load More Icons (<span x-text="filteredIcons.length - displayedIcons.length"></span> remaining)
                        </button>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex-shrink-0 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div x-show="tempSelection" class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                                <i :class="tempSelection" class="text-xl text-brand-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">Selected:</p>
                                <p class="text-xs text-gray-500 font-mono" x-text="tempSelection"></p>
                            </div>
                        </div>
                        <div x-show="!tempSelection" class="text-sm text-gray-500">
                            Click on an icon to select it
                        </div>
                        <div class="flex gap-3">
                            <button type="button" @click="closeModal()" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">
                                Cancel
                            </button>
                            <button type="button" @click="confirmSelection()" :disabled="!tempSelection" :class="!tempSelection ? 'opacity-50 cursor-not-allowed' : ''" class="px-6 py-2 rounded-lg bg-brand-500 text-white hover:bg-brand-600 transition-colors">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    gap: 8px;
}
.icon-btn {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.15s ease;
    font-size: 1.25rem;
    border: none;
}
.icon-normal {
    background-color: #f3f4f6;
    color: #374151;
}
.icon-normal:hover {
    background-color: #e0e7ff;
    color: #4f46e5;
}
.icon-selected {
    background-color: #465fff;
    color: white;
    box-shadow: 0 0 0 3px rgba(70, 95, 255, 0.3);
}
.dark .icon-normal {
    background-color: #1f2937;
    color: #d1d5db;
}
.dark .icon-normal:hover {
    background-color: #374151;
    color: #818cf8;
}
</style>

@once
@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('iconPicker', (initialValue = '') => ({
        isOpen: false,
        selectedIcon: initialValue,
        tempSelection: '',
        searchQuery: '',
        activeCategory: 'all',
        loading: false,

        // Pagination
        currentPage: 0,
        perPage: 100,
        hasMore: true,

        // Icons data
        allIcons: [],
        filteredIcons: [],
        displayedIcons: [],

        categories: [
            { name: 'all', label: 'All Icons', count: 0 },
            { name: 'solid', label: 'Solid', count: 0 },
            { name: 'regular', label: 'Regular', count: 0 },
            { name: 'brands', label: 'Brands', count: 0 },
        ],

        init() {
            this.loadIcons();
        },

        loadIcons() {
            const solidIcons = ['address-book','address-card','anchor','angle-down','angle-left','angle-right','angle-up','archive','arrow-down','arrow-left','arrow-right','arrow-up','arrows-rotate','at','award','bag-shopping','ban','bank','barcode','bars','basket-shopping','bath','battery-full','bed','bell','bell-slash','bicycle','bolt','bomb','bone','book','book-open','bookmark','box','boxes-stacked','brain','briefcase','brush','bug','building','bullhorn','bullseye','bus','calculator','calendar','calendar-check','calendar-days','calendar-minus','calendar-plus','calendar-xmark','camera','camera-retro','car','car-side','cart-arrow-down','cart-plus','cart-shopping','cash-register','certificate','chart-bar','chart-line','chart-pie','check','check-circle','check-double','check-square','chess','chevron-down','chevron-left','chevron-right','chevron-up','child','church','circle','circle-check','circle-dot','circle-info','circle-minus','circle-plus','circle-question','circle-user','circle-xmark','city','clipboard','clipboard-check','clipboard-list','clock','clone','cloud','cloud-arrow-down','cloud-arrow-up','cloud-bolt','cloud-moon','cloud-rain','cloud-sun','code','code-branch','coffee','cog','cogs','coins','columns','comment','comment-alt','comment-dots','comments','compact-disc','compass','compress','computer','copy','copyright','couch','credit-card','crop','cross','crosshairs','crown','cube','cubes','cut','database','desktop','diamond','dice','divide','dna','dollar-sign','dolly','donate','door-closed','door-open','download','dragon','droplet','drum','dumbbell','dungeon','edit','egg','eject','ellipsis','ellipsis-vertical','envelope','envelope-open','equals','eraser','ethernet','euro-sign','exclamation','exclamation-circle','exclamation-triangle','expand','external-link-alt','eye','eye-dropper','eye-slash','face-angry','face-dizzy','face-flushed','face-frown','face-grimace','face-grin','face-grin-beam','face-grin-hearts','face-grin-squint','face-grin-stars','face-grin-tears','face-grin-wide','face-kiss','face-kiss-beam','face-kiss-wink-heart','face-laugh','face-laugh-beam','face-laugh-squint','face-laugh-wink','face-meh','face-meh-blank','face-rolling-eyes','face-sad-cry','face-sad-tear','face-smile','face-smile-beam','face-smile-wink','face-surprise','face-tired','fan','faucet','fax','feather','female','file','file-alt','file-archive','file-audio','file-code','file-excel','file-export','file-image','file-import','file-invoice','file-invoice-dollar','file-lines','file-medical','file-pdf','file-powerpoint','file-signature','file-video','file-word','file-zipper','fill','fill-drip','film','filter','fingerprint','fire','fire-extinguisher','fire-flame-curved','first-aid','fish','flag','flag-checkered','flask','floppy-disk','folder','folder-minus','folder-open','folder-plus','font','football','forward','frog','futbol','gamepad','gas-pump','gavel','gear','gears','gem','gift','gifts','glass-martini','glass-water','glasses','globe','golf-ball-tee','graduation-cap','grip','grip-lines','grip-vertical','guitar','gun','hamburger','hammer','hand','hand-back-fist','hand-fist','hand-holding','hand-holding-dollar','hand-holding-heart','hand-lizard','hand-peace','hand-point-down','hand-point-left','hand-point-right','hand-point-up','hand-pointer','hand-rock','hand-scissors','hand-sparkles','hand-spock','hands','hands-clapping','hands-holding','hands-praying','handshake','handshake-angle','handshake-simple','hard-drive','hashtag','hat-wizard','heading','headphones','headset','heart','heart-pulse','helicopter','highlighter','hippo','history','hockey-puck','home','horse','hospital','hot-tub','hotel','hourglass','hourglass-half','house','house-user','ice-cream','id-badge','id-card','image','images','inbox','indent','industry','infinity','info','info-circle','italic','jar','jet-fighter','joint','key','keyboard','kiwi-bird','landmark','language','laptop','laptop-code','layer-group','leaf','lemon','life-ring','lightbulb','link','list','list-check','list-ol','list-ul','location-arrow','location-crosshairs','location-dot','location-pin','lock','lock-open','lungs','magic','magnet','magnifying-glass','male','map','map-location','map-location-dot','map-marker','map-marker-alt','map-pin','marker','mars','mask','medal','medkit','memory','menu','meteor','microchip','microphone','microphone-slash','microscope','minus','mobile','mobile-alt','mobile-screen','money-bill','money-bill-wave','money-check','monument','moon','mortar-pestle','mosque','motorcycle','mountain','mouse','mouse-pointer','mug-hot','mug-saucer','music','network-wired','newspaper','note-sticky','object-group','object-ungroup','oil-can','om','otter','outdent','pager','paint-brush','paint-roller','paintbrush','palette','pallet','paper-plane','paperclip','paragraph','parking','passport','paste','pause','pause-circle','paw','peace','pen','pen-clip','pen-fancy','pen-nib','pen-ruler','pen-to-square','pencil','pencil-alt','people-arrows','people-carry','people-group','pepper-hot','percent','person','person-biking','person-booth','person-hiking','person-running','person-skating','person-skiing','person-snowboarding','person-swimming','person-walking','phone','phone-alt','phone-slash','phone-volume','piggy-bank','pills','pizza-slice','plane','plane-arrival','plane-departure','play','play-circle','plug','plus','plus-circle','plus-square','podcast','poll','poo','portrait','pound-sign','power-off','pray','prescription','prescription-bottle','print','project-diagram','pump-soap','puzzle-piece','qrcode','question','question-circle','quote-left','quote-right','radiation','rainbow','random','receipt','record-vinyl','recycle','redo','registered','reply','reply-all','retweet','ribbon','ring','road','robot','rocket','route','rss','ruler','ruler-combined','ruler-horizontal','ruler-vertical','rupee-sign','satellite','satellite-dish','save','scale-balanced','school','scissors','screwdriver','screwdriver-wrench','scroll','sd-card','search','search-minus','search-plus','seedling','server','shapes','share','share-alt','share-nodes','share-square','shield','shield-alt','shield-halved','ship','shipping-fast','shirt','shoe-prints','shop','shopping-bag','shopping-basket','shopping-cart','shower','shuttle-space','sign','sign-hanging','signal','signature','sim-card','sitemap','skull','skull-crossbones','slash','sliders','sliders-h','smile','smile-beam','smile-wink','smog','smoking','smoking-ban','sms','snowflake','snowman','soap','socks','solar-panel','sort','sort-alpha-down','sort-alpha-up','sort-amount-down','sort-amount-up','sort-down','sort-numeric-down','sort-numeric-up','sort-up','spa','spell-check','spider','spinner','splotch','spray-can','square','square-check','square-full','square-minus','square-plus','stamp','star','star-half','star-half-alt','star-of-david','star-of-life','stethoscope','sticky-note','stop','stop-circle','stopwatch','store','store-alt','stream','street-view','strikethrough','subscript','subway','suitcase','suitcase-rolling','sun','superscript','swatchbook','sync','sync-alt','syringe','table','table-cells','table-tennis-paddle-ball','tablet','tablet-alt','tablet-screen','tablets','tag','tags','tape','tasks','taxi','teeth','teeth-open','temperature-full','temperature-half','temperature-high','temperature-low','terminal','text-height','text-width','theater-masks','thermometer','thermometer-half','thumbs-down','thumbs-up','thumbtack','ticket','ticket-alt','times','times-circle','tint','toggle-off','toggle-on','toilet','toilet-paper','toolbox','tools','tooth','torah','tower-broadcast','tractor','trademark','traffic-light','trailer','train','train-subway','tram','transgender','trash','trash-alt','trash-can','tree','trophy','truck','truck-fast','truck-loading','truck-monster','truck-moving','truck-pickup','tshirt','tty','tv','umbrella','umbrella-beach','underline','undo','universal-access','university','unlink','unlock','unlock-alt','upload','usb','user','user-alt','user-check','user-circle','user-clock','user-cog','user-edit','user-friends','user-gear','user-graduate','user-group','user-injured','user-lock','user-md','user-minus','user-ninja','user-nurse','user-pen','user-plus','user-secret','user-shield','user-slash','user-tag','user-tie','user-times','user-xmark','users','users-cog','users-gear','utensil-spoon','utensils','vault','vector-square','venus','venus-double','venus-mars','vest','vest-patches','vial','vials','video','video-slash','virus','virus-slash','viruses','voicemail','volleyball','volume-down','volume-high','volume-low','volume-mute','volume-off','volume-up','volume-xmark','vote-yea','vr-cardboard','wallet','wand-magic','wand-magic-sparkles','warehouse','water','wave-square','weight','weight-hanging','weight-scale','wheelchair','wifi','wind','window-close','window-maximize','window-minimize','window-restore','wine-bottle','wine-glass','wine-glass-alt','won-sign','wrench','x-ray','yen-sign','yin-yang','tree','cannabis','bottle-droplet','gem'];

            const regularIcons = ['address-book','address-card','bell','bell-slash','bookmark','building','calendar','calendar-check','calendar-days','calendar-minus','calendar-plus','calendar-xmark','chart-bar','circle','circle-check','circle-dot','circle-down','circle-left','circle-pause','circle-play','circle-question','circle-right','circle-stop','circle-up','circle-user','circle-xmark','clipboard','clock','clone','closed-captioning','comment','comment-dots','comments','compass','copy','copyright','credit-card','envelope','envelope-open','eye','eye-slash','face-angry','face-dizzy','face-flushed','face-frown','face-frown-open','face-grimace','face-grin','face-grin-beam','face-grin-hearts','face-grin-squint','face-grin-squint-tears','face-grin-stars','face-grin-tears','face-grin-tongue','face-grin-tongue-squint','face-grin-tongue-wink','face-grin-wide','face-grin-wink','face-kiss','face-kiss-beam','face-kiss-wink-heart','face-laugh','face-laugh-beam','face-laugh-squint','face-laugh-wink','face-meh','face-meh-blank','face-rolling-eyes','face-sad-cry','face-sad-tear','face-smile','face-smile-beam','face-smile-wink','face-surprise','face-tired','file','file-audio','file-code','file-excel','file-image','file-lines','file-pdf','file-powerpoint','file-video','file-word','file-zipper','flag','floppy-disk','folder','folder-closed','folder-open','font-awesome','futbol','gem','hand','hand-back-fist','hand-lizard','hand-peace','hand-point-down','hand-point-left','hand-point-right','hand-point-up','hand-pointer','hand-scissors','hand-spock','handshake','hard-drive','heart','hospital','hourglass','hourglass-half','id-badge','id-card','image','images','keyboard','lemon','life-ring','lightbulb','map','message','money-bill-1','moon','newspaper','note-sticky','object-group','object-ungroup','paper-plane','paste','pen-to-square','rectangle-list','rectangle-xmark','registered','share-from-square','snowflake','square','square-caret-down','square-caret-left','square-caret-right','square-caret-up','square-check','square-full','square-minus','square-plus','star','star-half','star-half-stroke','sun','thumbs-down','thumbs-up','trash-can','user','window-maximize','window-minimize','window-restore'];

            const brandIcons = ['accessible-icon','accusoft','adn','adversal','affiliatetheme','airbnb','algolia','alipay','amazon','amazon-pay','amilia','android','angellist','angrycreative','angular','app-store','app-store-ios','apper','apple','apple-pay','artstation','asymmetrik','atlassian','audible','autoprefixer','avianex','aviato','aws','bandcamp','battle-net','behance','bilibili','bimobject','bitbucket','bitcoin','bity','black-tie','blackberry','blogger','blogger-b','bluetooth','bluetooth-b','bootstrap','bots','btc','buffer','buromobelexperte','buy-n-large','buysellads','canadian-maple-leaf','cc-amazon-pay','cc-amex','cc-apple-pay','cc-diners-club','cc-discover','cc-jcb','cc-mastercard','cc-paypal','cc-stripe','cc-visa','centercode','centos','chrome','chromecast','cloudflare','cloudscale','cloudsmith','cloudversify','cmplid','codepen','codiepie','confluence','connectdevelop','contao','cotton-bureau','cpanel','creative-commons','critical-role','css3','css3-alt','cuttlefish','d-and-d','d-and-d-beyond','dailymotion','dashcube','deezer','delicious','deploydog','deskpro','dev','deviantart','dhl','diaspora','digg','digital-ocean','discord','discourse','dochub','docker','draft2digital','dribbble','dropbox','drupal','dyalog','earlybirds','ebay','edge','edge-legacy','elementor','ello','ember','empire','envira','erlang','ethereum','etsy','evernote','expeditedssl','facebook','facebook-f','facebook-messenger','fantasy-flight-games','fedex','fedora','figma','firefox','firefox-browser','first-order','first-order-alt','firstdraft','flickr','flipboard','fly','font-awesome','fonticons','fonticons-fi','fort-awesome','fort-awesome-alt','forumbee','foursquare','free-code-camp','freebsd','fulcrum','galactic-republic','galactic-senate','get-pocket','gg','gg-circle','git','git-alt','github','github-alt','gitkraken','gitlab','gitter','glide','glide-g','gofore','golang','goodreads','goodreads-g','google','google-drive','google-pay','google-play','google-plus','google-plus-g','google-scholar','google-wallet','gratipay','grav','gripfire','grunt','guilded','gulp','hacker-news','hackerrank','hashnode','hips','hire-a-helper','hive','hooli','hornbill','hotjar','houzz','html5','hubspot','ideal','imdb','instagram','instalod','intercom','internet-explorer','invision','ioxhost','itch-io','itunes','itunes-note','java','jedi-order','jenkins','jira','joget','joomla','js','js-square','jsfiddle','kaggle','keybase','keycdn','kickstarter','kickstarter-k','korvue','laravel','lastfm','leanpub','less','line','linkedin','linkedin-in','linode','linux','lyft','magento','mailchimp','mandalorian','markdown','mastodon','maxcdn','mdb','medapps','medium','medrt','meetup','megaport','mendeley','meta','microblog','microsoft','mix','mixcloud','mixer','mizuni','modx','monero','napster','neos','nfc-directional','nfc-symbol','nimblr','node','node-js','npm','ns8','nutritionix','octopus-deploy','odnoklassniki','old-republic','opencart','openid','opera','optin-monster','orcid','osi','padlet','page4','pagelines','palfed','patreon','paypal','perbyte','periscope','phabricator','phoenix-framework','phoenix-squadron','php','pied-piper','pied-piper-alt','pied-piper-hat','pied-piper-pp','pinterest','pinterest-p','pix','playstation','product-hunt','pushed','python','qq','quinscape','quora','r-project','raspberry-pi','ravelry','react','reacteurope','readme','rebel','red-river','reddit','reddit-alien','redhat','renren','replyd','researchgate','resolving','rev','rocketchat','rockrms','rust','safari','salesforce','sass','schlix','screenpal','scribd','searchengin','sellcast','sellsy','servicestack','shirtsinbulk','shopify','shopware','simplybuilt','sistrix','sith','sitrox','sketch','skyatlas','skype','slack','slideshare','snapchat','soundcloud','sourcetree','space-awesome','speakap','speaker-deck','spotify','square-behance','square-dribbble','square-facebook','square-font-awesome','square-git','square-github','square-gitlab','square-google-plus','square-hacker-news','square-instagram','square-js','square-lastfm','square-odnoklassniki','square-pied-piper','square-pinterest','square-reddit','square-snapchat','square-steam','square-tumblr','square-twitter','square-viadeo','square-vimeo','square-whatsapp','square-xing','square-youtube','squarespace','stack-exchange','stack-overflow','stackpath','staylinked','steam','steam-symbol','sticker-mule','strava','stripe','stripe-s','stubber','studiovinari','stumbleupon','stumbleupon-circle','superpowers','supple','suse','swift','symfony','teamspeak','telegram','tencent-weibo','the-red-yeti','themeco','themeisle','think-peaks','tiktok','trade-federation','trello','tumblr','twitch','twitter','typo3','uber','ubuntu','uikit','umbraco','uncharted','uniregistry','unity','unsplash','untappd','ups','usb','usps','ussunnah','vaadin','viacoin','viadeo','viber','vimeo','vimeo-v','vine','vk','vnv','vuejs','watchman-monitoring','waze','weebly','weibo','weixin','whatsapp','whmcs','wikipedia-w','windows','wirsindhandwerk','wix','wizards-of-the-coast','wodu','wolf-pack-battalion','wordpress','wordpress-simple','wpbeginner','wpexplorer','wpforms','wpressr','xbox','xing','x-twitter','y-combinator','yahoo','yammer','yandex','yandex-international','yarn','yelp','yoast','youtube','zhihu','threads','meta'];

            this.allIcons = [];

            solidIcons.forEach(name => {
                this.allIcons.push({ name: name, class: 'fas fa-' + name, category: 'solid' });
            });

            regularIcons.forEach(name => {
                this.allIcons.push({ name: name, class: 'far fa-' + name, category: 'regular' });
            });

            brandIcons.forEach(name => {
                this.allIcons.push({ name: name, class: 'fab fa-' + name, category: 'brands' });
            });

            this.categories[0].count = this.allIcons.length;
            this.categories[1].count = solidIcons.length;
            this.categories[2].count = regularIcons.length;
            this.categories[3].count = brandIcons.length;
        },

        filterIcons() {
            let filtered = this.allIcons;

            if (this.activeCategory !== 'all') {
                filtered = filtered.filter(icon => icon.category === this.activeCategory);
            }

            if (this.searchQuery.trim()) {
                const query = this.searchQuery.toLowerCase().trim();
                filtered = filtered.filter(icon => icon.name.toLowerCase().includes(query));
            }

            this.filteredIcons = filtered;
            this.currentPage = 0;
            this.loadMoreIcons(true);
        },

        loadMoreIcons(reset = false) {
            if (reset) {
                this.displayedIcons = [];
                this.currentPage = 0;
            }

            const start = this.currentPage * this.perPage;
            const end = start + this.perPage;
            const newIcons = this.filteredIcons.slice(start, end);

            this.displayedIcons = reset ? newIcons : [...this.displayedIcons, ...newIcons];
            this.hasMore = end < this.filteredIcons.length;
            this.currentPage++;
        },

        handleScroll() {
            const container = this.$refs.iconsContainer;
            if (container) {
                const scrollBottom = container.scrollHeight - container.scrollTop - container.clientHeight;
                if (scrollBottom < 100 && this.hasMore) {
                    this.loadMoreIcons();
                }
            }
        },

        selectCategory(category) {
            this.activeCategory = category;
            this.filterIcons();
        },

        selectIcon(iconClass) {
            this.tempSelection = iconClass;
        },

        confirmSelection() {
            if (this.tempSelection) {
                this.selectedIcon = this.tempSelection;
                this.closeModal();
            }
        },

        clearIcon() {
            this.selectedIcon = '';
            this.tempSelection = '';
        },

        openModal() {
            this.tempSelection = this.selectedIcon;
            this.isOpen = true;
            this.searchQuery = '';
            this.activeCategory = 'all';
            this.filterIcons();
            document.body.style.overflow = 'hidden';
        },

        closeModal() {
            this.isOpen = false;
            this.tempSelection = '';
            document.body.style.overflow = '';
        }
    }));
});
</script>
@endpush
@endonce
