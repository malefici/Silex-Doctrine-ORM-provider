<?php
/**
 * @author	  KitCat <sir.malefici@gmail.com>
 * @license	 http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link		http://malefici.com
 */
namespace KitCat\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

use \Doctrine\ORM\Configuration;
use \Doctrine\ORM\EntityManager;
use \Doctrine\Common\EventManager;

class DoctrineORMServiceProvider implements ServiceProviderInterface {
	public function register(Application $app) {
		$app['doctrine_orm.em'] = $app->share(function($app) {
			
			$config = new Configuration;
			
			$config->setMetadataCacheImpl($app['doctrine_orm.cache']);
			$config->setQueryCacheImpl($app['doctrine_orm.cache']);
			
			$config->setMetadataDriverImpl($app['doctrine_orm.metadata_driver']);
			
			$config->setProxyDir($app['doctrine_orm.proxy_dir']); 
			$config->setProxyNamespace($app['doctrine_orm.proxy_namespace']);
			$config->setAutoGenerateProxyClasses(false);

			$em = EntityManager::create($app['doctrine_orm.connection_parameters'], $config, new EventManager);
			
			return $em;
		});
	}

	public function boot(Application $app) {
		
	}
}

?>
