<?php

namespace SudwestFryslan\OpenGovernmentPublications;

class Plugin
{
    protected Container $container;

    public function __construct(Container $container = null)
    {
        $this->container = $container ?: new Container();
        // And this is were the magic happens ( ͡° ͜ʖ ͡°)
        $this->container->set(Container::class, fn($container) => $container);

        $config = array_merge(
            require dirname(__DIR__) . '/config/container.php',
            require dirname(__DIR__) . '/config/config.php',
        );

        foreach ($config as $abstract => $factory) {
            $this->container->set($abstract, $factory);
        }

        $GLOBALS['ogpcontainer'] = $this->container;
    }

    public function boot(): void
    {
        $this->container->get(Init::class)->register();

        $this->registerServiceProviders();

        $this->loadTextDomain();

        register_activation_hook($this->container->get('plugin.file'), [$this, 'activation']);

        register_deactivation_hook($this->container->get('plugin.file'), [$this, 'deactivation']);
    }

    protected function registerServiceProviders(): void
    {
        $this->container->get(Providers\RestRouteProvider::class)->register();
        $this->container->get(Providers\ImportProvider::class)->register();
        $this->container->get(Providers\PostTypeProvider::class)->register();
        $this->container->get(Providers\SettingsProvider::class)->register();
        $this->container->get(Providers\AdminMenuProvider::class)->register();
        $this->container->get(Providers\MetaboxProvider::class)->register();
    }

    protected function activation(): void
    {
        $this->container->get(Services\EventService::class)->schedule();
        $this->container->get(Init::class)->importOrganizations();
    }

    public function deactivation(): void
    {
        // Do something on deactivation
    }

    protected function loadTextDomain(): void
    {
        load_plugin_textdomain(
            'open-govpub',
            false,
            basename($this->container->get('plugin.path')) . '/languages'
        );
    }
}
