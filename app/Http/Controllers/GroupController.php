<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Helpers;

use App\Http\Resources\GroupResource;
use Carbon\Carbon;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null)
    {
        return GroupResource::collection(Group::latest()->paginate(5));
    }
    
    
    public function syncGroups(Request $request)
    {
        // var_dump(json_decode($request->groups)[0]);
        // need to modify and create groups one by one
        // I think soft_deletes will save us from needing to update posts/pages as we go
        $utilities = Helpers::_processTree(json_decode($request->groups)[0], null, ['canBeDeleted' => [], 'seen' => []]);
        // var_dump($utilities['canBeDeleted']);
        foreach($utilities['canBeDeleted'] as $id) {
            $node = Group::findOrFail($id);
            $node->delete();
        }

        return response()->json(["success" => true]);
    }

    
}