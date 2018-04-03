<form method="GET" action="{{ url('expediente/region/directorio', []) }}">
	{{ csrf_field() }}
	<div class="grid-x">
		<div class="cell small-12">
			<div class="grid-x grid-margin-x">
				<div class="cell small-12 large-4">
					<div class="site-line">
						<div class="site-label padding-bottom-5">
							Nombre / Razon Social
						</div>
						<div class="site-control">
							<div class="site-control-border">
								<input type="text" class="site-input" id="nombre" name="nombre" />
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12 large-4">
				</div>
				<div class="cell small-12 large-4">
				</div>
			</div>
		</div>
	</div>
</form>
<div class="grid-x">
	<div class="cell small-12">
		<button name="accion" value="{{$accion}}" class="site-form-button float-left">
			buscar
		</button>
		<div style="clear:both;"></div>
	</div>
</div>