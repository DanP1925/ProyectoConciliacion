<div class="table-3cells-div">
	<div class="left-div">
		<div class="site-list-item-expediente-fecha padding-bottom-3">
			{{$expediente->getFecha()}}
		</div>
		<div class="site-list-item-expediente-numero padding-bottom-3">
			{{$expediente->numero}}
		</div>
		<div class="site-list-item-label">
			Tipo caso:
		</div>
		<div class="site-list-item-label">
			<span class="font-avantgarde-regular">{{$expediente->getTipoCaso()}} / {{$expediente->getSubtipoCaso()}}</span>
		</div>
	</div>
	<div class="middle-div">
		<div class="site-list-item-label padding-bottom-3">
			Secretario Responsable
		</div>
		<div class="site-list-item-text padding-bottom-5">
			{{$expediente->getSecretarioResponsable()}}
		</div>
		<div class="site-list-item-label padding-bottom-3">
			Secretario Lider
		</div>
		<div class="site-list-item-text">
			{{$expediente->getSecretarioLider()}}
		</div>
	</div>
	<div class="right-div">
		<div class="site-list-item-label padding-bottom-3">
			Demandante
		</div>
		<div class="site-list-item-text padding-bottom-5">
			{{$expediente->getDemandante()}}
		</div>
		<div class="site-list-item-label padding-bottom-3">
			Demandado
		</div>
		<div class="site-list-item-text">
			{{$expediente->getDemandado()}}
		</div>
	</div>
</div>
