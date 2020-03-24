<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use App\Tag;
use Exception;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);

        return view('tags.index', [
            'tags' => $tags
        ]);
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $tag = new Tag();

        $tag->name = $data['name'];

        $tag->save();

        $request->session()->flash('status', 'Tag created');
        return redirect()->action('TagController@index');
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();
        $request->session()->flash('status', 'Tag deleted');
        return redirect()->action('TagController@index');
    }
}
