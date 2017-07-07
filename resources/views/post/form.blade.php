{{ csrf_field() }}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title">Title</label>

    <input id="title" type="title" class="form-control" name="title" value="{{ old('title', $post->title) }}" required autofocus>

    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    <label for="body">Body</label>

    <textarea class="form-control" name="body" rows="10">{{ old('body', $post->body) }}</textarea>

    @if ($errors->has('body'))
        <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    @endif
</div>
