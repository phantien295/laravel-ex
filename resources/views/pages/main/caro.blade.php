@extends('pages.admin.layout')
@section('title', 'JCAROUSEL')
@section('header', 'JCAROUSEL')

@section('content')
	<div class="wrapper">
		<div class="jcarousel-wrapper">
			<div class="jcarousel">
                <ul>
           			<li>
           				<img src="{{ asset('public/uploads/images/ConanTap89.jpg') }}"  />
       				<li>
        				<img src="{{ asset('public/uploads/images/ConanTap89.jpg') }}"  />
        			</li>            
        			<li>
        				<img src="{{ asset('public/uploads/images/ConanTap89.jpg') }}"  />
       				</li>
       				<li>
        				<img src="{{ asset('public/uploads/images/ConanTap89.jpg') }}"  />
      				</li>                        
                </ul>
            </div>

                <!-- <p class="photo-credits">
                    Photos by <a href="http://www.mw-fotografie.de">Marc Wiegelmann</a>
                </p> -->

            <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next">&rsaquo;</a>
        </div>
    </div>
    <script type="text/javascript">
		$(function() {
		    $('.jcarousel').jcarousel({
		        // Configuration goes here
		    });
		});
	</script>
@endsection