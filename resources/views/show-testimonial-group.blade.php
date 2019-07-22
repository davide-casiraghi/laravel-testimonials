
@if ($testimonialGroup)
    
    <div class='testimonials py-4 px-2'>
        
        <h3 class='mb-5 text-{{$testimonialGroup->title_alignment}}' style='{{$testimonialGroupParameters['title_style']}}'>{{$testimonialGroup->title}}</h3>
    
        <div class='testimonialsList'>
    		@foreach ($testimonials as $key => $testimonial)
                
                <div class='testimonial'>
                
                    {{-- Image --}}
                    @if ($testimonial->image_file_name)
                        <img class='user-image' src='/storage/images/testimonials/{{$testimonial->image_file_name}}'/>
                    @else
                        @if ($testimonial->gender == 'm')
                            <img class='user-image' src='/vendor/laravel-testimonials/assets/images/circle_male_user.png'/>    
                        @else
                            <img class='user-image' src='/vendor/laravel-testimonials/assets/images/circle_female_user.png'/>
                        @endif    
                    @endif
                    
                    {{-- Text --}}
                    <div class="text">
                        <img class="start-quote" src="/vendor/laravel-testimonials/assets/images/start-quote-{{$testimonialGroup->quotes_color}}.png" alt="Start Quote">
                            {{ str_limit($testimonial->body, $limit = $testimonialGroup->max_characters, $end = '...') }}
                        <img class="end-quote" src="/vendor/laravel-testimonials/assets/images/end-quote-{{$testimonialGroup->quotes_color}}.png" alt="End Quote">
                        
                        {{-- Read more --}}    
                        @if(strlen($testimonial->body) > $testimonialGroup->max_character)
                            <br>
                            <a href="{{ route('testimonials.show',$testimonial->id) }}">@lang('laravel-testimonials::general.read_more')</a>
                        @endif
                        {{-- Author --}}
                        <div class='author {{$testimonialGroup->quotes_color}}'>
    		    			{{$testimonial->name}}
                            @if($testimonial->profession), {{$testimonial->profession}} @endif
    	    			</div>
                    </div> 
							
                
                    
        
                </div>        
            @endforeach	
        </div>                  
    </div>
@else
    <div class='alert alert-warning' role='alert'>The testimonial group with the specified id has not been found.</div>
@endif
