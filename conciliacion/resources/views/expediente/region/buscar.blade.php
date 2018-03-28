<form method="GET" action="{{ url('expediente/region/directorio', []) }}">
	{{ csrf_field() }}
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-6">
				<div class="site-label padding-bottom-5">
					Nombre
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="nombre" name="nombre" />
					</div>
				</div>
			</div>
		</div>
		<div class="cell small-12 padding-bottom-50">
			<button name="accion" value="{{$accion}}" class="site-form-button float-left">
				buscar
			</button>
			<div style="clear:both;"></div>
		</div>
	</div
</form>
