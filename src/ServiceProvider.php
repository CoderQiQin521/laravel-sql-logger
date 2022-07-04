<?php
/**
 *
 * User: Administrator
 * Date: 2022/7/5 6:54
 * Email: <coderqiqin@aliyun.com>
 **/

namespace CoderQiQin\LaravelSqlLogger;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/config/sql-logger.php' => config_path('sql-logger.php'),
//        ], 'sql-logger');
        if (!$this->app['config']->get('app.debug')) {
            return;
        }

        DB::listen(function (QueryExecuted $query) {
            $sqlWithPlaceholders = str_replace(['%', '?'], ['%%', '%s'], $query->sql);

            $bindings = $query->connection->prepareBindings($query->bindings);
            $pdo = $query->connection->getPdo();
            $realSql = $sqlWithPlaceholders;
            $duration = $this->formatDuration($query->time / 1000);

            if (count($bindings) > 0) {
                $realSql = vsprintf($sqlWithPlaceholders, array_map([$pdo, 'quote'], $bindings));
            }

            Log::channel(config('logging.channels.query'))->debug(sprintf('[%s] %s | %s: %s', $duration, $realSql, request()->method(), request()->getRequestUri()));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    private function formatDuration($seconds)
    {
        if ($seconds < 0.001) {
            return round($seconds * 1000000) . 'μs';
        } elseif ($seconds < 1) {
            return round($seconds * 1000, 2) . 'ms';
        }

        return round($seconds, 2) . 's';
    }
}
