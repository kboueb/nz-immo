<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">VENDEUR</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    @if (Auth::user()->status == 'active')

        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('seller.dashboard')}}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Les annonces</div>
                </a>
                <ul>
                    <li> <a href="{{ route('seller.all.products') }}"><i class="bx bx-right-arrow-alt"></i>Lister les annonces</a>
                    </li>
                    <li> <a href="{{ route('seller.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter une annonce</a>
                    </li>
                </ul>
            </li>
        </ul>
            
    @endif
    <!--end navigation-->
</div>