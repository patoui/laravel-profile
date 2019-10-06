{{ csrf_field() }}
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('title') ? 'border-red-500' : '' }}" for="title"></label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title" value="{{ old('title', $video->title) }}">
    @if ($errors->has('title'))
    <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
    @endif
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('slug') ? 'border-red-500' : '' }}" for="slug"></label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="slug" name="slug" type="text" placeholder="Slug" value="{{ old('slug', $video->slug) }}">
    @if ($errors->has('slug'))
    <p class="text-red-500 text-xs italic">{{ $errors->first('slug') }}</p>
    @endif
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('external_id') ? 'border-red-500' : '' }}" for="external_id"></label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="external_id" name="external_id" type="text" placeholder="External ID" value="{{ old('external_id', $video->external_id) }}">
    @if ($errors->has('external_id'))
        <p class="text-red-500 text-xs italic">{{ $errors->first('external_id') }}</p>
    @endif
</div>

<tags :initial-tags="{{ json_encode($tags) }}"
    :initial-errors="{{ json_encode($errors) }}"></tags>

