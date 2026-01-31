<div id="searchModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:99999; justify-content:center; align-items:center;">
    <div style="background:white; padding:40px; border-radius:10px; max-width:600px; width:90%; position:relative;">
        <button id="closeSearch" style="position:absolute; top:15px; right:15px; background:none; border:none; font-size:30px; cursor:pointer; color:#0d5c47;">&times;</button>
        <h2 style="color:#0d5c47; margin-bottom:30px; text-align:center;">Search Our Website</h2>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="q" id="searchInput" placeholder="Search services, blog posts, or pages..."
                   style="width:100%; padding:15px; font-size:16px; border:2px solid #0d5c47; border-radius:5px; margin-bottom:20px;">
            <button type="submit" class="btn" style="width:100%; background:#0d5c47; color:white; padding:0; font-size:18px; border:none; cursor:pointer; border-radius:5px;">Search</button>
        </form>
        <div id="searchResults" style="margin-top:20px;"></div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.querySelector('#openSearchModal');
    const searchModal = document.getElementById('searchModal');
    const closeSearch = document.getElementById('closeSearch');
    const searchInput = document.getElementById('searchInput');

    if(searchIcon && searchModal) {
        searchIcon.addEventListener('click', function(e) {
            e.preventDefault();
            searchModal.style.display = 'flex';
            searchInput.focus();
        });

        closeSearch.addEventListener('click', function() {
            searchModal.style.display = 'none';
        });

        searchModal.addEventListener('click', function(e) {
            if(e.target === searchModal) {
                searchModal.style.display = 'none';
            }
        });

        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') {
                searchModal.style.display = 'none';
            }
        });
    }
});
</script>
@endpush
