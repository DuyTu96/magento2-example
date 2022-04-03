# install
```
php bin/magento setup:install \
--base-url=http://magento2.local \
--db-host=localhost \
--db-name=magento2 \
--db-user=admin \
--db-password=admin4321 \
--admin-firstname=admin \
--admin-lastname=admin \
--admin-email=admin@admin.com \
--admin-user=admin \
--admin-password=admin123 \
--language=en_US \
--currency=USD \
--timezone=America/Chicago \
--use-rewrites=1 \
--search-engine=elasticsearch7 \
--elasticsearch-host=localhost \
--elasticsearch-port=9200
```

# cmd

```
php bin/magento indexer:reindex
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
php bin/magento cache:flush

php bin/magento module:disable Magento_TwoFactorAuth

php bin/magento indexer:reindex; php bin/magento setup:upgrade; php bin/magento setup:static-content:deploy -f; php bin/magento cache:flush 
```

```
sudo php bin/magento setup:upgrade
sudo php bin/magento setup:di:compile
sudo php bin/magento setup:static-content:deploy -f
sudo php bin/magento indexer:reindex
sudo php bin/magento cache:clean
sudo php bin/magento cache:flush
sudo chmod -R 777 pub/ var/ generated/
```

```
sudo php bin/magento setup:upgrade; sudo php bin/magento setup:di:compile; sudo php bin/magento setup:static-content:deploy -f; sudo php bin/magento indexer:reindex; sudo php bin/magento cache:clean; sudo php bin/magento cache:flush; sudo chmod -R 777 pub/ var/ generated/;
```

```
sudo php bin/magento setup:upgrade; sudo php bin/magento cache:flush; sudo chmod -R 777 pub/ var/ generated/
```
```
sudo php bin/magento setup:upgrade; sudo chmod -R 777 pub/ var/ generated/
```
```
sudo php bin/magento setup:static-content:deploy -f; sudo php bin/magento cache:flush; sudo chmod -R 777 pub/ var/ generated/
```

# sql
```
INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`, `updated_at`) VALUES (NULL, "default", "0", "web/secure/base_static_url", "http://localhost/magento2/pub/static/", current_timestamp());
INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`, `updated_at`) VALUES (NULL, "default", "0", "web/unsecure/base_static_url", "http://localhost/magento2/pub/static", current_timestamp());
INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`, `updated_at`) VALUES (NULL, "default", "0", "web/secure/base_media_url", "http://localhost/magento2/pub/media", current_timestamp());
INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`, `updated_at`) VALUES (NULL, "default", "0", "web/unsecure/base_media_url", "http://localhost/magento2/pub/media", current_timestamp());
```

# fix Gd2.php vendor/magento/framework/Image/Adapter/Gd2.php

```
    private function validateURLScheme(string $filename) : bool
    {
        $allowed_schemes = ['ftp', 'ftps', 'http', 'https'];
        $url = parse_url($filename);
        if ($url && isset($url['scheme']) && !in_array($url['scheme'], $allowed_schemes) && !file_exists($filename)) {
            return false;
        }

        return true;
    }
```

# fix css vendor/magento/framework/View/Element/Template/File/Validator.php

```
    $realPath = str_replace('\\', '/',$this->fileDriver->getRealPath($path));
```

```
sudo chmod -R 777 var/ pub/ generated/
```
