# magento2-locations
A Magento 2 extension built to help customers find different store locations fast and easily.

## Install with Composer (recommended)
- Include the repository: `composer require softwareforsapiens/magento2-locations
- Enable the extension: `php bin/magento --clear-static-content module:enable SFS_CountdownBanners
- Upgrade db schema: `php bin/magento setup:upgrade`
- Clear cache

## Install without Composer
- Download ZIP file of this extension
- Place all the files of the extension in you Magento 2 installation folder under `app/code/SFS/CountdownBanners`
- Enable the extension: `php bin/magento --clear-static-content module:enable SFS_CountdownBanners
- Upgrade db schema: `php bin/magento setup:upgrade`
- Clear cache

## Configuration
- Create new store locations in the admin panel under “Stores” > “Settings” > “Store Locations” - Store locations will appear on the front-end route <ecommerce-site>/stores
- You can enable/disable integration with Google Maps API to allow searching for nearest stores by location. A valid Google Maps API key is required, which you can obtain here: https://developers.google.com/maps/documentation/javascript/get-api-key
