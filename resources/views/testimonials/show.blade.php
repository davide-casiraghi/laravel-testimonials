@extends('laravel-testimonials::testimonials.layout')

@section('content')
    
    @if($testimonial)
        <h2 class="mb-4">
            {{$testimonial->name}}, {{$testimonial->profession}}
        </h2>
        
        <div class="row">
            <div class="col-12 col-sm-8">
                {{$testimonial->body}}
                {{-- Back --}}
                <br>
                <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">@lang('laravel-testimonials::general.back')</a>
            </div>
            <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                @if(!empty($testimonial->image_file_name))
                    <img class="ml-3 float-right img-fluid mb-2" src="/storage/images/testimonials/thumb_{{ $testimonial->image_file_name }}" ><br />
                @endif
            </div>
        </div>
        
        
        
    @else
        <div class="alert alert-warning" role="alert">
            No testimonial corresponding to the specified ID has been found.
        </div>
    @endif
    

@endsection
