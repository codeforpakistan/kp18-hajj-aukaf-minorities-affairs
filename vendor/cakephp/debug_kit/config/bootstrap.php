<?php
/**
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Core\Plugin as CorePlugin;
use Cake\Datasource\ConnectionManager;
use Cake\Event\EventManager;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\Routing\DispatcherFactory;
use DebugKit\DebugSql;
use DebugKit\Middleware\DebugKitMiddleware;
use DebugKit\Panel\DeprecationsPanel;
use DebugKit\Routing\Filter\DebugBarFilter;
use DebugKit\ToolbarService;

$service = new ToolbarService(EventManager::instance(), (array)Configure::read('DebugKit'));

if (!$service->isEnabled() || php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg') {
    return;
}

if (!empty($service->getConfig('panels')['DebugKit.Deprecations'])) {
    $previousHandler = set_error_handler(
        function ($code, $message, $file, $line, $context = null) use (&$previousHandler) {
            if ($code == E_USER_DEPRECATED || $code == E_DEPRECATED) {
                DeprecationsPanel::addDeprecatedError(compact('code', 'message', 'file', 'line', 'context'));

                return;
            }
            if ($previousHandler) {
                return $previousHandler($code, $message, $file, $line, $context);
            }
        }
    );
}

$hasDebugKitConfig = ConnectionManager::getConfig('debug_kit');
if (!$hasDebugKitConfig && !in_array('sqlite', PDO::getAvailableDrivers())) {
    $msg = 'DebugKit not enabled. You need to either install pdo_sqlite, ' .
        'or define the "debug_kit" connection name.';
    Log::warning($msg);

    return;
}

if (!$hasDebugKitConfig) {
    ConnectionManager::setConfig('debug_kit', [
        'className' => 'Cake\Database\Connection',
        'driver' => 'Cake\Database\Driver\Sqlite',
        'database' => TMP . 'debug_kit.sqlite',
        'encoding' => 'utf8',
        'cacheMetadata' => true,
        'quoteIdentifiers' => false,
    ]);
}

if (!CorePlugin::getCollection()->get('DebugKit')->isEnabled('routes')) {
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'routes.php';
}

$appClass = Configure::read('App.namespace') . '\Application';
if (class_exists($appClass)) {
    EventManager::instance()->on('Server.buildMiddleware', function ($event, $queue) use ($service) {
        $middleware = new DebugKitMiddleware($service);
        $queue->insertAt(0, $middleware);
    });
} else {
    // Setup dispatch filter
    $debugBar = new DebugBarFilter(EventManager::instance(), (array)Configure::read('DebugKit'));
    $debugBar->setup();
    DispatcherFactory::add($debugBar);
}

if (!function_exists('sql')) {
    /**
     * Prints out the SQL statements generated by a Query object.
     *
     * This function returns the same variable that was passed.
     * Only runs if debug mode is enabled.
     *
     * @param Query $query Query to show SQL statements for.
     * @param bool $showValues Renders the SQL statement with bound variables.
     * @param bool|null $showHtml If set to true, the method prints the debug
     *    data in a browser-friendly way.
     * @return Query
     */
    function sql(Query $query, $showValues = true, $showHtml = null)
    {
        return DebugSql::sql($query, $showValues, $showHtml, 1);
    }
}

if (!function_exists('sqld')) {
    /**
     * Prints out the SQL statements generated by a Query object and dies.
     *
     * Only runs if debug mode is enabled.
     * It will otherwise just continue code execution and ignore this function.
     *
     * @param Query $query Query to show SQL statements for.
     * @param bool $showValues Renders the SQL statement with bound variables.
     * @param bool|null $showHtml If set to true, the method prints the debug
     *    data in a browser-friendly way.
     * @return void
     */
    function sqld(Query $query, $showValues = true, $showHtml = null)
    {
        DebugSql::sqld($query, $showValues, $showHtml, 2);
    }
}
