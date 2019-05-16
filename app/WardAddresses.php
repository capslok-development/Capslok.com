<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WardAddresses extends Model
{
    protected $table = 'ward_addresses';
    protected $primaryKey = 'id';

    public function ward() {
        return $this->hasOne('App\Wards');
    }

    public function setHouseNumber($data) {
        $this->house_number = $data;
    }

    public function setStreetName($data) {
        $this->street_name = $data;
    }

    public function setStreetType($data) {
        $this->street_type = $data;
    }

    public function setNeighbourhood($data) {
        $this->neighbourhood = $data;
    }

    public function setWardName($data) {
        $this->ward_name = $data;
    }

    public function setWardId($data) {
        $this->ward_id = $data;
    }

    public function validate() {
        if($this->house_number == null) {
            return false;
        }
        if($this->street_name == null) {
            return false;
        }
        if($this->street_type == null) {
            return false;
        }
        if($this->neighbourhood == null) {
            return false;
        }
        if($this->ward_name == null) {
            return false;
        }
        if($this->ward_id == null) {
            return false;
        }
        return true;
    }
}
