<?php
namespace DB;
require_once('config/config.php');
require_once('error/Error.php');
require_once('message/Message.php');
class DB
{
	private $db;
	private $dbh;
	private $sql;
	private $stmt;
	private $isTransaction;
	
	public function __construct()
	{
		$dsn = 'mysql:dbname=' . DB_NAME . ';host=' . HOST;
		$options = array
		(
			\PDO::ATTR_PERSISTENT => true, 
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		);
		$this->dbh = new \PDO($dsn, USER, PASSWORD, $options);
	}
	
	private function setSQL($sql) { $this->sql = $sql; }
	private function setData($data) { $this->data = $data; }
	
	public function query($sql, $data = array())
	{
		try
		{
			$this->prepare($sql);
			$this->bindValues($data);
			return $this->stmt->execute();
		}
		catch(\Exception $e) { $this->showError($e); return false; }
	}
	
	public function insert($table, $data)
	{
		$fields = array_keys($data);

        $sql = 'INSERT INTO ' . $table . 
                '(' . implode(', ', $fields) . ') ' . 
                'VALUES ' . 
                '(:' . implode(', :', $fields) . ')';

        return $this->query($sql, $data);
	}
	
	public function select($table, $fields, $where = '', $data = array(), $limit = array())
	{
		$a_fields = array();
		if(is_array($fields))
		{
			foreach($fields as $key => $value)
			{
				if(is_string($key)) { array_push($a_fields, $key . ' AS ' . $value); }
				else { array_push($a_fields, $value); }
			}
			$fields = implode(', ', $a_fields);
		}
		
		$where = empty($where) ? '' : ' WHERE ' . $where;
		$limit = empty($limit) ? '' : ' LIMIT ' . implode(', ', $limit);
		$sql = 'SELECT ' . $fields . ' FROM ' . $table . $where . $limit;
		$this->query($sql, $data);
		return $this->fetchObjectAll();
	}
	
	public function update($table, $replacements, $where, $data = array())
	{
		$settes = array();
		foreach($replacements as $key => $value) { array_push($setters, $key . ' = :' . $key); }
		$_replacements = implode(', ', $settes);
		
		$sql = 'UPDATE ' . $table . ' SET ' . $_replacements . ' WHERE ' . $where;
		return $this->query($sql, $data);
	}
	
	public function delete($table, $where, $data = array())
	{
		$sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;
		return $this->query($sql, $data);
	}
	
	public function fetchArray() { return $this->fetch(\PDO::FETCH_ASSOC); }
    public function fetchArrayAll() { return $this->fetch(\PDO::FETCH_ASSOC); }
    public function fetchObject() { return $this->fetch(\PDO::FETCH_OBJ); }
    public function fetchObjectAll() { return $this->fetchAll(\PDO::FETCH_OBJ); }
    public function rowCount() { return $this->stmt->rowCount(); }
    public function lastInsertId(){ return $this->dbh->lastInsertId(); }
	
	/* Transacts */
	public function beginTransaction()
	{
		$this->isTransaction = true;
		$this->dbh->beginTransaction();
	}
	public function commit()
	{
		$this->isTransaction = false;
		$this->dbh->commit();
	}
	public function rollback()
	{
		$this->isTransaction = false;
		$this->dbh->rollback();
	}

	/* Privates */
	private function fetch($mode)
	{
		try
		{
			$this->stmt->setFetchMode($mode);
			return $this->stmt->fetch();
		}
		catch(\Exception $e) { $this->showError($e); }
	}
	
	private function fetchAll($mode)
	{
		try
		{
			$this->stmt->setFetchMode($mode);
			return $this->stmt->fetchAll();
		}
		catch(\Exception $e) { $this->showError($e); }
	}
	
	private function prepare($sql) { $this->stmt = $this->dbh->prepare($sql); }
	private function bindValues($data)
    {
        foreach($data as $key => $value)
        {
            switch(gettype($value))
            {
				case 'integer': $type = \PDO::PARAM_INT; $value = (integer)$value; break;
				case 'boolean': $type = \PDO::PARAM_BOOL; $value = (boolean)$value; break;
				case 'NULL': $type = \PDO::PARAM_NULL; break;
				default: $type = \PDO::PARAM_STR; $value = (string)$value; break;
            }
            $this->stmt->bindValue($key, $value, $type);
        }
    }
	
	private function showError(\Exception $e)
	{
		if($this->isTransaction && AUTO_ROLLBACK) { $this->isTransaction = false; $this->rollback(); }
		if(IS_PRODUCTION) { Error::show($e->getMessage()); die(); }
		else { throw new \Exception(Message::error()); }
	}
}