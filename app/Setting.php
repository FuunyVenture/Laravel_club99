<?php

namespace App;

use App\BaseModel;

class Setting extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';
    protected $guarded = ['id'];

    public function setKeyCdAttribute($value) {
        $this->attributes['key_cd'] = str_replace(' ', '_', strtoupper($value));
    }

    public function getTypeAttribute() {
        return $this->attributes['type'] = strtoupper($this->attributes['type']);
    }

    public function getValueAttribute() {
        if ($this->attributes['type'] == 'FILE') {
            return 'uploads/settings/' . $this->attributes['value'];
        }
        if ($this->attributes['type'] == 'SELECT') {
            $values = json_decode($this->attributes['value']);

            $array = [];

            foreach ($values as $value) {
                $array[$value] = $value;
            }
            return $array;
        }
        return $this->attributes['value'];
    }

}
