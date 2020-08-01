@extends('layouts.base')
            @section('content')
                <div class="title m-b-md">
                    URL Shortener
                </div>

                <form  method="post">
                    {{ csrf_field() }}
                    <input type="text" name="url" placeholder="Past your original URL here" value="{{ old('url') }}">
                    {!! $errors->first('url', '<p class="error-msg">:message</p>') !!}
                    <input type="submit" value="Shorten URL" >
                </form>
            @endsection
        </div>
    </body>
</html>

