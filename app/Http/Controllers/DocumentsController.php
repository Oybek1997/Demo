<?php


namespace App\Http\Controllers;

use App\Documents;
use App\Http\Rules\IsOwner;
use App\User;
use Illuminate\Http\Request;
use App\Http\Rules;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //$documents = Documents::latest()->paginate(5);
        $private = Documents::where('privacy','private')->get();
        $public = Documents::where('privacy','public')->get();
        $private_count = count($private);
        $public_count = count($public);

        $user = User::where('id',Auth::user()->id)->firstOrFail();
        $private_docs=$user->documentus()->get();


        return view('documents.index', compact('private_count', 'public_count','public'
            ,'private_docs'))
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
            'privacy' => 'required',
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
            'privacy' => 'required',
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

    public function echart(Request $request)
    {
        $private = Documents::where('privacy','private')->get();
        $public = Documents::where('privacy','public')->get();
        $private_count = count($private);
        $public_count = count($public);
        return view('documents.index',compact('private_count','public_count'));

    }
}
