<md-button hide-gt-md class="md-icon-button" ng-click="openSideMenu()">
    <md-icon>menu</md-icon>
</md-button>
<h1 class="md-toolbar-tools">service_name</h1>
<span flex></span>


<md-button class="md-icon-button" ng-href="{{ route('main') }}" ng-click="null">
    <md-icon>home</md-icon>
    <md-tooltip md-direction="bottom">На главную</md-tooltip>
</md-button>
<md-button class="md-icon-button" ng-href="{{ route('catalog') }}" ng-click="null">
    <md-icon>assignment</md-icon>
    <md-tooltip md-direction="bottom">В каталог</md-tooltip>
</md-button>
<md-button class="md-icon-button" ng-href="{{ route('diagnostics') }}" ng-click="null">
    <md-icon>build</md-icon>
    <md-tooltip md-direction="bottom">К диагностике</md-tooltip>
</md-button>


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
                <md-icon>assignment</md-icon>
                В каталог
            </md-button>
        </md-menu-item>
        <md-menu-item>
            <md-button ng-href="{{ route('diagnostics') }}" ng-click="null">
                <md-icon>build</md-icon>
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
