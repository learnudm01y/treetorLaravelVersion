@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.articles.index') }}"
               class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Article</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update article information</p>
            </div>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M15 9l-6 6M9 9l6 6"/>
                </svg>
                <div>
                    <p class="font-medium text-red-700 dark:text-red-400">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-12 gap-6">
            {{-- Main Content --}}
            <div class="col-span-12">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">

                    {{-- Title and Cover Image - Same Row --}}
                    <div class="flex flex-col lg:flex-row gap-4 mb-6">
                        {{-- Title Field --}}
                        <div class="flex-1">
                            <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $article->title) }}"
                                   placeholder="Enter article title"
                                   class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('title') border-red-500 @enderror"
                                   required>
                        </div>

                        {{-- Cover Image - Compact --}}
                        <div class="lg:w-64" x-data="{ imagePreview: '{{ $article->featured_image ? Storage::url($article->featured_image) : '' }}', fileName: '{{ $article->featured_image ? basename($article->featured_image) : '' }}' }">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cover Image
                            </label>
                            <div class="flex items-center gap-3">
                                {{-- Image Preview --}}
                                <div class="w-20 h-20 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden flex-shrink-0 bg-gray-50 dark:bg-gray-800">
                                    <template x-if="imagePreview">
                                        <img :src="imagePreview" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!imagePreview">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                                {{-- Upload Button --}}
                                <label class="flex-1 cursor-pointer">
                                    <div class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <svg class="w-4 h-4 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                                        </svg>
                                        <span class="text-sm text-gray-600 dark:text-gray-400 truncate" x-text="fileName || 'Choose file'"></span>
                                    </div>
                                    <input type="file"
                                           name="featured_image"
                                           class="hidden"
                                           accept="image/*"
                                           @change="const file = $event.target.files[0]; if(file) { fileName = file.name; const reader = new FileReader(); reader.onload = e => imagePreview = e.target.result; reader.readAsDataURL(file); }">
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Excerpt --}}
                    <div class="mb-6">
                        <label for="excerpt" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Excerpt
                        </label>
                        <textarea id="excerpt"
                                  name="excerpt"
                                  rows="3"
                                  placeholder="Brief description of the article..."
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $article->excerpt) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">A short summary that appears in article listings.</p>
                    </div>

                    {{-- Content with CKEditor --}}
                    <div class="mb-6">
                        <label for="content" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea id="content"
                                  name="content"
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">{{ old('content', $article->content) }}</textarea>
                    </div>

                    {{-- Tags --}}
                    <div class="mb-6">
                        <label for="tags" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tags
                        </label>
                        <input type="text"
                               id="tags"
                               name="tags"
                               value="{{ old('tags', $article->tags) }}"
                               placeholder="e.g. Perfume, Make up, Spa (comma separated)"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate tags with commas.</p>
                    </div>

                    {{-- Meta Description --}}
                    <div>
                        <label for="meta_description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Meta Description (SEO)
                        </label>
                        <textarea id="meta_description"
                                  name="meta_description"
                                  rows="2"
                                  placeholder="Brief description for search engines..."
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('meta_description', $article->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters for SEO.</p>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-span-12 xl:col-span-4">
                {{-- Publish Options --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Publish</h3>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>
                        {{-- Custom Select for Status --}}
                        <div x-data="{ open: false, selected: '{{ old('status', $article->status) }}' }" class="relative">
                            <button type="button"
                                    @click="open = !open"
                                    @click.away="open = false"
                                    class="flex items-center justify-between gap-2 w-full rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-gray-800 hover:bg-gray-50 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:bg-gray-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full" :class="selected === 'draft' ? 'bg-yellow-500' : selected === 'published' ? 'bg-green-500' : 'bg-gray-500'"></span>
                                    <span x-text="selected === 'draft' ? 'Draft' : selected === 'published' ? 'Published' : 'Archived'"></span>
                                </div>
                                <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                            <input type="hidden" name="status" :value="selected">

                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute left-0 z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-800 dark:bg-gray-900">
                                <button type="button" @click="selected = 'draft'; open = false"
                                        class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                        :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'draft' }">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    Draft
                                </button>
                                <button type="button" @click="selected = 'published'; open = false"
                                        class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                        :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'published' }">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Published
                                </button>
                                <button type="button" @click="selected = 'archived'; open = false"
                                        class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                                        :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'archived' }">
                                    <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                    Archived
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Article Info --}}
                    <div class="mb-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex justify-between">
                            <span>Created:</span>
                            <span>{{ $article->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Updated:</span>
                            <span>{{ $article->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                        @if($article->published_at)
                        <div class="flex justify-between">
                            <span>Published:</span>
                            <span>{{ $article->published_at->format('M d, Y H:i') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span>Views:</span>
                            <span>{{ number_format($article->views) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 transition-all">
                        ✅ Update Article
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- Separate Delete Form --}}
    <form id="delete-form" action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    {{-- Danger Zone - Outside main form --}}
    <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/20">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-red-700 dark:text-red-400">⚠️ Danger Zone</h3>
                <p class="text-xs text-red-600 dark:text-red-400">This action cannot be undone.</p>
            </div>
            <button type="button"
                    onclick="confirmDelete()"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition-colors">
                🗑️ Delete
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<!-- CKEditor 5 (Free & Powerful) -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 350px;
    }
    .ck-editor__editable ul,
    .ck-editor__editable ol {
        padding-left: 2em;
        margin-left: 1em;
    }
    .ck-editor__editable blockquote {
        margin-left: 1em;
        padding-left: 1em;
        border-left: 4px solid #ccc;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
            placeholder: 'Write your article content here...'
        })
        .catch(error => {
            console.error(error);
        });

    // SweetAlert for Delete Confirmation
    function confirmDelete() {
        Swal.fire({
            title: '⚠️ Delete Article?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endpush
