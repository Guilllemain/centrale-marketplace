@extends('layouts.app')

@section('content')
	<search-component :category="{{$selectedCategoryId}}" categories="{{json_encode($categories)}}"></search-component>
@endsection