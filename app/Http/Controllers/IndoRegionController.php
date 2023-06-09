<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function getregency(Request $request)
    {
        $id_provinces = $request->id_provinces;

        $regences = Regency::where('province_id', $id_provinces)->get();

        foreach ($regences as $regency) {
            echo "<option value=' $regency->id '> $regency->name </option>";
        }
    }
}
