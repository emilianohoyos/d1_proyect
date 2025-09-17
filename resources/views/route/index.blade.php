@extends('layout.default')
@section('title', 'Rutas')
@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/highlightjs.demo.js"></script>
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="/assets/js/d1/project.js"></script>
    {{-- <script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script> --}}
@endpush
@section('content')
    <div class="">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Rutas</h4>
                    <div>
                        <a href="{{ route('route.schedule.search') }}" class="btn btn-info me-2">Consultar Programación</a>
                        <a href="{{ route('route.schedule.create') }}" class="btn btn-success me-2">Programar Rutas</a>
                        <a href="{{ route('route.create') }}" class="btn btn-primary">Nueva Ruta</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-default">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tiendas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($routes as $route)
                                <tr>
                                    <td>{{ $route->route_name }}</td>
                                    <td>{{ $route->count_store }}</td>
                                    <td>
                                        <button type="button" 
                                            class="btn btn-sm btn-primary view-route-map"
                                            data-route-id="{{ $route->route_id }}"
                                            data-route-name="{{ $route->route_name }}">
                                            <i class="fas fa-map-marked-alt"></i> Ver Ruta
                                        </button>
                                        <a href="{{ route('route.stores', $route->route_id) }}"
                                            class="btn btn-sm btn-info">Gestionar Tiendas</a>
                                        
                                        <a href="{{ route('route.edit', $route->route_id) }}"
                                            class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('route.destroy', $route->route_id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta ruta?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No hay rutas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar el mapa de la ruta -->
    <div class="modal fade" id="routeMapModal" tabindex="-1" aria-labelledby="routeMapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="routeMapModalLabel">Mapa de Ruta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="route-map" style="height: 500px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="debug-route-data">Ver Datos Debug</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="/">
    
    <style>
        /* Estilos para los marcadores personalizados */
        .custom-marker-icon {
            background-color: transparent;
            border: none;
        }
        
        .marker-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background-color: white;
            border: 2px solid #3388ff;
            border-radius: 50%;
            color: #3388ff;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }
        
        /* Estilos para el popup de las tiendas */
        .store-popup h5 {
            margin-top: 0;
            margin-bottom: 8px;
            color: #3388ff;
            font-weight: bold;
        }
        
        .store-popup p {
            margin-bottom: 5px;
        }
        
        /* Estilos para la leyenda */
        .info.legend {
            background-color: transparent;
            border: none;
            box-shadow: none;
        }
    </style>
@endpush

@push('js')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="/"></script>
    <!-- Leaflet Polyline Decorator -->
    <script src="https://unpkg.com/leaflet-polylinedecorator@1.6.0/dist/leaflet.polylineDecorator.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables para el mapa
            let map = null;
            let markers = [];
            let polyline = null;
            let currentRouteData = null; // Para almacenar los datos actuales
            
            // Inicializar el modal
            const routeMapModal = new bootstrap.Modal(document.getElementById('routeMapModal'));
            
            // Manejar el clic en el botón "Ver Ruta"
            document.querySelectorAll('.view-route-map').forEach(button => {
                button.addEventListener('click', function() {
                    const routeId = this.getAttribute('data-route-id');
                    const routeName = this.getAttribute('data-route-name');
                    
                    // Actualizar el título del modal
                    document.getElementById('routeMapModalLabel').textContent = `Mapa de Ruta: ${routeName}`;
                    
                    // Mostrar el modal
                    routeMapModal.show();
                    
                    // Inicializar el mapa después de que el modal se muestre
                    setTimeout(() => {
                        loadRouteMap(routeId);
                    }, 500);
                });
            });
            
            // Evento para limpiar el mapa cuando se cierra el modal
            document.getElementById('routeMapModal').addEventListener('hidden.bs.modal', function () {
                destroyMap();
            });
            
            // Manejar el botón de debug
            document.getElementById('debug-route-data').addEventListener('click', function() {
                if (currentRouteData) {
                    console.log('Datos de la ruta actual:', currentRouteData);
                    alert('Revisa la consola del navegador (F12) para ver los datos de la ruta.');
                } else {
                    alert('No hay datos de ruta cargados.');
                }
            });
            
            // Función para inicializar el mapa
            function initMap(containerId, initialCoords = [4.6097, -74.0817], zoom = 12) {
                // Limpiar el mapa anterior si existe
                if (map) {
                    map.remove();
                    map = null;
                }
                
                // Crear el mapa
                map = L.map(containerId).setView(initialCoords, zoom);
                
                // Agregar la capa de OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                return map;
            }
            
            // Función para limpiar todos los marcadores del mapa
            function clearMarkers() {
                if (map) {
                    markers.forEach(marker => map.removeLayer(marker));
                    markers = [];
                    
                    if (polyline) {
                        map.removeLayer(polyline);
                        polyline = null;
                    }
                }
            }
            
            // Función para destruir el mapa y liberar recursos
            function destroyMap() {
                clearMarkers();
                if (map) {
                    map.remove();
                    map = null;
                }
            }
            
            // Función para cargar el mapa de la ruta
            async function loadRouteMap(routeId) {
                const mapContainer = document.getElementById('route-map');
                mapContainer.innerHTML = '<div class="d-flex justify-content-center align-items-center" style="height: 100%;"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
                
                try {
                    // Obtener los datos de las tiendas
                    const response = await fetch(`/route/${routeId}/map-stores`);
                    const data = await response.json();
                    
                    // Almacenar los datos para debug
                    currentRouteData = data;
                    console.log('Datos recibidos del servidor:', data);
                    
                    // Limpiar el contenedor del mapa
                    mapContainer.innerHTML = '';
                    
                    if (data.status === 'success' && data.data.stores && data.data.stores.length > 0) {
                        // Inicializar el mapa
                        const mapInstance = initMap('route-map');
                        
                        const stores = data.data.stores;
                        const latlngs = [];
                        let validStoresCount = 0;
                        
                        // Agregar marcadores para cada tienda
                        stores.forEach((store, index) => {
                            // Limpiar y convertir coordenadas
                            let lat = store.latitude ? store.latitude.toString().replace(',', '.') : null;
                            let lng = store.longitude ? store.longitude.toString().replace(',', '.') : null;
                            
                            // Validar que las coordenadas sean números válidos
                            lat = parseFloat(lat);
                            lng = parseFloat(lng);
                            
                            if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                                validStoresCount++;
                                const latlng = [lat, lng];
                                latlngs.push(latlng);
                                
                                console.log(`Tienda ${validStoresCount}: ${store.name} - Lat: ${lat}, Lng: ${lng}`);
                                
                                // Crear un icono personalizado con el número de orden
                                const customIcon = L.divIcon({
                                    className: 'custom-marker-icon',
                                    html: `<div class="marker-number">${validStoresCount}</div>`,
                                    iconSize: [30, 30],
                                    iconAnchor: [15, 15]
                                });
                                
                                // Crear un marcador con número de orden
                                const marker = L.marker(latlng, { icon: customIcon }).addTo(mapInstance);
                                marker.bindPopup(`
                                    <div class="store-popup">
                                        <h5>${store.name}</h5>
                                        <p><strong>Dirección:</strong> ${store.address || 'No disponible'}</p>
                                        <p><strong>Prioridad:</strong> ${store.priority || 'No definida'}</p>
                                        <p><strong>Coordenadas:</strong> ${lat}, ${lng}</p>
                                    </div>
                                `);
                                markers.push(marker);
                            } else {
                                console.warn(`Tienda ${store.name} tiene coordenadas inválidas: lat=${store.latitude}, lng=${store.longitude}`);
                            }
                        });
                        
                        // Mostrar información de debug
                        console.log(`Total de tiendas: ${stores.length}, Tiendas válidas: ${validStoresCount}`);
                        console.log('Coordenadas válidas:', latlngs);
                        
                        // Dibujar la línea que conecta las tiendas
                        if (latlngs.length > 1) {
                            polyline = L.polyline(latlngs, {
                                color: '#3388ff',
                                weight: 4,
                                opacity: 0.7,
                                dashArray: '10, 10',
                                lineJoin: 'round'
                            }).addTo(mapInstance);
                            
                            // Intentar agregar flechas de dirección si la biblioteca está disponible
                            try {
                                if (typeof L.polylineDecorator !== 'undefined') {
                                    const decorator = L.polylineDecorator(polyline, {
                                        patterns: [
                                            { 
                                                offset: '5%', 
                                                repeat: '10%', 
                                                symbol: L.Symbol.arrowHead({
                                                    pixelSize: 12,
                                                    polygon: false,
                                                    pathOptions: {
                                                        color: '#3388ff',
                                                        fillOpacity: 1,
                                                        weight: 2
                                                    }
                                                }) 
                                            }
                                        ]
                                    }).addTo(mapInstance);
                                }
                            } catch (error) {
                                console.warn('No se pudieron agregar las flechas de dirección:', error);
                            }
                            
                            // Ajustar el mapa para mostrar todas las tiendas
                            mapInstance.fitBounds(polyline.getBounds(), { padding: [30, 30] });
                        } else if (latlngs.length === 1) {
                            mapInstance.setView(latlngs[0], 15);
                        }
                        
                        // Mostrar mensaje si no hay tiendas válidas
                        if (validStoresCount === 0) {
                            mapContainer.innerHTML = '<div class="alert alert-warning">No se encontraron tiendas con coordenadas válidas en esta ruta.</div>';
                            return;
                        }
                        
                        // Agregar una leyenda al mapa
                        const legend = L.control({ position: 'bottomright' });
                        legend.onAdd = function() {
                            const div = L.DomUtil.create('div', 'info legend');
                            div.innerHTML = `
                                <div style="background-color: white; padding: 10px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                                    <h5>Leyenda</h5>
                                    <div><span style="color: #3388ff; font-size: 20px;">&#8594;</span> Dirección de la ruta</div>
                                    <div><span style="background-color: #3388ff; width: 20px; height: 4px; display: inline-block;"></span> Conexión entre tiendas</div>
                                    <div><span style="display: inline-block; width: 20px; height: 20px; text-align: center; background-color: white; border-radius: 50%; border: 2px solid #3388ff; color: #3388ff; font-weight: bold;">1</span> Orden de visita</div>
                                </div>
                            `;
                            return div;
                        };
                        legend.addTo(mapInstance);
                        
                    } else if (data.status === 'warning') {
                        // Mostrar mensaje de advertencia
                        mapContainer.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
                    } else {
                        // Mostrar mensaje si no hay tiendas
                        mapContainer.innerHTML = '<div class="alert alert-warning">No hay tiendas asignadas a esta ruta o no tienen coordenadas definidas.</div>';
                    }
                } catch (error) {
                    console.error('Error al cargar los datos de la ruta:', error);
                    mapContainer.innerHTML = '<div class="alert alert-danger">Error al cargar el mapa de la ruta.</div>';
                }
            }
        });
    </script>
@endpush
