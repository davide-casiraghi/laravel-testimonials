@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')

    @include('laravel-testimonials::show-testimonial-group', [
            'testimonials' => $testimonials,
            'testimonialGroup' => $testimonialGroup,
            'testimonialGroupParameters' => $testimonialGroupParameters,
       ])
       
@endsection
