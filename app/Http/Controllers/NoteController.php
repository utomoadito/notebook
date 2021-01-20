<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::orderBy('created_at', 'DESC')->with('category')->get();
        $categories = Category::all();
        return Inertia::render('Note', ['notes' => $notes, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note;
        $note->name = $request->name;
        $note->content = $request->content;
        $note->category_id = $request->category_id;
        $note->save();
        
        return redirect()->back()->with('message', 'Save Data "'.$request->name.'" Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->name = $request->name;
        $note->content = $request->content;
        $note->category_id = $request->category_id;
        $note->save();
        
        return redirect()->back()->with('message', 'Update Data "'.$request->name.'" Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();

        return redirect()->back()->with('message', 'Delete Data "'.$note->name.'" Successfully.');
    }
}
