<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Http;

use Cake\Controller\Controller;
use Cake\Event\EventDispatcherTrait;
use Cake\Event\EventListenerInterface;
use Cake\Http\ControllerFactory;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Routing\DispatcherFactory;
use Cake\Routing\Exception\MissingControllerException;
use Cake\Routing\Router;
use LogicException;

/**
 * This class provides compatibility with dispatcher filters
 * and interacting with the controller layers.
 *
 * Long term this should just be the controller dispatcher, but
 * for now it will do a bit more than that.
 */
class ActionDispatcher
{
    use EventDispatcherTrait;

    /**
     * Attached routing filters
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Controller factory instance.
     *
     * @var \Cake\Http\ControllerFactory
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param \Cake\Http\ControllerFactory|null $factory A controller factory instance.
     * @param \Cake\Event\EventManager|null $eventManager An event manager if you want to inject one.
     * @param array $filters The list of filters to include.
     */
    public function __construct($factory = null, $eventManager = null, array $filters = [])
    {
        if ($eventManager) {
            $this->eventManager($eventManager);
        }
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
        $this->factory = $factory ?: new ControllerFactory();
    }

    /**
     * Dispatches a Request & Response
     *
     * @param \Cake\Network\Request $request The request to dispatch.
     * @param \Cake\Network\Response $response The response to dispatch.
     * @return \Cake\Network\Response a modified/replaced response.
     */
    public function dispatch(Request $request, Response $response)
    {
        if (Router::getRequest(true) !== $request) {
            Router::pushRequest($request);
        }
        $beforeEvent = $this->dispatchEvent('Dispatcher.beforeDispatch', compact('request', 'response'));

        $request = $beforeEvent->data['request'];
        if ($beforeEvent->result instanceof Response) {
            return $beforeEvent->result;
        }

        // Use the controller built by an beforeDispatch
        // event handler if there is one.
        if (isset($beforeEvent->data['controller'])) {
            $controller = $beforeEvent->data['controller'];
        } else {
            $controller = $this->factory->create($request, $response);
        }

        $response = $this->_invoke($controller);
        if (isset($request->params['return'])) {
            return $response;
        }

        $afterEvent = $this->dispatchEvent('Dispatcher.afterDispatch', compact('request', 'response'));

        return $afterEvent->data['response'];
    }

    /**
     * Invoke a controller's action and wrapping methods.
     *
     * @param \Cake\Controller\Controller $controller The controller to invoke.
     * @return \Cake\Network\Response The response
     * @throws \LogicException If the controller action returns a non-response value.
     */
    protected function _invoke(Controller $controller)
    {
        $this->dispatchEvent('Dispatcher.invokeController', ['controller' => $controller]);

        $result = $controller->startupProcess();
        if ($result instanceof Response) {
            return $result;
        }

        $response = $controller->invokeAction();
        if ($response !== null && !($response instanceof Response)) {
            throw new LogicException('Controller actions can only return Cake\Network\Response or null.');
        }

        if (!$response && $controller->autoRender) {
            $response = $controller->render();
        } elseif (!$response) {
            $response = $controller->response;
        }

        $result = $controller->shutdownProcess();
        if ($result instanceof Response) {
            return $result;
        }

        return $response;
    }

    /**
     * Add a filter to this dispatcher.
     *
     * The added filter will be attached to the event manager used
     * by this dispatcher.
     *
     * @param \Cake\Event\EventListenerInterface $filter The filter to connect. Can be
     *   any EventListenerInterface. Typically an instance of \Cake\Routing\DispatcherFilter.
     * @return void
     * @deprecated This is only available for backwards compatibility with DispatchFilters
     */
    public function addFilter(EventListenerInterface $filter)
    {
        $this->filters[] = $filter;
        $this->eventManager()->on($filter);
    }

    /**
     * Get the connected filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
