<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PaidParticipantExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function generateExcel($event_id,$event_type,$event_name){
    	return Excel::download(new PaidParticipantExport($event_id,$event_type), "{$event_name}.xlsx");
    }
}
