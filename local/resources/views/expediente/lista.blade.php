@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="grid-x">

    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        EXPEDIENTES
                    </div>
                </div>
                <div class="right-div">
                	<a href="{{ url('/expediente/nuevo',[]) }}">
                        <div class="site-title-button float-right">
                            Nuevo Expediente
                        </div>
                    </a>
                    <div style="clear:both;"></div>
                </div>
            </div>
		</div>

		@include('expediente.buscar')
        
		<div class="cell small-12 padding-bottom-20">
			@foreach ($expedientes as $expediente)
				@if ($loop->index % 2 == 0)
					<div class="list-div background-color-F5F5F5">
				@else
					<div class="list-div background-color-FFFFFF">
				@endif
						@include('expediente.elemento')
					</div>
			@endforeach
        </div>
		
		<div class="small-12 cell">
			<div class="site-section-padding">
				<div class="div-pagination">
					<div class="pagination">
						{{$expedientes->links() }}
					</div>
				</div>
			</div>
		</div>
        
    </div>
</div>
@endsection
