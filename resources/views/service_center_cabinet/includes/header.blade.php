<md-button hide-gt-md class="md-icon-button" ng-click="openSideMenu()">
    <md-icon>menu</md-icon>
</md-button>
<h1 class="md-toolbar-tools">service_name</h1>
<span flex></span>
<md-menu>
    <md-button class="md-icon-button" ng-mouseenter="$mdMenu.open()">
        <md-icon>menu</md-icon>
    </md-button>
    <md-menu-content width="4" ng-mouseleave="$mdMenu.close()">
        <md-menu-item>
            <md-button ng-href="{{ route('main') }}" ng-click="null">
                <md-icon>home</md-icon>
                На главную
            </md-button>
        </md-menu-item>
        <md-menu-item>
            <md-button ng-href="{{ route('catalog') }}" ng-click="null">
                <md-icon>list</md-icon>
                В каталог
            </md-button>
        </md-menu-item>
        <md-menu-item>
            <md-button ng-href="{{ route('diagnostics') }}" ng-click="null">
                <md-icon>find_replace</md-icon>
                К диагностике
            </md-button>
        </md-menu-item>
        <md-divider></md-divider>
        <md-menu-item>
            <md-button ng-href="{{ route('cabinet.settings') }}" ng-click="null">
                <md-icon>settings</md-icon>
                Настройки
            </md-button>
        </md-menu-item>
        <md-menu-item>
            <md-button ng-href="{{ route('cabinet.logout') }}" ng-click="null">
                <md-icon>exit_to_app</md-icon>
                Выйти
            </md-button>
        </md-menu-item>
    </md-menu-content>
</md-menu>
