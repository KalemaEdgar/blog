<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form action="/admin/posts" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">Title</label>

                    <input type="text" value="{{ old('title') }}" name="title" id="title" required class="border border-gray-400 p-2 w-full">

                    @error('title')
                        <span class="text-xs text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="slug" class="block mb-2 uppercase font-bold text-xs text-gray-700">Slug</label>

                    <input type="text" value="{{ old('slug') }}" name="slug" id="slug" required class="border border-gray-400 p-2 w-full">

                    @error('slug')
                        <span class="text-xs text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-700">Excerpt</label>

                    <textarea name="excerpt" id="excerpt" required class="border border-gray-400 p-2 w-full">{{ old('excerpt') }}</textarea>

                    @error('excerpt')
                        <span class="text-xs text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">Body</label>

                    <textarea name="body" id="body" required class="border border-gray-400 p-2 w-full">{{ old('body') }}</textarea>

                    @error('body')
                        <span class="text-xs text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">Category</label>

                    <select name="category_id" id="category_id">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : ''}}
                            >{{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <span class="text-xs text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>

            </form>
        </x-panel>
    </section>
</x-layout>