<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>MENU</h3>
        <ul class="nav side-menu">
            {{--<li>
                <a><i class="fa fa-desktop"></i>Tanımlar<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    --}}{{--<li><a href="{{route('admin_tag_index')}}">Etiketler</a></li>--}}{{--
                    --}}{{--<li><a href="{{route('admin_category_index')}}">Kategoriler</a></li>--}}{{--
                </ul>
            </li>--}}
            @can('admin')
                <li><a href="{{route('admin_user_index')}}"><i class="fa fa-user"></i> {{__('sidebar.users')}}</a></li>
            @endcan
        </ul>
    </div>

</div>
