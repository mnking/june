<?php
class BaseModel extends Eloquent
{
    /**
     * Store column name in table. If change it in table, should change it here
     *
     * @var array
     */
    protected static $storeColumn = array(
        'key' => 'store_key',
        'value' => 'store_value',
    );

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }

    /**
     * Get store_value in table with store_key
     *
     * @param $key
     * @return mixed
     */
    public static function storeGet($key)
    {
        return parent::where(self::$storeColumn['key'],$key)->pluck(self::$storeColumn['value']);
    }

    /**
     * Get multi store_value in table with mul tistore_key
     *
     * @param $key
     * @return array
     */
    public static function storeMultiGet($key)
    {
        $params =  func_get_args();
        return parent::whereIn(self::$storeColumn['key'],$params)->lists(self::$storeColumn['value']);
    }

    /**
     * Update or Insert if not exists store_key
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public static function storePut($key,$value)
    {
        $table = parent::firstOrNew(array(self::$storeColumn['key']=>$key));
        $table->{self::$storeColumn['key']} = $key;
        $table->{self::$storeColumn['value']} = $value;
        return $table->save();
    }

    /**
     * Delete a row with store_key
     *
     * @param $key
     * @return int
     */
    public static function storeDelete($key)
    {
        return parent::where(self::$storeColumn['key'],$key)->delete();
    }
}