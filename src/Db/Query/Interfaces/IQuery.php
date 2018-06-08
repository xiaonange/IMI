<?php
namespace Imi\Db\Query\Interfaces;

use Imi\Db\Interfaces\IDb;
use Imi\Db\Query\QueryOption;
use Imi\Db\Consts\LogicalOperator;
use Imi\Db\Query\Interfaces\IHaving;
use Imi\Db\Query\Interfaces\IResult;
use Imi\Db\Query\Interfaces\IBaseWhere;

/**
 * 查询器接口
 */
interface IQuery
{
	/**
	 * 获取所有操作的记录
	 * @return QueryOption
	 */
	public function getOption(): QueryOption;

	/**
	 * 设置操作记录
	 * @param QueryOption $options
	 * @return static
	 */
	public function setOption(QueryOption $option);

	/**
	 * 获取数据库操作对象
	 * @return IDb
	 */
	public function getDb(): IDb;

	/**
	 * 设置表名
	 * @param string $table 表名
	 * @param string $alias 别名
	 * @param string $database 数据库名
	 * @return static
	 */
	public function table(string $table, string $alias = null, string $database);

	/**
	 * 设置表名，使用SQL原生语句
	 * @param string $raw
	 * @return static
	 */
	public function tableRaw(string $raw);

	/**
	 * 设置表名，table()的别名
	 * @param string $table 表名
	 * @param string $alias 别名
	 * @param string $database 数据库名
	 * @return static
	 */
	public function from(string $table, string $alias = null, string $database = null);

	/**
	 * 设置表名，使用SQL原生语句
	 * @param string $raw
	 * @return static
	 */
	public function fromRaw(string $raw);

	/**
	 * 设置 distinct
	 * @param boolean $isDistinct 是否设置distinct
	 * @return static
	 */
	public function distinct($isDistinct = true);

	/**
	 * 指定查询字段
	 * @param string $fields 查询字段
	 * @return static
	 */
	public function field(...$fields);

	/**
	 * 指定查询字段，使用SQL原生语句
	 * @param string $raw
	 * @return static
	 */
	public function fieldRaw(string $raw);

	/**
	 * 设置 where 条件，一般用于 =、>、<、like等
	 * @param string $fieldName
	 * @param string $operation
	 * @param mixed $value
	 * @param string $logicalOperator
	 * @return static
	 */
	public function where(string $fieldName, string $operation, $value, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 where 条件，用原生语句
	 * @param string $raw
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereRaw(string $raw, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 where 条件，传入回调，回调中的条件加括号
	 * @param callable $callback
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereBrackets(callable $callback, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 where 条件，使用 IBaseWhere 结构
	 * @param IBaseWhere $where
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereStruct(IBaseWhere $where, string $logicalOperator = LogicalOperator::AND);

	/**
	 * where between $begin end $end
	 * @param string $fieldName
	 * @param mixed $begin
	 * @param mixed $end
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereBetween(string $fieldName, $begin, $end, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where between $begin end $end
	 * @param string $fieldName
	 * @param mixed $begin
	 * @param mixed $end
	 * @return static
	 */
	public function orWhereBetween(string $fieldName, $begin, $end);

	/**
	 * where not between $begin end $end
	 * @param string $fieldName
	 * @param mixed $begin
	 * @param mixed $end
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereNotBetween(string $fieldName, $begin, $end, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where not between $begin end $end
	 * @param string $fieldName
	 * @param mixed $begin
	 * @param mixed $end
	 * @return static
	 */
	public function orWhereNotBetween(string $fieldName, $begin, $end);

	/**
	 * 设置 where or 条件
	 * @param string $fieldName
	 * @param string $operation
	 * @param mixed $value
	 * @return static
	 */
	public function orWhere(string $fieldName, string $operation, $value);

	/**
	 * 设置 where or 条件，用原生语句
	 * @param string $where
	 * @return static
	 */
	public function orWhereRaw(string $where);

	/**
	 * 设置 where or 条件，传入回调，回调中的条件加括号
	 * @param callable $callback
	 * @return static
	 */
	public function orWhereBrackets(callable $callback);

	/**
	 * 设置 where or 条件，使用 IBaseWhere 结构
	 * @param IBaseWhere $where
	 * @return static
	 */
	public function orWhereStruct(IBaseWhere $where);

	/**
	 * where field in (list)
	 * @param string $fieldName
	 * @param array $list
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereIn(string $fieldName, $list, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where field in (list)
	 * @param string $fieldName
	 * @param array $list
	 * @return static
	 */
	public function orWhereIn(string $fieldName, $list);

	/**
	 * where field not in (list)
	 * @param string $fieldName
	 * @param array $list
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereNotIn(string $fieldName, $list, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where field not in (list)
	 * @param string $fieldName
	 * @param array $list
	 * @return static
	 */
	public function orWhereNotIn(string $fieldName, $list);

	/**
	 * where field is null
	 * @param string $fieldName
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereIsNull(string $fieldName, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where field is null
	 * @param string $fieldName
	 * @return static
	 */
	public function orWhereIsNull(string $fieldName);

	/**
	 * where field is not null
	 * @param string $fieldName
	 * @param string $logicalOperator
	 * @return static
	 */
	public function whereIsNotNull(string $fieldName, string $logicalOperator = LogicalOperator::AND);

	/**
	 * or where field is not null
	 * @param string $fieldName
	 * @return static
	 */
	public function orWhereIsNotNull(string $fieldName);

	/**
	 * join
	 * @param string $table 表名
	 * @param string $left 在 join b on a.id=b.id 中的 a.id
	 * @param string $operation 在 join b on a.id=b.id 中的 =
	 * @param string $right 在 join b on a.id=b.id 中的 b.id
	 * @param string $tableAlias 表别名
	 * @param IBaseWhere $where where条件
	 * @param string $type join类型，默认left
	 * @return static
	 */
	public function join(string $table, string $left, string $operation, string $right, string $tableAlias = null, IBaseWhere $where = null, string $type = 'left');

	/**
	 * join，使用SQL原生语句
	 * @param string $raw
	 * @return static
	 */
	public function joinRaw(string $raw);

	/**
	 * left join
	 * @param string $table 表名
	 * @param string $left 在 join b on a.id=b.id 中的 a.id
	 * @param string $operation 在 join b on a.id=b.id 中的 =
	 * @param string $right 在 join b on a.id=b.id 中的 b.id
	 * @param string $tableAlias 表别名
	 * @param IBaseWhere $where where条件
	 * @return static
	 */
	public function leftJoin(string $table, string $left, string $operation, string $right, string $tableAlias = null, IBaseWhere $where = null);

	/**
	 * right join
	 * @param string $table 表名
	 * @param string $left 在 join b on a.id=b.id 中的 a.id
	 * @param string $operation 在 join b on a.id=b.id 中的 =
	 * @param string $right 在 join b on a.id=b.id 中的 b.id
	 * @param string $tableAlias 表别名
	 * @param IBaseWhere $where where条件
	 * @return static
	 */
	public function rightJoin(string $table, string $left, string $operation, string $right, string $tableAlias = null, IBaseWhere $where = null);

	/**
	 * cross join
	 * @param string $table 表名
	 * @param string $left 在 join b on a.id=b.id 中的 a.id
	 * @param string $operation 在 join b on a.id=b.id 中的 =
	 * @param string $right 在 join b on a.id=b.id 中的 b.id
	 * @param string $tableAlias 表别名
	 * @param IBaseWhere $where where条件
	 * @return static
	 */
	public function crossJoin(string $table, string $left, string $operation, string $right, string $tableAlias = null, IBaseWhere $where = null);

	/**
	 * 排序
	 * @param string $field
	 * @param string $direction
	 * @return static
	 */
	public function order(string $field, string $direction = 'asc');

	/**
	 * 排序
	 * 支持的写法：
	 * 1. id desc, age asc
	 * 2. ['id'=>'desc', 'age'] // 缺省asc
	 * @param string|array $raw
	 * @return static
	 */
	public function orderRaw($raw);

	/**
	 * 设置分页
	 * 传入当前页码和每页显示数量，自动计算offset和limit
	 * @param int $page
	 * @param int $show
	 * @return static
	 */
	public function page($page, $show);

	/**
	 * 设置记录从第几个开始取出
	 * @param int $offset
	 * @return static
	 */
	public function offset($offset);
	
	/**
	 * 设置查询几条记录
	 * @param int $offset
	 * @return static
	 */
	public function limit($limit);

	/**
	 * group by
	 * @param string ...$groups
	 * @return static
	 */
	public function group(...$groups);

	/**
	 * group by，使用SQL原生语句
	 * @param string $raw
	 * @return static
	 */
	public function groupRaw(string $raw);

	/**
	 * 设置 having 条件
	 * @param string $fieldName
	 * @param string $operation
	 * @param mixed $value
	 * @param string $logicalOperator
	 * @return static
	 */
	public function having(string $fieldName, string $operation, $value, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 having 条件，用原生语句
	 * @param string $raw
	 * @param string $logicalOperator
	 * @return static
	 */
	public function havingRaw(string $raw, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 having 条件，传入回调，回调中的条件加括号
	 * @param callable $callback
	 * @param string $logicalOperator
	 * @return static
	 */
	public function havingBrackets(callable $callback, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 设置 having 条件，使用 IHaving 结构
	 * @param IHaving $having
	 * @param string $logicalOperator
	 * @return static
	 */
	public function havingStruct(IHaving $having, string $logicalOperator = LogicalOperator::AND);

	/**
	 * 绑定预处理参数
	 * @param string|int $name
	 * @param mixed $value
	 * @param int $dataType
	 * @return static
	 */
	public function bindValue($name, $value, $dataType = \PDO::PARAM_STR);

	/**
	 * 批量绑定预处理参数
	 * @param array $values
	 * @return static
	 */
	public function bindValues($values);

	/**
	 * 获取绑定预处理参数关系
	 * @return array
	 */
	public function getBinds();

	/**
	 * 查询所有记录，返回数组
	 * @return IResult
	 */
	public function select(): IResult;

	/**
	 * 插入数据
	 * @param array $data
	 * @return IResult
	 */
	public function insert($data): IResult;

	/**
	 * 更新数据
	 * @param array $data
	 * @return IResult
	 */
	public function update($data): IResult;

	/**
	 * 删除数据
	 * @return IResult
	 */
	public function delete(): IResult;
}