require([
    'mage/storage'
], function (storage) {
    'use strict';
    storage.put(
        '/rest/V1/increment-popularity',
        JSON.stringify({
            route: location.pathname
        })
    );
});
