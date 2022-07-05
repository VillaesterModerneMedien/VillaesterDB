<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use CustomerNamespace\Component\Vmmdatabase\Administrator\Extension\VmmdatabaseComponent;
use CustomerNamespace\Component\Vmmdatabase\Administrator\Helper\AssociationsHelper;
use Joomla\CMS\Association\AssociationExtensionInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;

/**
 * The vmmdatabase service provider.
 * https://github.com/joomla/joomla-cms/pull/20217
 *
 * @since  __BUMP_VERSION__
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function register(Container $container)
	{
		$container->set(AssociationExtensionInterface::class, new AssociationsHelper);

		$container->registerServiceProvider(new CategoryFactory('\\CustomerNamespace\\Component\\Vmmdatabase'));
		$container->registerServiceProvider(new MVCFactory('\\CustomerNamespace\\Component\\Vmmdatabase'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\CustomerNamespace\\Component\\Vmmdatabase'));
		$container->registerServiceProvider(new RouterFactory('\\CustomerNamespace\\Component\\Vmmdatabase'));

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new VmmdatabaseComponent($container->get(ComponentDispatcherFactoryInterface::class));

				$component->setRegistry($container->get(Registry::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
				$component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
				$component->setAssociationExtension($container->get(AssociationExtensionInterface::class));
				$component->setRouterFactory($container->get(RouterFactoryInterface::class));

				return $component;
			}
		);
	}
};
