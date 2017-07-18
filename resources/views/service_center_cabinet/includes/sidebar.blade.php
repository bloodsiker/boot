<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        @if(Auth::user()->roleAdmin())

            <li class="{{ active('cabinet.admin.user.list') }} ">
                <a href="{{ route('cabinet.admin.user.list') }}">
                    <i class="fa fa-users"></i> <span>Пользователи</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <li class="{{ active(['cabinet.admin.list.sc', 'cabinet.admin.service']) }} ">
                <a href="{{ route('cabinet.admin.list.sc') }}">
                    <i class="fa fa-users"></i> <span>Сервисные центры</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

        @elseif(Auth::user()->roleSc())

            <li>
                <a href="{{ route('cabinet.dashboard') }}">
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


            <li ng-if="disabledSc.length > 0" class="treeview">
                <a href>
                    <i class="fa fa-trash"></i> <span>Корзина</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li ng-repeat="sc_item in disabledSc">
                        <a href ng-click="enableSc(sc_item.id)">
                            @{{ sc_item.service_name }}
                            <span class="pull-right-container">
                                <span class="fa fa-refresh"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

        @endif

    </ul>
</section>