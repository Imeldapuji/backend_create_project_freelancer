<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use App\Http\Controllers\Rule;
// use JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;
class ProjectController extends Controller
{

    // public function tambah(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'userid' => 'required|integer',
    //         'descriptions' => 'required|string|max:255',
    //         'budget' => 'required|integer',
    //         'type' => 'in:private,public',
    //         'projectname' => 'required|string|max:255',
    //         'status' => 'in:active,close',

    //     ]);

    //     if($validator->fails()){
    //         return response()->json([
    //             'status' => 0,
    //             'message' => $validator->errors()->toJson()
    //         ]);
    //     }
	
    // }

    
    public function store(Request $request)
    {
        try{
            $data = new Project();
            $data->userid            = $request->input('userid');
            $data->descriptions      = $request->input('descriptions');
            $data->budget            = $request->input('budget');
            $data->type              = $request->input('type');
            $data->projectname       = $request->input('projectname');
            $data->status            = $request->input('status');

            $data->save();

            return response()->json([
                'status'	=> '1',
                'message'	=> 'Data project berhasil ditambah'
        
            ]);

        } catch(\Exception $e){
            return response()->json([
                'status' =>'0',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function getAll($limit = 10, $offset = 0)
    {
        $data["count"] = Project::count();
        $project = array();

        foreach (Project::take($limit)->skip($offset)->get() as $p){
            $item = [
                "id"                => $p->id,
                "userid"            => $p->userid,
                "descriptions"      => $p->descriptions,
                "budget"            => $p->budget,
                "type"              => $p->type,
                "projectname"       => $p->projectname,
                "status"            => $p->status,
                "created_at"        => $p->created_at,
                "updated_at"        => $p->updated_at,
            ];

            array_push($project, $item);
        }
        $data["projects"] = $project;
        $data["status"] = 1;
        return response($data);
    }
}