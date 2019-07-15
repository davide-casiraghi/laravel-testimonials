@extends('laravel-testimonials::testimonials.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Add new testimonial</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    
                    {{-- Name --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Name',
                            'name' => 'name',
                            'placeholder' => '', 
                            'value' => old('name'),
                            'required' => true,
                        ])
                    </div>

                    {{-- Body --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' => 'Body',
                            'name' => 'body',
                            'value' => old('body'),
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Profession --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Profession',
                            'name' => 'profession',
                            'placeholder' => '', 
                            'value' => old('profession'),
                            'required' => true,
                        ])
                    </div>
                    
                    {{-- Gender --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Gender",
                              'name' => 'gender',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'm' => 'M',
                                 'f' => 'F',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => old('gender'),
                              'required' => false,
                              'tooltip' => '',
                        ])
                    </div>
                    
                    {{-- Testimonials group --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Testimonials group",
                              'name' => 'testimonials_group',
                              'placeholder' => "choose one...", 
                              'records' => $testimonialGroupsArray,
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => old('testimonials_group'),
                              'tooltip' => 'Pick the group to show',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Testimonial image',
                          'name' => 'image_file_name',
                          'folder' => 'testimonials',
                          'value' => old('image_file_name'),
                    ]) 
                    
                    {{-- ====================================================== --}}
                                                            
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'testimonials.index'  
                       ])
                    </div>
                                
                </div>
            </form>
    
    </div>
    
@endsection
