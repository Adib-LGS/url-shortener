@extends('layouts.base')
@section('content')
    <h1>This is your shortened URL :</h1>
    
<a href="{{ config('app.url') }}/{{ $shortened }}">
        {{ config('app.url') }}/{{ $shortened }}
</a>
@endsection