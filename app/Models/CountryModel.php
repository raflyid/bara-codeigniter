<?php namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
	protected $table = 'country';
	protected $primaryKey = 'country_id';

	public function getCountry()
	{
		$query = $this->db->table($this->table)
		->get();
		return $query->getResult();
	}

	public function getCountryDetail($id)
	{
		$query = $this->db->table($this->table)
		->join('currency', 'country.currency_id=currency.currency_id', 'left')
		->join('language', 'country.lang_id=language.lang_id', 'left')
		->where($this->primaryKey, $id)
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getCountryById($id)
	{
		$query = $this->db->table($this->table)
		->where($this->primaryKey, $id)
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getLastYearPopulation($id)
	{
		$query = $this->db->table('population')
		->where($this->primaryKey, $id)
		->orderBy('population_year', 'DESC')
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getCurrency()
	{
		$query = $this->db->table('currency')
		->where('currency_status', '1')
		->get();
		return $query->getResult();
	}

	public function getLanguage()
	{
		$query = $this->db->table('language')
		->where('lang_status', '1')
		->get();
		return $query->getResult();
	}

	public function getCountryByField($field, $record)
	{
		$query = $this->db->table($this->table)
		->where($field, $record)
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getCurrencyByField($field, $record)
	{
		$query = $this->db->table('currency')
		->where($field, $record)
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getLanguageByField($field, $record)
	{
		$query = $this->db->table('language')
		->where($field, $record)
		->limit(1)
		->get();
		return $query->getRow();
	}

	public function getCountryId()
	{
		$lastId = $this->db->table($this->table)
		->select('MAX(RIGHT(`country_id`, 7)) AS last_id')
		->get();
		$lastMidId = $this->db->table($this->table)
		->select('MAX(MID(`country_id`, 3, 2)) AS last_mid_id')
		->get()
		->getRow()
		->last_mid_id;
		$midId = date('y');
		$char = "C1".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
	}

	public function insertCountry($data)
	{
		$this->db->table($this->table)
		->insert($data);
	}

	public function updateCountry($id, $data)
	{
		$this->db->table($this->table)
		->where($this->primaryKey, $id)
		->update($data);
	}

	public function deleteCountry($id)
	{
		$this->db->table($this->table)
		->where($this->primaryKey, $id)
		->delete();
	}
}
