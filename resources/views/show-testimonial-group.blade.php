

@if ($testimonialGroup)
    
    <div class='testimonials py-4 px-2'>
        
        <h3 class='mb-4'>{{$testimonialGroup['title']}}</h3>
    
        <div class='testimonialsList'>
        
            {{-- Testimonials --}}
    		@foreach ($testimonials as $key => $testimonial)
                
                <aside class='testimonial'>
                    
                    {{-- Image --}}
                    @if ($testimonial->image_file_name)
                        <img class='user-image' src='/storage/images/testimonials/{{$testimonial->image_file_name}}'/>
                    @else
                        <img class='user-image' src='/vendor/laravel-testimonials/assets/images/circle_male_user.png'/>
                    @endif
                    
                    {{-- Text --}}
                    <h4 style='{{$testimonialGroupParameters['title_style']}}'>{{$testimonial->title}}</h4>
                    <img class='start-quote' src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-src='/vendor/laravel-testimonials/assets/images/start-quote-{{$testimonialGroup->quotes_color}}.png' alt='Start Quote'>
                    <p style='{{$testimonialGroupParameters['description_style']}}'>{{$testimonial->body}}</p> 
					<img class='end-quote' src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-src='/vendor/laravel-testimonials/assets/images/end-quote-{{$testimonialGroup->quotes_color}}.png' alt='End Quote'>		
                
                    {{-- Author --}}
                    <div class='author {{$testimonialGroupParameters['group_button_style']}}'>
		    			{{$testimonial->author}}
                        @if($testimonial->profession), {{$testimonial->profession}} @endif
	    			</div>
                    
                
                </aside>    
                
            @endforeach	
            
        </div>              
                        

    </div>
    
@else
    <div class='alert alert-warning' role='alert'>The testimonial group with the specified id has not been found.</div>
@endif
