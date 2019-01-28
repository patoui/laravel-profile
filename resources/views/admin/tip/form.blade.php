{{ csrf_field() }}

<div class="field">
    <label class="label">Title</label>
    <p class="control">
        <input name="title" class="input{{ $errors->has('title') ? ' is-danger' : '' }}" type="text" value="{{ old('title', $tip->title) }}" required autofocus>
    </p>

    @if ($errors->has('title'))
    <p class="help is-danger">{{ $errors->first('title') }}</p>
    @endif
</div>

<div class="field">
    <label class="label">URL</label>
    <p class="control">
        <input name="slug" class="input{{ $errors->has('slug') ? ' is-danger' : '' }}" type="text" value="{{ old('slug', $tip->slug) }}">
    </p>

    @if ($errors->has('slug'))
    <p class="help is-danger">{{ $errors->first('slug') }}</p>
    @endif
</div>

<div class="field">
    <label class="label">Body</label>
    <p class="control">
        <textarea name="body" class="textarea{{ $errors->has('body') ? ' is-danger' : '' }}" rows="10">{{ old('body', $tip->body) }}</textarea>
    </p>

    @if ($errors->has('body'))
    <p class="help is-danger">{{ $errors->first('body') }}</p>
    @endif
</div>

<tags :initial-tags="{{ json_encode($tags) }}"
    :initial-errors="{{ json_encode($errors) }}"></tags>
