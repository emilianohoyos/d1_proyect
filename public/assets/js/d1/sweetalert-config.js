// Configuración global de SweetAlert2
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Configuración para confirmaciones
const Confirm = Swal.mixin({
    title: '¿Está seguro?',
    text: "Esta acción no se puede deshacer",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, continuar',
    cancelButtonText: 'Cancelar'
});

// Configuración para alertas de éxito
const Success = Swal.mixin({
    icon: 'success',
    title: '¡Éxito!',
    showConfirmButton: false,
    timer: 1500
});

// Configuración para alertas de error
const Error = Swal.mixin({
    icon: 'error',
    title: 'Error',
    text: 'Ha ocurrido un error inesperado',
    confirmButtonColor: '#3085d6'
});

// Configuración para alertas de información
const Info = Swal.mixin({
    icon: 'info',
    title: 'Información',
    confirmButtonColor: '#3085d6'
});

// Configuración para alertas de advertencia
const Warning = Swal.mixin({
    icon: 'warning',
    title: 'Advertencia',
    confirmButtonColor: '#3085d6'
}); 