<md-list>
    <md-list-item ng-click="null" class="{{ active('cabinet.dashboard') }}" ng-href="{{ route('cabinet.dashboard') }}">
        <md-icon>dashboard</md-icon>
        <p>Панель</p>
    </md-list-item>

    @if (count($service_centers) > 0)
        <md-subheader>Сервисные центры</md-subheader>
        @foreach($service_centers as $service)
            <md-list-item ng-click="null"
                          href="{{ route('cabinet.service',  ['id' => $service->id]) }}"
                          class="{{ active('cabinet/sc/' . $service->id) }}">
                <p>{{ $service->service_name }}</p>
                <md-button class="md-icon-button" ng-click="deleteService( {{ $service->id }} )">
                    <md-icon>delete</md-icon>
                </md-button>
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

    <md-list-item ng-if="showTrash()" ng-click="openTrash()">
        <md-icon>delete</md-icon>
        <p>Корзина</p>
    </md-list-item>

</md-list>



<script type="text/ng-template" id="trash.html">

    <md-dialog aria-label="Корзина">
        <md-dialog-content layout-padding>
            <div layout="flex">
                <h2 class="md-title">Корзина</h2>
                <span flex></span>
                <md-button ng-click="closeDialog()" class="md-icon-button">
                    <md-icon>close</md-icon>
                </md-button>
            </div>

            <md-list>
                <md-list-item ng-repeat="service in disabledSc">
                    <p ng-bind="service.service_name"></p>
                    <md-button class="md-icon-button" ng-click="enableSc(service.id)">
                        <md-icon>restore</md-icon>
                        <md-tooltip>Восстановить</md-tooltip>
                    </md-button>
                </md-list-item>
            </md-list>
        </md-dialog-content>
    </md-dialog>

</script>