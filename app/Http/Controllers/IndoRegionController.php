<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function getregency(Request $request)
    {
        $id_provinces = $request->id_provinces;

        $regencies = Regency::where('province_id', $id_provinces)->get();

        $options = '<option value="">Pilih salah satu Kabupaten...</option>';
        foreach ($regencies as $regency) {
            $options .= "<option value='{$regency->id}'>{$regency->name}</option>";
        }

        return $options;
    }
    public function getregency1(Request $request)
    {
        $id_provinces = $request->id_provinces;

        $regencies = Regency::where('province_id', $id_provinces)->get();

        $options = '<option value="">Pilih salah satu Kabupaten...</option>';
        foreach ($regencies as $regency) {
            $options .= "<option value='{$regency->id}'>{$regency->name}</option>";
        }

        return $options;
    }
}
