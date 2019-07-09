@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Edit testimonial group</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonialGroups.update', $testimonialGroup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    
                    {{-- Text alignment --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Text alignment",
                              'name' => 'text_alignment',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'left' => 'Left',
                                 'center' => 'Center',
                                 'right' => 'Right',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->text_alignment,
                              'required' => false,
                              'tooltip' => '',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
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

                    {{-- Group Description --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' => 'Description',
                            'name' => 'description',
                            'value' => $testimonialGroup->description,
                            'required' => false,
                        ])
                    </div>
            
                    {{-- ====================================================== --}}
                    
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Styles</h4>
                    </div>
                    
                    <h5 class="mt-4 mb-4">Group</h5>
                    
                    {{-- Group title color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Group title color',
                            'name' => 'group_title_color',
                            'tooltip' => 'Exadecimal value for the group title color.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonialGroup->group_title_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Group title font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Group titles font size',
                            'name' => 'group_title_font_size',
                            'tooltip' => 'Group font size (eg. 3rem)',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->group_title_font_size,
                            'required' => false,
                        ])
                    </div>
                    
                    <h5 class="mt-4 mb-4">Testimonial</h5>
                    
                    {{-- Testimonial title color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Testimonial title color',
                            'name' => 'testimonial_title_color',
                            'tooltip' => 'Exadecimal value for the group title color.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonialGroup->testimonial_title_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Testimonial title font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Testimonial titles font size',
                            'name' => 'testimonial_title_font_size',
                            'tooltip' => 'Testimonial font size (eg. 2rem)',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->testimonial_title_font_size,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Testimonial descriptions font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Descriptions font size',
                            'name' => 'description_font_size',
                            'tooltip' => 'Description font size (eg. 1rem)',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->description_font_size,
                            'required' => false,
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Link options</h4>
                    </div>
                    
                    {{-- Link Style --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Link Style",
                              'name' => 'link_style',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '1' => 'Text',
                                 '2' => 'Button',
                                 '3' => 'Button Ghost',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->link_style,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                    
                    {{-- Button url --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button url',
                            'name' => 'button_url',
                            'placeholder' => 'https://...', 
                            'value' => $testimonialGroup->button_url,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button text --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button text',
                            'name' => 'button_text',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->button_text,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Button color",
                              'name' => 'button_color',
                              'placeholder' => "choose one...", 
                              'records' => $buttonColorArray,
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->button_color,
                              'tooltip' => 'Check the press-css.io website for the preview of the color available.',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Button Corners --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Button Corners",
                              'name' => 'button_corners',
                              'placeholder' => "choose one...", 
                              'records' => [
                                  '' => 'Square',
                                  'press-pill' => 'Pill',
                                  'press-round' => 'Round',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->button_corners,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Wrapper background</h4>
                    </div>
                    
                    {{-- Background type --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Background type",
                              'name' => 'background_type',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '0' => 'None',
                                 '1' => 'Colored',
                                 '2' => 'Gradient',
                                 '3' => 'Image',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->background_type,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                    
                    {{-- Background color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Background color',
                            'name' => 'bkg_color',
                            'tooltip' => 'Exadecimal value for the background color. Active if a value is specified.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonialGroup->bkg_color,
                            'required' => false,
                        ])
                    </div>
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Black cover percentage",
                              'name' => 'opacity',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '0' => 'None',
                                 '.1' => '10%',
                                 '.2' => '20%',
                                 '.3' => '30%',
                                 '.4' => '40%',
                                 '.5' => '50%',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->opacity,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- Background Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Background Image', 
                          'name' => 'background_image',
                          'folder' => 'testimonial_groups',
                          'value' => $testimonialGroup->background_image,
                          'required' => false,
                    ])
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Background image position",
                              'name' => 'background_image_position',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'left top' => 'left top',
                                 'left center' => 'left center',
                                 'left bottom' => 'left bottom',
                                 'center top' => 'center top',
                                 'center center' => 'center center',
                                 'center bottom' => 'center bottom',
                                 'right top' => 'right top',
                                 'right center' => 'right center',
                                 'right bottom' => 'right bottom',          
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->background_image_position,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Flex wrapper parameters</h4>
                    </div>
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Justify content",
                              'name' => 'justify_content',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'flex-start' => 'flex-start',
                                 'flex-end' => 'flex-end',
                                 'center' => 'center',
                                 'space-around' => 'space-around',
                                 'space-between' => 'space-between',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->justify_content,
                              'required' => false,
                              'tooltip' => '- flex-start: all the elements aligned on the left. - flex-end: elements aligned at the end; - center: aligned at the center; - space-around: split all the available space in a way that there is the same space on the left and on the right of each element; - space-between: equal space between the elements, no space in the beginning and in the end.',
                        ])
                    </div>
                
                    {{-- Flex wrap --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Flex wrap",
                              'name' => 'flex_wrap',
                              'placeholder' => "choose one...", 
                              'records' => [
                                  'wrap' => 'wrap',
                                  'wrap-reverse' => 'wrap-reverse',
                                  'nowrap' => 'nowrap',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->flex_wrap,
                              'required' => false,
                              'tooltip' => '- flex-start: all the elements aligned on the left. - flex-end: elements aligned at the end; - center: aligned at the center; - space-around: split all the available space in a way that there is the same space on the left and on the right of each element; - space-between: equal space between the elements, no space in the beginning and in the end.',
                        ])
                    </div>
                
                    {{-- Flex flow --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Flex flow",
                              'name' => 'flex_flow',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'row' => 'row',
                                 'testimonial' => 'testimonial',
                                 'testimonial-reverse' => 'testimonial-reverse',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->flex_flow,
                              'required' => false,
                              'tooltip' => '- row-reverse: it will show the element in horizontal way starting from right. - testimonial: switch the main axis from horizontal to vertical showing elements starting from top. - testimonial-reverse: switch the main axis from horizontal to vertical showing elements starting from bottom.',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Testimonial's parameters</h4>
                    </div>
                
                    {{-- Flex  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Flex',
                            'name' => 'testimonials_flex',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->testimonials_flex,
                            'required' => true,
                            'tooltip' => 'The flex property applied to all testimonials. Can be overrided by setting the flex property of the single cild. Eg. 1 0 320px (grow shrink basis) or 0 1 auto',
                        ])
                    </div>
                    
                    {{-- Padding  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Padding',
                            'name' => 'testimonials_padding',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->testimonials_padding,
                            'required' => true,
                            'tooltip' => 'eg. 10px 30px 10px 30px',
                        ])
                    </div>
                    
                    {{-- Box sizing --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Box sizing",
                              'name' => 'testimonials_box_sizing',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'content-box' => 'content-box',
                                 'border-box' => 'border-box',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonialGroup->testimonials_box_sizing,
                              'required' => false,
                              'tooltip' => '- row-reverse: it will show the element in horizontal way starting from right. - testimonial: switch the main axis from horizontal to vertical showing elements starting from top. - testimonial-reverse: switch the main axis from horizontal to vertical showing elements starting from bottom.',
                        ])
                    </div>
                    
                    {{-- Round images --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'testimonials_round_images',
                              'description' => 'Round images',
                              'value' => $testimonialGroup->testimonials_round_images,
                              'required' => false,
                        ])
                    </div>
                
                    {{-- Images width  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Images width',
                            'name' => 'testimonials_images_width',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->testimonials_images_width,
                            'required' => true,
                            'tooltip' => 'eg. 30px',
                        ])
                    </div>
                
                    {{-- Hide images on mobile --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'testimonials_images_hide_mobile',
                              'description' => 'Hide images on mobile',
                              'value' => $testimonialGroup->testimonials_images_hide_mobile,
                              'required' => false,
                        ])
                    </div>
                
                    {{-- Font awesome icon size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Font awesome icon size. ',
                            'name' => 'icons_size',
                            'placeholder' => '2rem', 
                            'value' => $testimonialGroup->icons_size,
                            'required' => true,
                            'tooltip' => 'eg. 2rem',
                        ])
                    </div>
                
                    {{-- Icons color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons color',
                            'name' => 'icon_color',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonialGroup->icon_color,
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
