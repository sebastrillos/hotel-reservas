$(document).on('submit', 'form', function(e)
{
    if($(this).find('.btn-danger').length > 0)
    {
        e.preventDefault();

        let form = this;

        Swal.fire({

            title: '¿Eliminar registro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',

            background: '#fff',

            reverseButtons: true

        }).then((result) => {

            if(result.isConfirmed)
            {
                form.submit();
            }

        });
    }
});
