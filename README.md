# Mage2 Module Shulgin Headerstrip

    ``shulgin/module-headerstrip``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities


## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Shulgin`
 - Enable the module by running `php bin/magento module:enable Shulgin_Headerstrip`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require shulgin/module-headerstrip`
 - enable the module by running `php bin/magento module:enable Shulgin_Headerstrip`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - is_active (options/general/is_active)


## Specifications

 - Model
	- strip

 - Cache
	- Headerstrip - headerstrip_cache_tag > Shulgin\Headerstrip\Model\Cache\Headerstrip


## Attributes



