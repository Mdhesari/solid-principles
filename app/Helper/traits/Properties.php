<?php

namespace app\Helper\traits;

trait Properties
{

    protected $pdo = null;

    protected $table = null;

    protected $fetchType = 'fetchAll';

    protected $fetchMode = \PDO::FETCH_OBJ;

    protected $select_tables = [];

    protected $config = null;

    protected $stmt = null;

    protected $errros = [];

    protected $data = [];

    protected $query = [];

    protected $bind_arr = [];

    protected $where_clause = [];

    protected $where_type = "AND";

    protected $limit = null;

}
