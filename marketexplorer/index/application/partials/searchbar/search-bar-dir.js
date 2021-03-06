app.directive('searchBar', [
    'config',
    '$http',
    'regionListFact', 
    'marketLookupFact',
    '$filter',
    '$timeout',
    '$interval',
    function(config, $http, regionListFact, marketLookupFact, $filter, $timeout, $interval) {
        "use strict";

        return {
            templateUrl: config.dist + '/partials/searchbar/search-bar-view.html',
            restrict: 'E',
            scope: {
                item: '=',
                region: '=',
                buyorders: '=',
                sellorders: '=',
                time: '='
            },
            controller: ['$scope', function($scope) {
                var updateData,
                    countdown,
                    frequency = 310000,
                    interval  = 1000;

                $scope.search = {
                    region: 10000002,
                    item: ''
                };

                $scope.regions = [];
                getAllRegions();

                $scope.$watch('search.region', function(newi, old) {
                    if (newi) {
                        $timeout.cancel(updateData);
                        $interval.cancel(countdown);
                        $scope.region = newi;
                        updateItem($scope.item);
                    }
                });

                $scope.$watch('item', function(newValue, oldValue) {
                    $timeout.cancel(updateData);
                    $interval.cancel(countdown);
                    updateItem(newValue);
                }, true);

                $scope.getItems = function(val) {
                    return $http.get(config.autocomplete, {
                        params: {
                            term: val
                        }
                    })
                    .then(function(response) {
                        return response.data.map(function(item){
                            return item;
                        });
                    });
                };

                function updateItem(newValue) {
                    if (newValue.id) {
                        update(true);
                        $scope.search.item = newValue.name;
                    }
                }

                $scope.itemSelected = function($item) {
                    $scope.item = {
                        name: $item.value,
                        id: $item.id
                    };
                };

                function getAllRegions() {
                    regionListFact
                    .getAll()
                    .then(function(result) {
                        //console.log(result);
                        angular.forEach(result, function(cValue, cKey) {
                            if (cValue.id < 11000000) {
                                $scope.regions.push(cValue);
                            }
                        });
                        $scope.isLoadedRegions = true;
                    });
                }

                function getItemOrders(id) {
                    //sell
                    marketLookupFact
                    .queryItem($scope.search.region, 'sell', id)
                    .then(function(responseSell) {
                        //$scope.sellorders = response;
                        var totalSell = 0;
                        angular.forEach(responseSell, function(cValue, cKey) {
                            totalSell += cValue.volume;
                        });
                        $scope.sellorders.total = totalSell;
                        $scope.sellorders.items = $filter('orderBy')(responseSell, 'price');

                        // recent orders
                        $http.get(config.crest.base + 'time/', {})
                        .then(function(response) {
                            var time = response.data.time;
                            var oneHourAgo = moment(time).subtract(1, 'hour');

                            $scope.sellorders.recent = 0;
                            angular.forEach($scope.sellorders.items, function(cValue, cKey) {
                                if (moment(cValue.issued).isAfter(oneHourAgo)) {
                                    $scope.sellorders.recent++;
                                }
                            });
                        });
                    })
                    .catch(function(error) {
                        console.error(error.stack);
                    });

                    //buy
                    marketLookupFact
                    .queryItem($scope.search.region, 'buy', id)
                    .then(function(responseBuy) {
                        var totalBuy = 0;
                        angular.forEach(responseBuy, function(cValue, cKey) {
                            totalBuy += cValue.volume;
                        });
                        $scope.buyorders.total = totalBuy;
                        $scope.buyorders.items = $filter('orderBy')(responseBuy, '-price');

                        // recent
                        $http.get(config.crest.base + 'time/', {})
                        .then(function(response) {
                            var time = response.data.time;
                            var oneHourAgo = moment(time).subtract(1, 'hour');

                            //recent orders
                            $scope.buyorders.recent = 0;
                            angular.forEach($scope.buyorders.items, function(cValue, cKey) {
                                if (moment(cValue.issued).isAfter(oneHourAgo)) {
                                    $scope.buyorders.recent++;
                                }
                            });
                        });
                    })
                    .catch(function(error) {
                        console.error(error.stack);
                    });
                }

                // update data every 5 mins automatically
                function update(init) {
                    var updateTimer  = function() {
                        $scope.time -= 1;
                    };

                    if (init) {
                        $scope.time = frequency / interval;
                        getItemOrders($scope.item.id);
                        countdown = $interval(updateTimer, interval);
                    }
                    updateData = $timeout(function() {
                        $interval.cancel(countdown);
                        $scope.time = frequency / interval;
                        getItemOrders($scope.item.id);
                        countdown = $interval(updateTimer, interval);
                        update();
                    }, frequency);
                }
            }],

            link: function() {
            }
        };
    }
]);