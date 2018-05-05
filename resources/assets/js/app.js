require('angular-ui-bootstrap');

var app = angular.module('app', [
    'ui.bootstrap',
    'controllers.app',
    'controllers.categoryIndex',
    'controllers.categoryEdit',
    'controllers.attributeIndex'
]);

app.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);

require('./controllers/app.controller.js');
require('./controllers/categoryIndex.controller.js');
require('./controllers/categoryEdit.controller.js');
require('./controllers/attributeIndex.controller.js');
