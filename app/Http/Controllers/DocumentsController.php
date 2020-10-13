<?php


namespace App\Http\Controllers;

use App\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::latest()->paginate(5);

        return view('documents.index',compact('documents'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('documents.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Documents::create($request->all());

        return redirect()->route('documents.index')
            ->with('success','Documents created successfully.');
    }

    public function show(Documents $document)
    {
        return view('documents.show',compact('document'));
    }

    public function edit(Documents $document)
    {
        return view('documents.edit',compact('document'));
    }

    public function update(Request $request, Documents $document)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $document->update($request->all());

        return redirect()->route('documents.index')
            ->with('success','Documents updated successfully');
    }

    public function destroy(Documents $document)
    {
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success','Documents deleted successfully');
    }
}