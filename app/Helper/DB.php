<?php

namespace app\Helper;

use app\Helper\traits\Properties;
use Exception;
use PDO;

class DB
{
    use Properties;

    private $config_source = __DIR__ . '/../config.php';

    public function __construct($config_source = null)
    {
        if (!is_null($config_source)) {

            $this->config_source = $config_source;
        }

        $this->setupClass();

        $database = $this->config['connection']['mysql'];

        $dsn = "mysql:host={$database['host']};dbname={$database['database']};charset={$database['charset']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {

            $this->pdo = new PDO($dsn, $database['user'], $database['password'], $options);
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        } catch (\PDOException $error) {

            dd("Database Error Occured : " . $error->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    private function setupClass()
    {

        $this->setConfig();

        if ($this->table === null || empty($this->table)) {
            $this->setTable();
        }
    }

    private function setConfig()
    {
        $this->config = include $this->config_source;
    }

    private function setTable()
    {
        $class_name = \explode('\\', \get_called_class());

        $this->table = strtolower($class_name[count($class_name) - 1]);
    }

    public function _select(string $table = null, string $to_be_selected = "*"): object
    {

        if ($table === null) {

            $table = $this->table;
        }

        $this->query = "SELECT {$to_be_selected} FROM {$table}";

        return $this;
    }

    public function select($param = null)
    {
        $args = [];

        if (is_array($param))
            $args = $param;
        else {
            unset($param);
            $args = func_get_args();
        }


        $this->select_tables = $args;
        return $this;
    }

    public function from(string $table): object
    {
        $this->table = $table;
        return $this;
    }

    public function find($name, $value)
    {

        return $this->select()->where($name, $value)->first();
    }

    public function first()
    {
        $this->limit(1)->result();
        $this->fetchType = 'fetch';
        return $this->fetch();
    }

    protected function wheres(string $clause)
    {
        $this->where_clause[] = $clause;
        return $this;
    }

    public function where(string $name, $value, string $operator = "=")
    {

        $this->wheres("$name $operator :$name");

        if (strtolower($operator) == 'like') {
            $value = "%" . $value . "%";
        }

        $this->bind_arr[$name] = $value;

        return $this;
    }

    public function orWhere(string $name, $value, string $operator = "=")
    {

        $this->where_type = "OR";

        return $this->where($name, $value, $operator);
    }

    public function result()
    {
        $this->query = [];
        $this->query[] = "SELECT";

        if (empty($this->select_tables)) {

            $this->query[] = "*";
        } else {

            $this->query[] = join(" ,", $this->select_tables);
        }

        $this->query[] = "FROM";

        $this->query[] = $this->table;

        if (!empty($this->where_clause)) {

            $this->addWhereToQuery();
        }

        if (!is_null($this->limit)) {
            $this->query[] = "LIMIT";
            $this->query[] = $this->limit;
        }

        $this->query = join(" ", $this->query);

        $this->stmt = $this->pdo->prepare($this->query);

        $this->bindValues();

        $this->done();

        return $this;
    }

    protected function addWhereToQuery()
    {
        $this->query[] = "WHERE";

        $this->query[] = join(" {$this->where_type} ", $this->where_clause);

        return $this;
    }

    public function checkErrors()
    {
        $this->errors = $this->stmt->errorInfo();
        return $this->errors;
    }

    public function limit($limit = 1)
    {

        $this->limit = $limit;
        return $this;
    }

    public function get()
    {

        $this->result();

        return $this->fetch();
    }

    protected function fetch()
    {

        return $this->stmt->{($this->fetchType == 'fetchAll' ? 'fetchAll' : 'fetch')}($this->fetchMode);
    }

    public function all()
    {

        return $this->select()->get();
    }

    protected function bindValues()
    {

        foreach ($this->bind_arr as $key => $value) {
            $this->bind($key, $value);
        }
    }

    protected function bind($key, $value, $type = null)
    {

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($key, $value, $type);
    }

    public function create($data = [])
    {

        if (count($data) == 0)
            return;

        $query = "INSERT INTO {$this->table} (";

        $data_length = count($data);

        $i = 0;

        foreach ($data as $key => $value) {
            $query .= $key;

            if ($i == $data_length - 1) {
                $query .= ")";
            } else {
                $query .= " ,";
            }

            $i++;
        }

        $query .= " VALUES (";

        $i = 0;

        foreach ($data as $key => $value) {
            $query .= ':' . $key;

            if ($i == $data_length - 1) {
                $query .= ")";
            } else {
                $query .= " ,";
            }
            $i++;
        }

        $this->query = $query;

        $this->stmt = $this->pdo->prepare($this->query);


        foreach ($data as $key => $value) {
            $this->bind($key, $value);
        }

        return $this->done();
    }

    private function fieldsForAction($data = [])
    {

        $fields = [];

        foreach ($data as $key => $name) {

            $fields[] = "{$key} = :{$key}";

            $this->bind_arr[$key] = $name;
        }

        return join(' ,', $fields);
    }

    public function update($data = [])
    {

        if (count($data) < 1) {

            return false;
        }

        $this->query = [];

        $this->query[] = "UPDATE";

        $this->query[] = $this->table;

        $this->query[] = "SET";

        $fields = $this->fieldsForAction($data);

        $this->query[] = $fields;

        if (!empty($this->where_clause)) {

            $this->addWhereToQuery();
        } else {

            throw new Exception('No where clause on update db!');
        }

        $this->query = join(' ', $this->query);

        $this->stmt = $this->pdo->prepare($this->query);

        $this->bindValues();

        return $this->done();
    }

    public function delete()
    {

        $this->query = [];

        $this->query[] = "DELETE";
        $this->query[] = "FROM";

        $this->query[] = $this->table;

        if (!empty($this->where_clause)) {

            $this->addWhereToQuery();
        } else {

            throw new Exception('No where clause on delete db!');
        }

        $this->query = join(' ', $this->query);

        $this->stmt = $this->pdo->prepare($this->query);

        $this->bindValues();

        return $this->done();
    }

    public function insert($data = [])
    {

        $field = join(', ', array_keys($data));
        $param = ':' . join(', :', array_keys($data));

        $this->stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($field)
                                       VALUES ($param)");

        $this->bind_arr = $data;

        $this->bindValues();

        return $this->done();
    }

    private function done()
    {
        $this->where_clause = [];
        return $this->stmt->execute();
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
