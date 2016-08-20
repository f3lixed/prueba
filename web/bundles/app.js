var prueba = angular
.module("prueba", ["ui.tree",
"ngResource",
"ngSanitize",
"ui.router",
"angularUtils.directives.dirPagination",
"ui.bootstrap.tpls",
"ui.bootstrap",
"checklist-model",
"multi-select",
'ngFileUpload'
])
.constant("ROOT", "/")
.constant("APP_NAME", "Prueba MVC")
.config(["$locationProvider",
"$urlRouterProvider",
"$httpProvider",
function ($locationProvider, $urlRouterProvider, $httpProvider) {
    // enable html5Mode for pushstate
    $locationProvider.hashPrefix("!")/*.html5Mode(true)*/;
    $urlRouterProvider.when('', '/');
    $httpProvider.interceptors.push(["$q",
    "$rootScope",
    function($q, $rootScope) {
        return {
            request: function(config) {
                $rootScope.$broadcast('REQUEST_START');
                return config;
            },
            response: function(response) {
               $rootScope.$broadcast('REQUEST_END');
               return response;
            },
            responseError: function(rejection) {
               $rootScope.$broadcast('REQUEST_END');
               return $q.reject(rejection);
            }
        };
    }]);
}]).run(["$rootScope",
"$timeout",
"APP_NAME",
function ($rootScope, $timeout, APP_NAME) {
    var state,
        lastDigestRun = new Date(),
        firstTime = false;
    $rootScope.today = new Date();

    $rootScope.$watch(function () {
        var now = new Date();
        if (now - lastDigestRun > 2*60*60*1000) {
            Auth.get({type: 'destroy'})
            .$promise.then(function () {
                window.location.reload();
        });
    }
    lastDigestRun = now;
});

$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
    var title = toState.data.title,
        pageTitle = toState.data.pageTitle || title,
        resolve = toState.data.resolve,
        param;
    state = toState.name;
    if (angular.isDefined(title)) {
        if (resolve) {
            toParams = resolve(toParams);
        }
        for (param in toParams) {
            title = title.replace("{"+param+"}", toParams[param]);
            pageTitle = pageTitle.replace("{"+param+"}", toParams[param]);
        }
        $rootScope.title = title + ' » ' + APP_NAME;
        $rootScope.pageTitle = pageTitle;
    }
    if (!firstTime) {
        $timeout(loadContent);
        firstTime = true;
    }
});

$rootScope.openCalendar = function($event, name) {
    $event.preventDefault();
    $event.stopPropagation();
    $rootScope.calendar = {};
    $rootScope.calendar[name] = true;
};

$rootScope.isActive = function(parent, states) {
    var found = false, i = 0, st, p;
    for (; st = states[i]; i++) {
        if (st === state) {
            found = true;
            break;
        }
    }
    if (found) {
        for (i=0; p = parent[i]; i++) {
            angular.element("#"+p).addClass("active");
        }
    }
    return found;
}
}]).directive('dsScrollTo', [function() {
    return {
        restrict: 'A',
        link: function(scope, $elm, attrs) {
            var idToScroll = attrs.dsScrollTo,
                $target;

            $elm.on('click', function() {
                $target = idToScroll? $("#"+idToScroll): $elm;
                $("body").animate({
                    scrollTop: $target.offset().top
                }, "slow");
            });
        }
    }
}]).directive('loadingMsg', [function() {
    return {
        template: '<div ng-show="pending" id="overlay"></div>',
        scope: {},
        link: function(scope, element, attrs) {
            scope.pending = 0;
            scope.$on('REQUEST_START', function() {
                scope.pending+=1;
            });
            scope.$on('REQUEST_END', function() {
                scope.pending-=1;
            });
        }
    };
}]).directive("dsAlert", [function() {
    return {
        restrict: "E",
        replace: true,
        templateUrl: "/copservir/web/bundles/directives/alert/ds-alert.tpl.html",
        scope: {
            type: "@",
            title: "@",
            content: "@",
            close: "&"
        }
    };
}]).factory("dsJqueryUtils", ["$http",
"REPORT_ROOT",
function ($http, REPORT_ROOT) {
    var publico = {};

    publico.print = function (url, send, config) {
        var promise;
        config = angular.extend({
            method: 'get',
            url: REPORT_ROOT+url
        }, config);
        send = config.method === 'get'? {params: send}: {data: send};
        angular.extend(config, send);
        promise = $http(config);
        promise.processing = true;

        promise.success(function (html) {
            var frame = $("#frame-ajax")[0],
                r = (frame.contentWindow || frame.contentDocument);
            r.document.body.innerHTML = html;
            var images = r.document.getElementsByTagName('img'),
                imagesLength = images.length,
                imagesCount = 0,
                loadCallback = function () {
                    imagesCount++;
                    if (imagesLength == imagesCount) {
                        r.print();
                    }
                 };

            if (imagesLength) {
                $(images).on("load", loadCallback)
                         .on("error", loadCallback);
            } else {
                r.print();
            }
        })['finally'](function () {
            promise.processing = false;
        });
        return promise;
    }

    publico.goTop = function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow", "swing");
    }

    return publico;
}]);
