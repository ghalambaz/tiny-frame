<?php
declare(strict_types=1);

namespace Core\Kernel;


use Core\Exception\LogicalException;
use Core\ResourceLoader\YamlLoader;
use Core\Routing\Exception\RouteNotFoundException;
use Core\Routing\RouteLoader;
use Core\Routing\RouteMatcher;
use Core\Routing\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function dirname;

/**
 * Class Application
 * @package Core\Kernel
 * @author Ali Ghalambaz
 */
class Application
{
    /**
     * @var Application
     */
    private static Application $app;
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;


    //implementing singlton pattern because we have one app per request!

    /**
     * Application constructor.
     */
    protected function __construct()
    {
    }


    /**
     * @return Application
     */
    public static function getInstance()
    {
        if (empty(self::$app)) {
            self::$app = new Application();
        }
        return self::$app;
    }

    public function init(ContainerInterface $container, ServerRequestFactoryInterface $serverRequestFactory)
    {
        $serverRequest = $serverRequestFactory->createFromGlobals();
        $this->container = $container;
        $this->container->registerService('server.request', function () use ($serverRequest) {
            return $serverRequest;
        });
        $this->container->registerService(
            'router', function () use ($serverRequest) {
            return new Router(
                APPLICATION_PATH . "/app/config/routing.yml",
                new RouteLoader(new YamlLoader()),
                new RouteMatcher()
            );
        });
        $this->container->registerService(
            'template.engine' , function () {
            $loader = new FilesystemLoader(APPLICATION_PATH . '/app/views/');
            $twig = new Environment($loader);
            return new TemplateEngine($twig);
        });
        $this->container->registerService(
            'view.manager' , function () {
            return new ViewManager();
        });
    }

    /**
     * @throws LogicalException
     */
    public function run()
    {
        if(empty($this->container))
            throw new LogicalException('Please initialize app first by calling init function');

        if (!$this->container->has('router'))
            throw new LogicalException('Router Is not exist in container');
        $router = $this->container->get('router');

        if (!$this->container->has('server.request'))
            throw new LogicalException('Server Request Is not exist in container');
        $request = $this->container->get('server.request');

        if (!$this->container->has('view.manager'))
            throw new LogicalException('How to send data and show you without view manager?');
        $viewManager = $this->container->get('view.manager');

        try {
            //now we check that the request is matched with our defined routes in yaml file?
            $route = $router->matchRequest($request);
            //maybe here better to ob_start(); and then flush it

            //now we found the route and need to call controller and method to run our logical part
            $reponse = $router->call($route, $this->container);

            //our code should return an response in twig template and we should render it by view manager!
            $viewManager->render($reponse);

        } catch (RouteNotFoundException $exception) {
            //we could have default page template
            $viewManager->renderPageNotFound(); // if response was implemented header status could change to 404
        }
    }
}