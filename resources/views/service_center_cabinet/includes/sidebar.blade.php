<md-list>
    <md-list-item ng-click="null" class="{{ active('cabinet.dashboard') }}" ng-href="{{ route('cabinet.dashboard') }}">
        <md-icon>dashboard</md-icon>
        <p>Dashboard</p>
    </md-list-item>

    @if (count($service_centers) > 0)
        <md-subheader>Сервисные центры</md-subheader>
        @foreach($service_centers as $service)
            <md-list-item ng-click="null"
                          href="{{ route('cabinet.service',  ['id' => $service->id]) }}"
                          class="{{ active('cabinet/service/' . $service->id) }}">
                <p>{{ $service->service_name }}</p>
            </md-list-item>
        @endforeach
    @else
        <md-subheader>Создайте сервисный центр</md-subheader>
    @endif
    <md-divider></md-divider>

    <md-list-item ng-click="null"
                  class="{{ active('cabinet.add.service') }} "
                  ng-href="{{ route('cabinet.add.service') }}">
        <md-icon>add</md-icon>
         <p>Добавить</p>
    </md-list-item>

</md-list>

