$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");  
        Swal.fire({
        title: 'Êtes-vous sure?',
        text: "Vous voulez vraiment supprimer cette catégorie?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Supprimer!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
            'Supprimé!',
            'La catégorie a bien été supprimée.',
            'success'
            )
        }
        }) 


    });

});