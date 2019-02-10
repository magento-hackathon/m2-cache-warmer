require([
    'mage/storage'
], function (storage) {
    'use strict';
    const data = {
        route: location.pathname
    };
    storage.put(
        'rest/V1/increment-popularity',
        JSON.stringify(data)
    );
});
