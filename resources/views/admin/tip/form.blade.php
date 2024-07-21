{{ csrf_field() }}
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('title') ? 'border-red-500' : '' }}" for="title"></label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title" value="{{ old('title', $tip->title) }}">
    @if ($errors->has('title'))
    <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
    @endif
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('slug') ? 'border-red-500' : '' }}" for="slug"></label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="slug" name="slug" type="text" placeholder="Slug" value="{{ old('slug', $tip->slug) }}">
    @if ($errors->has('slug'))
    <p class="text-red-500 text-xs italic">{{ $errors->first('slug') }}</p>
    @endif
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('body') ? 'border-red-500' : '' }}" for="name"></label>
    <textarea name="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="10" placeholder="Body">{{ old('body', $tip->body) }}</textarea>
    @if ($errors->has('body'))
    <p class="text-red-500 text-xs italic">{{ $errors->first('body') }}</p>
    @endif
</div>

@include('admin.partials.tags', ['tags' => $tags])
