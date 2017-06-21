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
        @if (count($service_centers) > 0)
            <li class="header">Сервисные центры</li>
            @foreach($service_centers as $service)
                <li class="{{ active('cabinet/sc/' . $service->id) }}">
                    <a href="{{ route('cabinet.service',  ['id' => $service->id]) }}" >
                        {{ $service->service_name }}
                        <span class="pull-right-container">
                            <span ng-click="deleteService( {{ $service->id }} )" class="fa fa-trash"></span>
                        </span>
                    </a>
                </li>
            @endforeach
        @else
            <li class="header">Создайте сервисный центр</li>
        @endif



        <li class="{{ active('cabinet.add.service') }} ">
            <a  href="{{ route('cabinet.add.service') }}">
                <i class="fa fa-plus"></i> <span>Добавить</span>
                <span class="pull-right-container"></span>
            </a>
        </li>


        <li ng-if="showTrash()" class="treeview">
            <a href>
                <i class="fa fa-trash"></i> <span>Корзина</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('admin.pages') }}"><i class="fa fa-files-o"></i> Страницы</a></li>
                <li><a href="{{ route('admin.pages') }}"><i class="fa fa-files-o"></i> SEO</a></li>
            </ul>
        </li>

    </ul>
</section>