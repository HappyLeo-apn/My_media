<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Direct post page
    public function index()
    {
        $category = Category::get();
        $posts = Post::get();
        return view('admin.post.index', compact('category', 'posts'));
    }

    public function createPost(Request $request)
    {
        $postData = $this->getPostData($request);
        $validator = $this->postValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $postData['image'] = $fileName;
        } else {
            $postData['image'] = NULL;
        }

        Post::create($postData);
        return back();
    }

    public function deletePost($id)
    {

        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData['image'];
        Post::where('post_id', $id)->delete();
        $imgLocation = public_path() . '/postImage/' . $dbImageName;
        if (File::exists($imgLocation)) {
            File::delete($imgLocation);
        }
        return back();
    }

    public function postUpdatePage($id)
    {
        $updatePostData = Post::where('post_id', $id)->first();
        $posts = Post::get();
        $category = Category::get();
        return view('admin.post.updatePost', compact('posts', 'updatePostData', 'category'));
    }

    public function updatePost($id, Request $request)
    {
        //Creating Array for updated Data
        $data = $this->getUpdatedData($request);

        //do this if user upload image
        if (isset($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); //creating a unique name for image
            $file->move(public_path() . '/postImage', $fileName); //Store image under public

            $postData = Post::where('post_id', $id)->first();
            $dbImageName = $postData['image'];    // Getting image name from database
            $imgLocation = public_path() . '/postImage/' . $dbImageName; // path and name of the image
            if (File::exists($imgLocation)) {
                File::delete($imgLocation);
            }
            $data['image'] = $fileName; //inserting new uploaded image to 'data' array
        }


        Post::where('post_id', $id)->update($data);
        return back();
    }



    private function postValidationCheck($request)
    {
        return Validator::make(
            $request->all(),
            [
                'postTitle' => 'required',
                'postDesc' => 'required',
                'postCategory' => 'required'
            ]
        );
    }

    private function getUpdatedData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDesc,

            'category_id' => $request->postCategory
        ];
    }

    private function getPostData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDesc,
            'image' => $request->postImage,
            'category_id' => $request->postCategory

        ];
    }
}
