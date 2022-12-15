<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 6/26/15
 * Time: 7:10 AM
 */
trait DatabaseTransactionTrait
{


    /**
     * Begin a new database transaction.
     *
     * @setUp
     */
    public function beginTransaction()
    {
        if (!$this->app) {
            $this->app = $this->createApplication();
        }
        $this->artisan('migrate:refresh');
//        $this->app['db']->beginTransaction();
    }

    /**
     * Rollback the transaction.
     *
     * @tearDown
     */
    public function rollbackTransaction()
    {
//        $this->app['db']->rollback();
    }

}