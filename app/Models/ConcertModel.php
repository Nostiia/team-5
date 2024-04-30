<?php
namespace App\Models;

use CodeIgniter\Model;

class ConcertModel extends Model
{
    protected $table = 'concerts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; # db takes care of it
    protected $returnType = 'object'; # 'object' or 'array'
    protected $useSoftDeletes = false; # true if you expect to recover data
# Fields that can be set during save, insert, or update methods
    protected $allowedFields = ['user_id', 'city', 'concert_data', 'link', 'name'];
    protected $useTimestamps = false; # no timestamps on inserts and updates
# Do not use validations rules (for the time being...)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    public function getConcertsByMusician($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }

    public function getConcertsByMonth($month)
    {
        $this->select('*');
        $this->where('MONTH(concert_data)', $month);
        return $this->findAll();
    }
}