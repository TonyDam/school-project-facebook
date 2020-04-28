<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ComController extends Controller {
    public function createCom(Post $post, Request $request) {
        $validate = $request->validate([
            'text' => 'required',
        ]);

        $post = new Post;
        $post->text = $request->text;
        $post->user_id = Auth::user()->id;
        $post->parent_id = $request->parent_id;
        $post->save();

        return redirect::back();
    }

    public function destroyCom($id, Post $post) {
        $p = $post->find($id);
        if (Auth::check()) {
            $p->delete($id);

            return redirect::back()->withOk("La publication «" . $p->text . "» a été supprimé.");
        }
    }
}
