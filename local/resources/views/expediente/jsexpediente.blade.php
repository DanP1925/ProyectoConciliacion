	function buscarSecretario() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarSecretarioLider() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarDemandante() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarDemandado() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarRegion() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarRecurso() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	$("#btn-registrar-expediente").click(function() {
		var cont = 0;

		if ($('#numero').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Número Expediente" /> ');
		}

		if ($('#fechaSolicitud').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Fecha Inicio de Solicitud" /> ');
		}

		if ($('#estadoExpediente').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Estado de Expediente" />');
		}

		if ($('#tipoCaso').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Tipo de Caso" />');
		}

		if ($('#subtipoCaso').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Subtipo de Caso" />');
		}

		if ($('#cuantiaControversiaInicial').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Cuantía Controversia Inicial"/>');
		} else {
			if (isNaN($('#cuantiaControversiaInicial').val())){
				cont = cont + 1;
			}
		}

		if ($('#cuantiaControversiaFinal').val()!=""){
			if (isNaN($('#cuantiaControversiaFinal').val())){
				cont = cont + 1;
			}
		}

		if ($('#tipoCuantia').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Tipo Cuantía"/>');
		}

		if ($('#escalaPago').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Escala de Pago (A-H)"/>');
		}

		if ($('#demandante').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Demandante"/>');
		}

		if ($('#demandado').val()==""){
			cont = cont + 1;
			document.getElementById('mensajesValidacion')
				.insertAdjacentHTML('beforeend','<input type="hidden" name="validaciones[]" value="Demandado"/>');
		}

		if ($('#anhoContrato').val()!=""){
			if (isNaN($('#anhoContrato').val())){
				cont = cont + 1;
			}
		}

		if ($('#resultadoEnSoles').val()!=""){
			if (isNaN($('#resultadoEnSoles').val())){
				cont = cont + 1;
			}
		}

		//Validar si ha llenado ambos arbitro unico y tribunal arbitral
		var hayUnico = ($('#arbitroUnico').val()!=""); 
		var hayTribunal = (($('#presidenteTribunal').val()!="") ||
			($('#arbitroDemandante').val()!="") ||
			($('#arbitroDemandado').val()!=""));
		var hayUnicoYTribunal = hayUnico && hayTribunal;

		if (!hayUnicoYTribunal) {

			//Validar si ya existe expediente
			var yaExisteExpediente = esNumeroValido();
			if (yaExisteExpediente){
				$('#modalExpedienteExistente').foundation('open');
			} else {

				//Faltan datos de expediente
				if(cont>0){
					var validaciones = $("input[name='validaciones[]']")
						.map(function(){return $(this).val();}).get();

					var lista = document.getElementById("listaValidacionesModal");
					for (i=0; i<validaciones.length;i++){
						lista.insertAdjacentHTML('beforeend','<li>' + validaciones[i] + '</li>');
					}
					$('#modalFaltanDatosExpediente').foundation('open');
				} else{
					$('#modalRegistrarConfirmar').foundation('open');
				}

			}
		} else {
			$('#modalArbitrosExpediente').foundation('open');
		}

	});

	$("#aceptarValidacion").click(function() {
		var lista = document.getElementById("listaValidacionesModal");
		while (lista.firstChild) {
			lista.removeChild(lista.firstChild);
		}

		var mensajes = document.getElementById('mensajesValidacion');
		while (mensajes.firstChild) {
			mensajes.removeChild(mensajes.firstChild);
		}
	});

	$("#btn-registrar").click(function() {
		$('#modalRegistrarConfirmar').foundation('close');
		$('#modalRegistrarMensaje').foundation('open');
		var form = document.getElementById("form-registrar-expediente");
		form.submit()
			$('#modalRegistrarMensaje').foundation('close');
	});

	$(".btn-borrar-region").click(function() {
		var idBorrarRegion = $(this).attr("idBorrarRegion");
		$("#borrarItem").val(idBorrarRegion);
		$('#modalBorrarConfirmar01').foundation('open');
	});

	$("#btn-borrar-01").click(function(){
		$('#modalBorrarConfirmar01').foundation('close');
		$('#modalBorrarMensaje').foundation('open');

		var indexRegion = $("#borrarItem").val();

		var region = document.getElementById('region ' + indexRegion);
		region.parentNode.removeChild(region);
		var outputRegion = document.getElementById('outputRegion ' + indexRegion);
		outputRegion.parentNode.removeChild(outputRegion);

		$('#modalBorrarMensaje').foundation('close');
	});

	$(".btn-borrar-recurso").click(function() {
		var idBorrarRecurso = $(this).attr("idBorrarRecurso");
		$("#borrarItem").val(idBorrarRecurso);
		$('#modalBorrarConfirmar02').foundation('open');
	});

	$("#btn-borrar-02").click(function(){
		$('#modalBorrarConfirmar02').foundation('close');
		$('#modalBorrarMensaje').foundation('open');

		var indexRecurso = $("#borrarItem").val();

		var recursoPresentado = document.getElementById('recursoPresentado ' + indexRecurso);
		recursoPresentado.parentNode.removeChild(recursoPresentado);
		var fechaPresentacion = document.getElementById('fechaPresentacion ' + indexRecurso);
		fechaPresentacion.parentNode.removeChild(fechaPresentacion);
		var resultadoRecursoPresentado = document.getElementById('resultadoRecursoPresentado ' + indexRecurso);
		resultadoRecursoPresentado.parentNode.removeChild(resultadoRecursoPresentado);
		var fechaResultado = document.getElementById('fechaResultado ' + indexRecurso);
		fechaResultado.parentNode.removeChild(fechaResultado);
		var outputRecurso = document.getElementById('outputRecurso ' + indexRecurso);
		outputRecurso.parentNode.removeChild(outputRecurso);

		$('#modalBorrarMensaje').foundation('close');
	});
