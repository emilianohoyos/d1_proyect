/*
Template Name: STUDIO - Responsive Bootstrap 5 Admin Template
Version: 4.5.0
Author: Sean Ngu
Website: http://www.seantheme.com/studio/
*/

var handleRenderFullcalendar = function () {
	var calendarElm = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarElm, {
		headerToolbar: {
			left: 'dayGridMonth,timeGridWeek,timeGridDay',
			center: 'title',
			right: 'prev,next today'
		},
		buttonText: {
			today: 'Hoy',
			month: 'Mes',
			week: 'Semana',
			day: 'Día'
		},
		locale: 'es',
		initialView: 'dayGridMonth',
		editable: false,
		droppable: false,
		themeSystem: 'bootstrap',
		views: {
			timeGrid: {
				eventLimit: 6
			}
		},
		eventDidMount: function (info) {
			// Agregar tooltip con información adicional
			$(info.el).tooltip({
				title: `${info.event.extendedProps.route_name} - Semana ${info.event.extendedProps.week}`,
				placement: 'top',
				trigger: 'hover',
				container: 'body'
			});
		},
		events: function (info, successCallback, failureCallback) {
			// Realizar la petición AJAX para obtener las programaciones
			$.ajax({
				url: '/route/schedules/list',
				type: 'GET',
				data: {
					start: info.startStr,
					end: info.endStr
				},
				success: function (response) {
					var events = response.map(function (schedule) {
						return {
							id: schedule.id,
							title: schedule.employee_name + ' - ' + schedule.routes[0],
							start: schedule.visit_date,
							color: getRandomColor(schedule.employee_id),
							extendedProps: {
								employee_id: schedule.employee_id,
								route_name: schedule.routes[0],
								week: schedule.week,
								day: schedule.day,
								visit_status: schedule.visit_status
							}
						};
					});
					successCallback(events);
				},
				error: function (error) {
					console.error('Error al cargar las programaciones:', error);
					Error.fire({
						text: 'No se pudieron cargar las programaciones'
					});
					failureCallback(error);
				}
			});
		},
		eventClick: function (info) {
			// Mostrar modal con opciones
			const date = info.event.startStr;
			const employeeId = info.event.extendedProps.employee_id;
			const dayScheduleUrl = `/route/schedule/day/${date}?employee=${employeeId}`;
			Info.fire({
				title: 'Opciones de Programación',
				html: `
					<div class="mb-3">
						<strong>Empleado:</strong> ${info.event.title}<br>
						<strong>Ruta:</strong> ${info.event.extendedProps.route_name}<br>
						<strong>Estado:</strong> ${info.event.extendedProps.visit_status}
					</div>
					<a href="${dayScheduleUrl}" class="btn btn-info btn-sm">Ver hoy</a>
				`,
				showCancelButton: true,
				showDenyButton: true,
				confirmButtonText: 'Ver Detalle',
				denyButtonText: 'Eliminar',
				cancelButtonText: 'Cerrar'
			}).then((result) => {
				if (result.isConfirmed) {
					// Redirigir a la vista de detalle
					window.location.href = `/route/schedule/${info.event.id}/edit`;
				} else if (result.isDenied) {
					// Mostrar confirmación de eliminación
					Confirm.fire({
						title: '¿Eliminar programación?',
						text: "Esta acción eliminará todas las programaciones del mismo día y semana"
					}).then((result) => {
						if (result.isConfirmed) {
							// Realizar la eliminación
							$.ajax({
								url: `/route/schedule/delete/${info.event.id}`,
								type: 'DELETE',
								data: {
									_token: $('meta[name="csrf-token"]').attr('content')
								},
								success: function (response) {
									Success.fire({
										title: '¡Eliminado!',
										text: 'La programación ha sido eliminada'
									}).then(() => {
										calendar.refetchEvents();
									});
								},
								error: function (error) {
									Error.fire({
										text: 'No se pudo eliminar la programación'
									});
								}
							});
						}
					});
				}
			});
		}
	});

	calendar.render();
};

// Función para generar colores únicos basados en el ID del empleado
function getRandomColor(employeeId) {
	var colors = [
		'#ff2d55', // rosa
		'#ff3b30', // rojo
		'#FF9500', // naranja
		'#FFCC00', // amarillo
		'#1ABD36', // verde
		'#0cd096', // verde azulado
		'#30beff', // azul claro
		'#1f6bff', // azul
		'#640DF3', // índigo
		'#5b2e91', // púrpura
		'#869ac0', // gris
		'#ff6b6b', // coral
		'#4ecdc4', // turquesa
		'#45b7d1', // azul cielo
		'#96ceb4', // verde menta
		'#ffeead', // crema
		'#ff9999', // rosa claro
		'#99cc99', // verde claro
		'#99ccff', // azul claro
		'#cc99ff'  // púrpura claro
	];

	// Usar el ID del empleado para seleccionar un color consistente
	return colors[employeeId % colors.length];
}

// Suponiendo que tienes una función que muestra el modal de detalle de evento, agrega esto donde muestras los detalles:

// Ejemplo de integración en el callback de evento de FullCalendar
function showEventDetailModal(event) {
	// ... tu código para mostrar detalles ...
	// Agrega el botón para ver la programación del día:
	const date = event.startStr || event.start; // formato YYYY-MM-DD
	const dayScheduleUrl = '/route/schedule/day/' + date;
	const btn = document.createElement('a');
	btn.href = dayScheduleUrl;
	btn.className = 'btn btn-info btn-sm mt-2';
	btn.textContent = 'Ver programación de este día';
	// Suponiendo que tienes un div con id 'event-detail-actions' en tu modal:
	document.getElementById('event-detail-actions').appendChild(btn);
}

/* Controller
------------------------------------------------ */
$(document).ready(function () {
	handleRenderFullcalendar();
});