@extends('layout/site')
@php ($titlePage = (isset($title) && $title != '')? $title." | " : '')
@section('title',$titlePage. env('APP_NAME'))

@section('content')
<div class="container">

    <div class="row">

        <div class="col s12 m12">
            <h4>{{ $title }}</h4>
            {{ $content }}
        </div>
    </div>
          
</div>
@endsection