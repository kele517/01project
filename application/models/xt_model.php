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
    protected  $mPKid = 'id';

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

    public function get_by_where($where = '1=1', $field = '*', $tb = "", $limit = '')
    {
        if(empty($tb)){
            $tb = $this->mTable;
        }
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