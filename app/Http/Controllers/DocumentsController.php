<?php


namespace App\Http\Controllers;

use App\Documents;
use App\Http\Rules\IsOwner;
use App\User;
use Illuminate\Http\Request;
use App\Http\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $user = User::where('id',Auth::user()->id)->firstOrFail();
        $user_docs=$user->documents()->get();
        $request->merge(['user_id' => Auth::user()->id]);

        //$user_private=$user_docs->where('privacy','private')->get();
       // $user_public=$user_docs->where('privacy','public')->get();
        $user_private = DB::table('documents')->where([
            ['privacy','private'],
            ['user_id',Auth::user()->id],
        ])->get();
        $user_public = DB::table('documents')->where([
            ['privacy','public'],
            ['user_id',Auth::user()->id],
        ])->get();
        //$documents = Documents::latest()->paginate(5);
        $private = Documents::where('privacy','private')->get();
        $public = Documents::where('privacy','public')->get();
        $private_count = count($user_private);
        $public_count = count($user_public);



        return view('documents.index', compact('private_count', 'public_count','public'
            ,'user_private','user_public'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function create()
    {
        return view('documents.create');
    }
    public function store(Request $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
       // $uuid = Str::uuid()->toString();
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
        //$uuid = Str::uuid()->toString();
        $request->merge(['user_id' => Auth::user()->id]);
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
