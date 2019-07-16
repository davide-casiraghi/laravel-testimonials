@extends('laravel-testimonials::testimonials.layout')

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-6">
            <h4>Testimonials list</h4>
        </div>
        <div class="col-12 col-sm-6 mt-4 mt-sm-0 text-right">
            <a class="btn btn-success create-new" href="{{ route('testimonials.create') }}">Add new testimonial</a>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    
    {{-- List all the quotes --}}
    <div class="testimonialsList my-4">
            
        @foreach ($testimonials as $testimonial)
                <div class="row bg-white shadow-1 rounded mb-3 mx-1">
                    
                    <div class="col-12 pb-2 pt-3 px-3">
                        <div class="row">
                            
                            {{-- Name --}}
                            <div class="col-12 py-1 name">
                                <h5 class="darkest-gray">{{ $testimonial->name }}</h5>
                            </div>
                            
                            {{-- Body --}}
                            <div class="col-12">
                                @if($testimonial->translate('en')->body){{ $testimonial->translate('en')->body }}@endif
                            </div>
                            
                            {{-- Translations --}}
                            <div class="col-12 mb-4 mt-4">
                                @foreach ($countriesAvailableForTranslations as $key => $countryAvTrans)
                                    @if($testimonial->hasTranslation($key))
                                        <a href="{{ route('testimonialTranslations.edit', ['testimonialTranslationId' => $testimonial->id, 'languageCode' => $key]) }}" class="bg-success text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @else
                                        <a href="{{ route('testimonialTranslations.create', ['testimonialTranslationId' => $testimonial->id, 'languageCode' => $key]) }}" class="bg-secondary text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-12 pb-2 action">
                                <form action="{{ route('testimonials.destroy',$testimonial->id) }}" method="POST">

                                    <a class="btn btn-primary float-right" href="{{ route('testimonials.edit',$testimonial->id) }}">@lang('laravel-testimonials::general.edit')</a>
                                    <a class="btn btn-outline-primary mr-2 float-right" href="{{ route('testimonials.show',$testimonial->id) }}">@lang('laravel-testimonials::general.view')</a>
                                    
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-link pl-0">@lang('laravel-testimonials::general.delete')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            @endforeach    
        
        
        
                      
    </div>

@endsection
