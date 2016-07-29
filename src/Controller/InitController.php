<?php

namespace T4web\Profiler\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Sql;

class InitController extends AbstractActionController
{
    /**
     * @var DbAdapter
     */
    private $dbAdapter;

    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function onDispatch(MvcEvent $e)
    {
        if (!$e->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console!');
        }

        $table = new Ddl\CreateTable('profiler');
        $table->addColumn(new Ddl\Column\Integer('id', false, null, ['autoincrement' => true]));
        $table->addColumn(new Ddl\Column\Varchar('method', 4));
        $table->addColumn(new Ddl\Column\Varchar('uri', 500));
        $table->addColumn(new Ddl\Column\Integer('responce_code', false, null));
        $table->addColumn(new Ddl\Column\Integer('execution_time', false, null));
        $table->addColumn(new Ddl\Column\Text('timers'));
        $table->addConstraint(new Ddl\Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query($sql->buildSqlString($table), DbAdapter::QUERY_MODE_EXECUTE);
        } catch (\Exception $e) {
            // currently there are no db-independent way to check if table exists
            // so we assume that table exists when we catch exception
        }
    }
}
