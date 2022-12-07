<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nfs;
class TetsController extends Controller
{
    public function index(){
        dd(Nfs::getTableColumns("cms_role"));
    }
}
