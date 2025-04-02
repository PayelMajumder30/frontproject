<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->keyword ?? '';
        $query = Designation::query();
        
        // Apply search filter based on the keyword (search in title or desc)
        $query->when($keyword, function($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%');
        });
        // Paginate results
        $data = $query->latest('id')->paginate(25);
        return view('designation.index', compact('data'));
    }

    public function create(){
        return view('designation.create');
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255|unique:designations,title',
        ]);

        $data = Designation::create(['title' => $request->title,]);
        return redirect()->route('designation.list.all', compact('data'))->with('success', 'Designation created successfully!');
    }

    public function edit($id){
        $data = Designation::findOrFail($id);
        return view('designation.edit', compact('data'));
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $designation = Designation::findOrFail($request->id);

        // Update the record
        $designation->title = $request->title;
        $designation->save();

        return redirect()->route('designation.list.all')->with('success', 'Designation updated successfully!');
    }

    public function status(Request $request, $id){
        $data = Designation::find($id);
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->update();
        return response()->json([
            'status'    => 200,
            'message'   => 'Status updated',
        ]);
    }

    public function delete(Request $request, $id){
        $designation = Designation::findOrFail($id);
        $data = $designation->delete();
        return redirect()->route('designation.list.all', compact('data'))->with('success', 'Designation deleted');
    }

}
