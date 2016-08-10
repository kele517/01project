<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 15:12
 */
class XT_Model extends CI_Model
{
    protected  $mTable;
    protected  $mPkId = 'id';

    public function __construct()
    {
        $this->db = _get_db('default');
    }

    public function prefix()
    {
        return $this->db->dbprefix;
    }

    public function execute($sql)
    {
        return $this->db->query($sql);
    }

    public function get_by_where($where = '1=1', $fields = '*', $tb = "", $limit = '', $order_by = '')
    {
        if(empty($tb)){
            $tb = $this->mTable;
        }
        $result = $this->db->select($fields)
            ->from($tb)
            ->where($where)
            ->limit($limit)
            ->order_by($order_by)
            ->get()
            ->result_array();
        return $result;
    }

    /**
     *
     * @param int $page           当前页数     默认为1
     * @param int $pagesize       每页记录数   默认为10
     * @param array $where        查询条件     默认为空
     * @param string $fields      查询字段值
     * @param string $order_by    查询排序
     * @param string $tb          查询时涉及到的表
     * @return mixed
     */
    public function fetch_page($page = 1, $pagesize = 10, $where = array(), $fields = '*', $order_by = '', $tb = '')
    {
        if (!$tb) $tb = $this->mTable;
        $order_by = $order_by ? $order_by : $this->mPkId . ' DESC';
        $fields_count = 'COUNT(1) AS count';
        $this->db->select($fields_count, FALSE)
            ->from($tb);
        if(is_array($where)) {
            foreach ($where as $key => $val) {
                if ($key{0} == '@' && is_array($val)) {// array('@where'=>array('a'=>1,'b'=>1))
                    $key = substr($key, 1);
                    foreach ($val as $k => $v) {
                        $this->db->$key($k, $v);
                    }
                    continue;
                }
                if (is_array($val)) {
                    $this->db->where_in($key, $val);
                } else {
                    $bAuto = true;
                    if ($tb)
                        $bAuto = false;
                    $this->db->where($key, $val, $bAuto);
                }
            }
        }else{
            $this->db->where($where);
        }
        $result = $this->db->get()->row_array();

        $num = $result['count'];
        $result['rows'] = array();
        if ($num > 0) {
            $sql = $this->db->last_query();
            $sql = str_replace($fields_count, $fields, $sql);
            $sql .= ' ORDER BY ' . $order_by;
            $sql .= ' LIMIT ' . (($page - 1) * $pagesize) . ',' . $pagesize;
            $result['rows'] = $this->db->query($sql)->result_array();
        }
        return $result;
    }
    /**
     * 数据库插入方法
     * insert()普通插入
     * insert_update($data)  如果您指定了ON DUPLICATE KEY UPDATE，并且插入行后会导致在一个UNIQUE索引或PRIMARY KEY中出现重复值，则执行旧行UPDATE
     *                       如果行作为新记录被插入，则受影响行的值为1；如果原有的记录被更新，则受影响行的值为2。
     * insert_ignore($data)  如果是用主键primary或者唯一索引unique区分了记录的唯一性,避免重复插入记录可以使用
     */
    public function insert(){
        $sql = $this->db->insert_string($this->mTable, $data);
        return $this->execute($sql);
    }
    public function insert_update($data){
        $sql = $this->db->insert_string($this->mTable, $data);
        $update = array();
        foreach ($data as $key => $val) {
            $update[] = $key . '=' . $this->db->escape($val);
        }
        $sql .= ' ON duplicate KEY UPDATE ' . join(',', $update);

        return $this->execute($sql);
    }

    public function insert_ignore()
    {
        $sql = $this->db->insert_string($this->mTable, $data);
        $sql = 'INSERT IGNORE ' . ltrim($sql, 'INSERT');
        $this->exectue($sql);

        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        if(!$where)
            return false;
        $this->each($data);
        $this->db->update($this->mTable, $data);

        return $this->db->affected_rows();
    }

    public function delete($where)
    {
        $this->each($where);
        $this->db->delete($this->mTable);
    }

    public function each($data){
        if(is_array($data)){
            foreach($data as $key => $val){
                if(is_array($val))
                    $this->db->where_in($key, $val);
                else
                    $this->db->where($val);
            }
        }else{
            $this->db->where($data);
        }
    }
}