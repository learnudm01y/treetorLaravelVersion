@extends('layouts.admin')

@section('title', 'Create Service')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.services.index') }}"
               class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Create Service</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new service to your website</p>
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
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-12 gap-6">
            {{-- Main Content --}}
            <div class="col-span-12 xl:col-span-8">
                {{-- Basic Info --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Basic Information</h3>

                    {{-- Title --}}
                    <div class="mb-6">
                        <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Enter service title"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                               required>
                    </div>

                    {{-- Subtitle --}}
                    <div class="mb-6">
                        <label for="subtitle" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Subtitle
                        </label>
                        <input type="text"
                               id="subtitle"
                               name="subtitle"
                               value="{{ old('subtitle') }}"
                               placeholder="Short description displayed below the title"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        {{-- Badge --}}
                        <div>
                            <label for="badge" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Badge
                            </label>
                            <input type="text"
                                   id="badge"
                                   name="badge"
                                   value="{{ old('badge') }}"
                                   placeholder="e.g. Premium, New, Popular"
                                   class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        </div>

                        {{-- Icon --}}
                        @include('admin.components.icon-picker', [
                            'name' => 'icon',
                            'value' => old('icon', ''),
                            'label' => 'Service Icon',
                            'id' => 'service-icon'
                        ])
                    </div>

                    {{-- Overview --}}
                    <div class="mb-6">
                        <label for="overview" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Overview
                        </label>
                        <textarea id="overview"
                                  name="overview"
                                  rows="4"
                                  placeholder="Brief overview of the service..."
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('overview') }}</textarea>
                    </div>

                    {{-- Content --}}
                    <div>
                        <label for="content" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Full Description
                        </label>
                        <textarea id="content"
                                  name="content"
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">{{ old('content') }}</textarea>
                    </div>
                </div>

                {{-- Dynamic Sections --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900" style="margin-top: 26px;"
                     x-data="{
                         sections: {{ json_encode(old('sections', [])) }},
                         addSection() {
                             this.sections.push({
                                 title: '',
                                 icon: 'fas fa-layer-group',
                                 type: 'list',
                                 items: [],
                                 content: '',
                                 sort_order: this.sections.length,
                                 is_active: true
                             });
                         },
                         removeSection(index) {
                             const self = this;
                             Swal.fire({
                                 title: 'Delete Section?',
                                 text: 'Are you sure you want to delete this entire section?',
                                 icon: 'warning',
                                 showCancelButton: true,
                                 confirmButtonColor: '#dc2626',
                                 cancelButtonColor: '#6b7280',
                                 confirmButtonText: 'Yes, Delete',
                                 cancelButtonText: 'Cancel'
                             }).then((result) => {
                                 if (result.isConfirmed) {
                                     self.sections.splice(index, 1);
                                 }
                             });
                         },
                         addSectionItem(sectionIndex) {
                             if (!this.sections[sectionIndex].items) {
                                 this.sections[sectionIndex].items = [];
                             }
                             if (this.sections[sectionIndex].type === 'text') {
                                 this.sections[sectionIndex].items.push({ icon: 'fas fa-clipboard-list', title: '', subtitle: '', content: '' });
                             } else {
                                 this.sections[sectionIndex].items.push({ icon: 'fas fa-check', title: '', description: '' });
                             }
                         },
                         removeSectionItem(sectionIndex, itemIndex) {
                             this.sections[sectionIndex].items.splice(itemIndex, 1);
                         },
                         openIconPickerForSection(sectionIndex) {
                             const self = this;
                             window.openIconPicker(this.sections[sectionIndex].icon, function(icon) {
                                 self.sections[sectionIndex].icon = icon;
                             });
                         },
                         openIconPickerForItem(sectionIndex, itemIndex) {
                             const self = this;
                             window.openIconPicker(this.sections[sectionIndex].items[itemIndex].icon, function(icon) {
                                 self.sections[sectionIndex].items[itemIndex].icon = icon;
                             });
                         },
                         moveSectionUp(index) {
                             if (index > 0) {
                                 [this.sections[index], this.sections[index - 1]] = [this.sections[index - 1], this.sections[index]];
                             }
                         },
                         moveSectionDown(index) {
                             if (index < this.sections.length - 1) {
                                 [this.sections[index], this.sections[index + 1]] = [this.sections[index + 1], this.sections[index]];
                             }
                         }
                     }">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white/90">Dynamic Sections</h3>
                            <p class="text-xs text-gray-500 mt-1">Add unlimited custom sections to display additional information</p>
                        </div>
                        <button type="button" @click="addSection()"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Add New Section
                        </button>
                    </div>

                    <template x-for="(section, sectionIndex) in sections" :key="sectionIndex">
                        <div class="mb-6 p-6 border-2 border-brand-200 rounded-xl dark:border-brand-800 bg-brand-50/30 dark:bg-brand-900/10">
                            {{-- Section Header --}}
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col gap-1">
                                        <button type="button" @click="moveSectionUp(sectionIndex)"
                                                :disabled="sectionIndex === 0"
                                                class="p-1 text-gray-400 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="m18 15-6-6-6 6"/>
                                            </svg>
                                        </button>
                                        <button type="button" @click="moveSectionDown(sectionIndex)"
                                                :disabled="sectionIndex === sections.length - 1"
                                                class="p-1 text-gray-400 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="m6 9 6 6 6-6"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="text-lg font-semibold text-brand-600 dark:text-brand-400" x-text="'Section ' + (sectionIndex + 1)"></span>
                                </div>
                                <button type="button" @click="removeSection(sectionIndex)"
                                        class="px-3 py-1.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">
                                    <svg class="w-4 h-4 inline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 6L6 18M6 6l12 12"/>
                                    </svg>
                                    Delete Section
                                </button>
                            </div>

                            {{-- Section Basic Info --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                {{-- Section Title --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Section Title *</label>
                                    <input type="text"
                                           :name="'sections[' + sectionIndex + '][title]'"
                                           x-model="section.title"
                                           placeholder="e.g., Work Process"
                                           class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white/90">
                                </div>

                                {{-- Section Icon --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Section Icon</label>
                                    <input type="hidden" :name="'sections[' + sectionIndex + '][icon]'" x-model="section.icon">
                                    <button type="button"
                                            @click="openIconPickerForSection(sectionIndex)"
                                            class="w-full flex items-center gap-3 rounded-lg border border-gray-200 bg-white px-3 py-2 text-left text-gray-800 hover:border-brand-300 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white/90">
                                        <div class="w-9 h-9 rounded-lg bg-brand-500/10 flex items-center justify-center flex-shrink-0">
                                            <i :class="section.icon" class="text-lg text-brand-500"></i>
                                        </div>
                                        <span x-text="section.icon" class="text-xs font-mono text-gray-500 truncate"></span>
                                    </button>
                                </div>
                            </div>

                            {{-- Section Type --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Type</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="relative flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer"
                                           :class="section.type === 'list' ? 'border-brand-500 bg-brand-50 dark:bg-brand-900/20' : 'border-gray-200 dark:border-gray-700'">
                                        <input type="radio" :name="'sections[' + sectionIndex + '][type]'" value="list"
                                               x-model="section.type" class="text-brand-500 focus:ring-brand-500">
                                        <div>
                                            <div class="font-medium text-sm">List</div>
                                            <div class="text-xs text-gray-500">Sequential items</div>
                                        </div>
                                    </label>
                                    <label class="relative flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer"
                                           :class="section.type === 'grid' ? 'border-brand-500 bg-brand-50 dark:bg-brand-900/20' : 'border-gray-200 dark:border-gray-700'">
                                        <input type="radio" :name="'sections[' + sectionIndex + '][type]'" value="grid"
                                               x-model="section.type" class="text-brand-500 focus:ring-brand-500">
                                        <div>
                                            <div class="font-medium text-sm">Grid</div>
                                            <div class="text-xs text-gray-500">Card display</div>
                                        </div>
                                    </label>
                                    <label class="relative flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer"
                                           :class="section.type === 'text' ? 'border-brand-500 bg-brand-50 dark:bg-brand-900/20' : 'border-gray-200 dark:border-gray-700'">
                                        <input type="radio" :name="'sections[' + sectionIndex + '][type]'" value="text"
                                               x-model="section.type" class="text-brand-500 focus:ring-brand-500">
                                        <div>
                                            <div class="font-medium text-sm">Text</div>
                                            <div class="text-xs text-gray-500">Text content</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Section Content (for list/grid type) --}}
                            <div x-show="section.type !== 'text'" class="mb-4">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Section Items</label>
                                    <button type="button" @click="addSectionItem(sectionIndex)"
                                            class="inline-flex items-center gap-1 text-xs text-brand-500 hover:text-brand-600">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add Item
                                    </button>
                                </div>

                                <template x-for="(item, itemIndex) in section.items" :key="itemIndex">
                                    <div class="mb-3 p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs text-gray-500" x-text="'Item ' + (itemIndex + 1)"></span>
                                            <button type="button" @click="removeSectionItem(sectionIndex, itemIndex)"
                                                    class="text-red-500 hover:text-red-600 p-1">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M18 6L6 18M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            {{-- Item Icon --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Icon</label>
                                                <input type="hidden" :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][icon]'" x-model="item.icon">
                                                <button type="button"
                                                        @click="openIconPickerForItem(sectionIndex, itemIndex)"
                                                        class="w-full flex items-center gap-2 rounded border border-gray-200 bg-white px-2.5 py-2 text-left hover:border-brand-300 dark:border-gray-700 dark:bg-gray-800">
                                                    <div class="w-7 h-7 rounded bg-brand-50 dark:bg-brand-900/20 flex items-center justify-center flex-shrink-0">
                                                        <i :class="item.icon" class="text-sm text-brand-500"></i>
                                                    </div>
                                                    <span x-text="item.icon" class="text-xs font-mono text-gray-500 truncate"></span>
                                                </button>
                                            </div>
                                            {{-- Item Title --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Title</label>
                                                <input type="text"
                                                       :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][title]'"
                                                       x-model="item.title"
                                                       placeholder="Item title"
                                                       class="w-full rounded border border-gray-200 bg-white px-2.5 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                            </div>
                                            {{-- Item Description --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Description</label>
                                                <input type="text"
                                                       :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][description]'"
                                                       x-model="item.description"
                                                       placeholder="Item description"
                                                       class="w-full rounded border border-gray-200 bg-white px-2.5 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="!section.items || section.items.length === 0" class="p-4 text-center text-sm text-gray-400 border border-dashed border-gray-300 rounded-lg dark:border-gray-700">
                                    No items yet. Click "Add Item" to add new items
                                </div>
                            </div>

                            {{-- Section Content (for text type) --}}
                            <div x-show="section.type === 'text'" class="mb-4">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Text Items</label>
                                    <button type="button" @click="addSectionItem(sectionIndex)"
                                            class="inline-flex items-center gap-1 text-xs text-brand-500 hover:text-brand-600">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add Text Item
                                    </button>
                                </div>

                                <template x-for="(item, itemIndex) in section.items" :key="'text-' + itemIndex">
                                    <div class="mb-3 p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-medium text-brand-600 dark:text-brand-400" x-text="'Text Item ' + (itemIndex + 1)"></span>
                                            <button type="button" @click="removeSectionItem(sectionIndex, itemIndex)"
                                                    class="text-red-500 hover:text-red-600 p-1">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M18 6L6 18M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            {{-- Item Icon --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Icon</label>
                                                <input type="hidden" :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][icon]'" x-model="item.icon">
                                                <button type="button"
                                                        @click="openIconPickerForItem(sectionIndex, itemIndex)"
                                                        class="w-full flex items-center gap-2 rounded border border-gray-200 bg-white px-2.5 py-2 text-left hover:border-brand-300 dark:border-gray-700 dark:bg-gray-800">
                                                    <div class="w-7 h-7 rounded bg-brand-50 dark:bg-brand-900/20 flex items-center justify-center flex-shrink-0">
                                                        <i :class="item.icon" class="text-sm text-brand-500"></i>
                                                    </div>
                                                    <span x-text="item.icon" class="text-xs font-mono text-gray-500 truncate"></span>
                                                </button>
                                            </div>
                                            {{-- Item Title --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Title <span class="text-gray-400 font-normal">(numbered automatically when displayed)</span></label>
                                                <input type="text"
                                                       :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][title]'"
                                                       x-model="item.title"
                                                       placeholder="e.g., Inventory Management SOPs"
                                                       class="w-full rounded border border-gray-200 bg-white px-2.5 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                            </div>
                                            {{-- Item Subtitle --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Subtitle <span class="text-gray-400 font-normal">(shown below title)</span></label>
                                                <input type="text"
                                                       :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][subtitle]'"
                                                       x-model="item.subtitle"
                                                       placeholder="e.g., Clear procedures that control how products are..."
                                                       class="w-full rounded border border-gray-200 bg-white px-2.5 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                            </div>
                                            {{-- Item Content --}}
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Content <span class="text-gray-400 font-normal">(multi-line, line breaks preserved)</span></label>
                                                <textarea :name="'sections[' + sectionIndex + '][items][' + itemIndex + '][content]'"
                                                          x-model="item.content"
                                                          rows="4"
                                                          placeholder="Enter text content (each line break will be preserved)..."
                                                          class="w-full rounded border border-gray-200 bg-white px-2.5 py-3 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white resize-y"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="!section.items || section.items.length === 0" class="p-4 text-center text-sm text-gray-400 border border-dashed border-gray-300 rounded-lg dark:border-gray-700">
                                    No text items yet. Click "Add Text Item" to add new items.
                                </div>
                            </div>

                            {{-- Hidden fields --}}
                            <input type="hidden" :name="'sections[' + sectionIndex + '][sort_order]'" :value="sectionIndex">
                            <input type="hidden" :name="'sections[' + sectionIndex + '][is_active]'" value="1">
                        </div>
                    </template>

                    <div x-show="sections.length === 0" class="p-8 text-center border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-700">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                        </svg>
                        <p class="text-gray-500 mb-3">No custom sections added yet</p>
                        <button type="button" @click="addSection()"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand-600 hover:text-brand-700">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Add New Section
                        </button>
                    </div>
                </div>

                {{-- Quick Features Section --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900" style="margin-top: 26px;"
                     x-data="{
                         quickFeatures: {{ json_encode(old('quick_features', [])) }},
                         addQuickFeature() {
                             this.quickFeatures.push({ text: '' });
                         },
                         removeQuickFeature(index) {
                             const self = this;
                             Swal.fire({
                                 title: 'Remove Quick Feature?',
                                 text: 'Are you sure you want to remove this quick feature?',
                                 icon: 'warning',
                                 showCancelButton: true,
                                 confirmButtonColor: '#dc2626',
                                 cancelButtonColor: '#6b7280',
                                 confirmButtonText: 'Yes, Remove',
                                 cancelButtonText: 'Cancel'
                             }).then((result) => {
                                 if (result.isConfirmed) {
                                     self.quickFeatures.splice(index, 1);
                                 }
                             });
                         }
                     }">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white/90">Quick Features</h3>
                        <button type="button" @click="addQuickFeature()"
                                class="inline-flex items-center gap-1 text-sm text-brand-500 hover:text-brand-600">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Add Quick Feature
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">These appear in the booking card sidebar on the service page.</p>

                    <template x-for="(qf, index) in quickFeatures" :key="index">
                        <div class="mb-3 flex items-center gap-2">
                            <div class="flex-1">
                                <input type="text" :name="'quick_features[' + index + '][text]'" x-model="qf.text" placeholder="e.g., Professional Service" class="w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                            </div>
                            <button type="button" @click="removeQuickFeature(index)"
                                    class="text-red-500 hover:text-red-600 p-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-span-12 xl:col-span-4">
                {{-- Pricing --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Pricing</h3>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Price Type
                        </label>
                        <div x-data="{ open: false, selected: '{{ old('price_type', 'contact') }}' }" class="relative">
                            <button type="button"
                                    @click="open = !open"
                                    @click.away="open = false"
                                    class="flex items-center justify-between gap-2 w-full rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-gray-800 hover:bg-gray-50 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:bg-gray-800">
                                <span x-text="selected === 'fixed' ? 'Fixed Price' : selected === 'from' ? 'Starting From' : selected === 'custom' ? 'Custom Pricing' : 'Contact for Price'"></span>
                                <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                            <input type="hidden" name="price_type" :value="selected">

                            <div x-show="open" x-transition class="absolute left-0 z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-800 dark:bg-gray-900">
                                <button type="button" @click="selected = 'fixed'; open = false" class="flex w-full items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Fixed Price</button>
                                <button type="button" @click="selected = 'from'; open = false" class="flex w-full items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Starting From</button>
                                <button type="button" @click="selected = 'custom'; open = false" class="flex w-full items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Custom Pricing</button>
                                <button type="button" @click="selected = 'contact'; open = false" class="flex w-full items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Contact for Price</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Price
                        </label>
                        <input type="number"
                               id="price"
                               name="price"
                               step="0.01"
                               value="{{ old('price') }}"
                               placeholder="0.00"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                    </div>

                    <div>
                        <label for="price_note" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Price Note
                        </label>
                        <input type="text"
                               id="price_note"
                               name="price_note"
                               value="{{ old('price_note') }}"
                               placeholder="e.g. Tailored to your needs"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                    </div>
                </div>

                {{-- Contact & CTA --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Contact & CTA</h3>

                    <div class="mb-4">
                        <label for="whatsapp_number" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            WhatsApp Number
                        </label>
                        <input type="text"
                               id="whatsapp_number"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number') }}"
                               placeholder="e.g. 971586658664"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                        <p class="mt-1 text-xs text-gray-500">Without + or spaces</p>
                    </div>

                    <div>
                        <label for="cta_text" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Button Text
                        </label>
                        <input type="text"
                               id="cta_text"
                               name="cta_text"
                               value="{{ old('cta_text', 'Book Consultation') }}"
                               placeholder="e.g. Book Now, Get Started"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Featured Image</h3>

                    <div x-data="{ imagePreview: null }">
                        <div class="mb-4">
                            <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-brand-300 dark:border-gray-700 dark:hover:border-brand-600 transition-colors"
                                   :class="{ 'border-brand-500': imagePreview }">
                                <template x-if="!imagePreview">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 text-gray-400 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Click to upload image</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </template>
                                <template x-if="imagePreview">
                                    <img :src="imagePreview" class="w-full h-full object-cover rounded-xl">
                                </template>
                                <input type="file"
                                       name="featured_image"
                                       class="hidden"
                                       accept="image/*"
                                       @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = e => imagePreview = e.target.result; reader.readAsDataURL(file); }">
                            </label>
                        </div>
                    </div>
                </div>

                {{-- SEO --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">SEO</h3>

                    <div>
                        <label for="meta_description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Meta Description
                        </label>
                        <textarea id="meta_description"
                                  name="meta_description"
                                  rows="3"
                                  placeholder="Brief description for search engines..."
                                  class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">{{ old('meta_description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                    </div>
                </div>

                {{-- Publish Options - LAST ELEMENT --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Publish</h3>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>
                        <div x-data="{ open: false, selected: '{{ old('status', 'draft') }}' }" class="relative">
                            <button type="button"
                                    @click="open = !open"
                                    @click.away="open = false"
                                    class="flex items-center justify-between gap-2 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:bg-gray-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full" :class="selected === 'draft' ? 'bg-yellow-500' : selected === 'published' ? 'bg-green-500' : 'bg-gray-500'"></span>
                                    <span x-text="selected === 'draft' ? 'Draft' : selected === 'published' ? 'Published' : 'Archived'"></span>
                                </div>
                                <svg class="w-4 h-4 text-gray-500" :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                            <input type="hidden" name="status" :value="selected">
                            <div x-show="open" x-transition class="absolute left-0 z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-800 dark:bg-gray-900">
                                <button type="button" @click="selected = 'draft'; open = false" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Draft
                                </button>
                                <button type="button" @click="selected = 'published'; open = false" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span> Published
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="sort_order" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Sort Order
                        </label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-gray-800 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90">
                    </div>

                    <button type="submit"
                            class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable { min-height: 300px; }
    .ck-editor__editable ul, .ck-editor__editable ol { padding-left: 2em; margin-left: 1em; }
</style>
<script>
    ClassicEditor.create(document.querySelector('#content'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
        placeholder: 'Detailed description of the service...'
    }).catch(error => console.error(error));
</script>
@endpush
