<?php

namespace TestIoc\Models;

use Framework\Models\Model;

class Program extends Model
{
    protected $table = 'slabeste_programs';
    public $tableKey = "id";
    public $id;
    public $regdate;
    public $program_name;
    public $program_tag;
    public $program_price;
    public $program_sales_page;
    public $program_status;
    public $program_type;
    public $program_image;
    public $main_page;
    public $discount_code;
    public $discount_price;
    public $plan_id;


}
