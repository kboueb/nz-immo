<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">ADMIN</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Catégories</div>
            </a>
            <ul>
                <li> 
                    <a href="{{ route('all.categories') }}"><i class="bx bx-right-arrow-alt"></i>Toutes les catégories</a>
                </li>
                <li> 
                    <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter une catégorie</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Les Biens immobilier</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.products') }}"><i class="bx bx-right-arrow-alt"></i>Lister les biens</a>
                </li>
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter un bien</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Les Annonces</div>
            </a>
            <ul>
                <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Lister les annonces</a>
                </li>
                <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Ajouter une annonce</a>
                </li>
            </ul>
        </li>
        
        <li> <a href="{{ route('all.demandes') }}"><i class="bx bx-right-arrow-alt"></i>Liste des demandes</a>
        </li>
        <li> <a href="{{ route('all.reservations') }}"><i class="bx bx-right-arrow-alt"></i>Liste des réservations</a>
        </li>
        <li class="menu-label">Gestion Utilisateurs</li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Propriétaires</div>
            </a>
            <ul>
                <li> <a href="{{route('seller.active')}}"><i class="bx bx-right-arrow-alt"></i>Actifs</a>
                </li>
                <li> <a href="{{route('seller.inactive')}}"><i class="bx bx-right-arrow-alt"></i>Inactifs</a>
                </li>
            </ul>
        </li>
        
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>
                <li> <a href="{{route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>Tous les sliders</a>
                </li>
                <li> <a href="{{route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter un slider</a>
                </li>
            </ul>
        </li> --}}
    </ul>
    <!--end navigation-->
</div>