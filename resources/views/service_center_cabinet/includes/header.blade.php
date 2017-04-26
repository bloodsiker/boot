<md-button hide-gt-md class="md-icon-button" ng-click="openSideMenu()">
    <md-icon>menu</md-icon>
</md-button>
<h1 class="md-toolbar-tools">FIXX ADMIN</h1>
<span flex></span>
<md-menu>
    <md-button class="md-icon-button" ng-mouseenter="$mdMenu.open()">
        <md-icon>account_circle</md-icon>
    </md-button>
    <md-menu-content width="4" ng-mouseleave="$mdMenu.close()">
        <md-menu-item>
            <md-button ng-click="null">
                <md-icon>settings</md-icon>
                Settings
            </md-button>
        </md-menu-item>
        <md-menu-item>
            <md-button ng-click="null">
                <md-icon>exit_to_app</md-icon>
                Logout
            </md-button>
        </md-menu-item>
    </md-menu-content>
</md-menu>
