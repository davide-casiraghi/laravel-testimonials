@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h3>Edit testimonial group</h3>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonialGroups.update', $testimonialGroup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    
                    <div class="col-12">
                        <h4 class="my-3">General options</h4>
                    </div>
                
                    {{-- Quotes color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Quotes color",
                              'name' => 'quotes_color',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'red' => 'Red',
                                 'pink' => 'Pink',
                                 'purple' => 'Purple',
                                 'deeppurple' => 'Deep purple',
                                 'indigo' => 'Indigo',
                                 'blue' => 'Blue',
                                 'lightblue' => 'Light blue',
                                 'cyan' => 'Cyan',
                                 'teal' => 'Teal',
                                 'green' => 'Green',
                                 'lightgreen' => 'Light green',
                                 'lime' => 'Lime',
                                 'yellow' => 'Yellow',
                                 'amber' => 'Amber',
                                 'orange' => 'Orange',
                                 'deeporange' => 'Deep orange',
                                 'brown' => 'Brown',
                                 'grey' => 'Grey',
                                 'bluegrey' => 'Blue grey',
                                 'black' => 'Black',
                                 'white' => 'White',
                              ],      
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->quotes_color,
                              'required' => false,
                              'tooltip' => 'Exadecimal value for the quotes color',
                        ])
                    </div>
                
                    {{-- Max characters --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Max characters',
                            'name' => 'max_characters',
                            'tooltip' => 'Limit the characters shown in the testimonial texts.',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->max_characters,
                            'required' => false,
                        ])
                    </div>
                    
                    <div class="col-12">
                        <hr>
                        <h4 class="my-3">Title options</h4>
                    </div>        
                    
                    {{-- Group Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->title,
                            'required' => true,
                        ])
                    </div>
                
                    {{-- Show title --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'show_title',
                              'description' => 'Show title',
                              'value' => $testimonialGroup->show_title,
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Title alignment --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Alignment",
                              'name' => 'title_alignment',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'left' => 'Left',
                                 'center' => 'Center',
                                 'right' => 'Right',
                              ],      
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->title_alignment,
                              'required' => false,
                              'tooltip' => '',
                        ])
                    </div>
                        
                        
                    <div class="col-12">
                        <hr>
                        <h4 class="my-3">Snippet</h4>
                    </div>   
                    
                    
                    <div class="col-12">
                        @include('laravel-form-partials::input-readonly', [
                            'title' => 'To show this testimonial group use this snippet',
                            'name' => 'snippet',
                            'placeholder' => '', 
                            'value' => ' {# testimonial_group testimonial_group_id=['.$testimonialGroup->id.'] #}',
                            'required' => false,
                        ])
                    </div>
                    
                    
                                        
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'testimonialGroups.index'  
                       ])
                    </div>
                    
                </div>
            </form>
    
    </div>
    
@endsection
