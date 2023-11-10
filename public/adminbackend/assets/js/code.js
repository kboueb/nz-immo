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

    $(document).on('click','#inactive',function(e){
        e.preventDefault();
        var link = $(this).attr("href");  
        Swal.fire({
        title: 'Êtes-vous sure?',
        text: "Vous voulez vraiment désactiver ce compte?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, désactiver!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
            'Désactivé!',
            'Compte désactivé avec succès.',
            'success'
            )
        }
        }) 
    });

    $(document).on('click','#active',function(e){
        e.preventDefault();
        var link = $(this).attr("href");  
        Swal.fire({
        title: 'Êtes-vous sure?',
        text: "Vous voulez vraiment activer ce compte?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, activer!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
            'Activé!',
            'Compte activé avec succès.',
            'success'
            )
        }
        }) 
    });

    $(document).on('click','#delete-slide',function(e){
        e.preventDefault();
        var link = $(this).attr("href");  
        Swal.fire({
        title: 'Êtes-vous sure?',
        text: "Vous voulez vraiment supprimer ce slide?",
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
            'slide supprimé avec succès.',
            'success'
            )
        }
        }) 
    });

});