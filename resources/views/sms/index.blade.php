@extends('layouts.app')

@section('title', 'Send an SMS to Pat!')

@section('content')
    <section class="section">
        <div class="container">
            <div class="column is-half-desktop is-three-quarters-tablet">
                <form method="POST" action="{{ route('sms.store') }}">

                    {{ csrf_field() }}

                    <div class="field">
                        <label class="label">Message</label>
                        <p class="control">
                            <input name="message" class="input{{ $errors->has('message') ? ' is-danger' : '' }}" type="text" value="{{ old('message', '') }}" required autofocus>
                        </p>

                        @if ($errors->has('message'))
                        <p class="help is-danger">{{ $errors->first('message') }}</p>
                        @endif
                    </div>

                    <p class="control">
                        <button type="submit" class="button is-primary">Submit</button>
                    </p>
                </form>
                @if (session('success'))
                <div class="message is-success" style="margin-top: 10px;">
                    <div class="message-header"><p>Success</p></div>
                    <div class="message-body">{{ session('success') }}</div>
                </div>
                @endif
                @if (session('error'))
                <div class="message is-danger" style="margin-top: 10px;">
                    <div class="message-header"><p>Error</p></div>
                    <div class="message-body">{{ session('error') }}</div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
