<div class="list-text-3-div">
	<div class="list-label-avant-garde-bold color-114168">
		{{$expediente->getFecha()}}
	</div>
	<div class="list-biglabel-avant-garde-bold">
		{{$expediente->numero}}
	</div>
	<div class="list-sublabel-avant-garde-regular">
		<strong>Tipo:</strong> {{$expediente->getTipoCaso()}} / {{$expediente->getSubtipoCaso()}}
	</div>
</div>
<div class="list-text-3-div">
	<div class="list-line-div">
		<div class="list-sublabel-avant-garde-lite">
			Secretario Responsable
		</div>
		<div class="list-label-avant-garde-regular">
			{{$expediente->getSecretarioResponsable()}}
		</div>
	</div>
	<div class="list-sublabel-avant-garde-lite">
		Secretario Lider
	</div>
	<div class="list-label-avant-garde-regular">
		{{$expediente->getSecretarioLider()}}
	</div>
</div>
<div class="list-text-3-div">
	<div class="list-line-div">
		<div class="list-sublabel-avant-garde-lite">
			Demandante
		</div>
		<div class="list-label-avant-garde-regular">
			{{$expediente->getDemandante()}}
		</div>
	</div>
	<div class="list-sublabel-avant-garde-lite">
		Demandado
	</div>
	<div class="list-label-avant-garde-regular">
		{{$expediente->getDemandado()}}
	</div>
</div>
<div class="list-icon-div">
	<a href="{{ url('expediente/info',['id'=>$expediente->idExpediente])}}">
		<img src="{{ asset('images/ico_pointer_blue.png') }}" />
	</a>
</div>
<div class="list-icon-div">
	<img src="{{ asset('images/ico_delete_red.png') }}" />
</div>

