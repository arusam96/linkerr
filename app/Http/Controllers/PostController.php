<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    public function index()
{
    $users = User::all();
    $posts = Post::all();

    return view('index', compact('posts', 'users'));
}
public function myposts()
{
    $posts = post::where('user_id', Auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('myposts')->with('posts', $posts);
        $posts = post::all();
        return $posts;
}

    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function create()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        

        //store image
        // if($request->hasFile('cover_image')){
        //     $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('cover_image')->getClientOriginalExtension();
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     $path = $request->file('cover_image')->storeAs('public', $fileNameToStore);
	    //     $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        //     $thumb = Image::make($request->file('cover_image')->getRealPath());
        //     $thumb->resize(80, 80);
        //     $save_path = 'storage/cover_image/';

        //     if (!file_exists($save_path)) {
        //         mkdir($save_path, 666, true);
        //     }
           
        //     $thumb->save($save_path.$thumbStore);
           
		
        // } else {
        //     $fileNameToStore = 'noimage.jpg';
        // }
        

        $post =  new Post;
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->user_id = auth()->user()->id;
        if ($request->has('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $rename = Uuid::uuid4() . '.' . $extension;
            $image->move(public_path('images'), $rename);
            $post->image = $rename;
        }
        // $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('posts');

    }




    public function show($id)
    {
    $post = Post::find($id);

    return view('show', compact('post'));
    }

    public function edit($id)
    {
    $post = Post::find($id);
    return view('edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->body = $request->input('body');

    // if (file_exists($request->file('cover_image'))) {
    //     $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
    //     $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
    //     $extension = $request->file('cover_image')->getClientOriginalExtension();
    //     $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //     $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);

    //     $post->image = $fileNameToStore;
    //     // File::delete($request->input('existingimg'));
    //     @unlink('public/cover_image/' . $request->input('existingimg'));
    // } else {

    //     $post->image = $request->input('existingimg');
    // }

    $post->save();

    return redirect('posts');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();
        return redirect()->route('posts');
    }
    
    public function likepost($id)
    {
        $post = Post::find($id);
        $post->like();
        $post->save();

        return redirect()->route('post.show', $id)->with('message','Post Like successfully!');
    }

    public function unlikepost($id)
    {
        $post = Post::find($id);
        $post->unlike();
        $post->save();
        
        return redirect()->route('post.show', $id)->with('message','Post Like undo successfully!');
    }

}
