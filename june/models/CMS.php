<?php
class CMS extends BaseModel
{
    protected $table = 'cms';
    protected $fillable = array('store_key','store_value');
    public $timestamps = false;
}