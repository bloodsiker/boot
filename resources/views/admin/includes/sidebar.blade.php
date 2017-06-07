<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}">
                <i class="fa fa-users"></i> <span>Пользователи</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-files-o"></i> <span>Страницы</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('admin.pages') }}"><i class="fa fa-files-o"></i> Страницы</a></li>
                <li><a href="{{ route('admin.pages') }}"><i class="fa fa-files-o"></i> SEO</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.city') }}">
                <i class="fa fa-th"></i> <span>Города</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.street') }}">
                <i class="fa fa-street-view"></i> <span>Улицы</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>

    </ul>
</section>