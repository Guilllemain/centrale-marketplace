@extends('layouts.app')

@section('content')
	<search-component categories="{{json_encode($categories)}}"></search-component>
@endsection