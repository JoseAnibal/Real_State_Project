<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralFunction extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $types=['Piso','Casa','Parking','Terreno'];
    

    public static function dropdownTypes($selected=null){
        $types=['Piso','Casa','Parking','Terreno'];
        $selectForm="
        <label for='type' class='form-label'>Tipo</label>
            <select class='form-select selectortype' aria-label='Default select example' name='type'>";
 
        foreach($types as $key=>$value){

            if(!is_null($selected)){
                
                if($key==$selected){
                    $selectForm.="<option selected value='$key'>$value</option>";
                }else{
                    $selectForm.="<option value='$key'>$value</option>";
                }

            }else{
                $selectForm.="<option value='$key'>$value</option>";
            }
        }

        $selectForm.="</select>";

        return $selectForm;
    }

}
