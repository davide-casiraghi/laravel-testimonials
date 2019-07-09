@extends('laravel-testimonials::testimonials.layout')

@section('content')

    @if($testimonial)
        {{$testimonial->title}}<br />
        {{$testimonial->body}}<br />
        {{$testimonial->button_text}}<br />
        @if(!empty($testimonial->image_file_name))
            <img class="ml-3 float-right img-fluid mb-2" src="/storage/images/testimonials/thumb_{{ $testimonial->image_file_name }}" ><br />
        @endif
        {{$testimonial->button_url}}<br />
    @else
        <div class="alert alert-warning" role="alert">
            No testimonial corresponding to the specified ID has been found.
        </div>
    @endif
    
    {{--
    @include('laravel-testimonials::show-testimonial', [
         'testimonial' => $testimonial,
         'testimonialParameters' => $testimonialParameters,
   ])
    --}}
@endsection
