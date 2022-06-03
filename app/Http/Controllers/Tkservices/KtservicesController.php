<?php

namespace App\Http\Controllers\Tkservices;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KtservicesController extends Controller
{
    
    public function index()
    {
        return view('backpack.tkservices.index');
    }

    public function service()
    {
        return view('backpack.tkservices.components.service_clinick');
    }

    public function network(){
        return view('backpack.tkservices.components.network');
    }

    public function knowledgeHealth(){
        return view('backpack.tkservices.components.knowledge_health');
    }
}
