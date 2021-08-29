<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::all();
        return view('admin.tag.list',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tag.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $data = $request->all();
        $tag = Tag::create($data);
        if ($tag){
            $message = 'message.add_tag_success';
            return redirect()->route('tag.index')->withMessage(__($message));
        } else {
            $message = 'message.add_tag_fail';
            return redirect()->route('tag.index')->withMessage(__($message));
        }
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
    public function edit($tagid)
    {
        $tag = $this->findTag($tagid);
        if($tag){
            return view('admin.tag.edit',compact('tag'));
        }else{
            $errors = 'message.no_category';
            return redirect()->route('homeadmin.index')->withErrors(__($errors));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tagid)
    {
        $tag= $this->findTag($tagid);
        $data = $request->all();
        $tag->update($data);
        if($tag){
            $message = 'message.update_tag_success';
            return redirect()->route('tag.edit',$tag->id)->withMessage(__($message));
        } else {
            $message = 'message.update_tag_fail';
            return redirect()->route('tag.edit',$tag->id)->withMessage(__($message));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tagid)
    {
        $tag = $this->findTag($tagid);
        $tag->delete();
        $message = 'message.delete_tag_success';
        return redirect()->route('tag.index')->withMessage(__($message));
    }

    public function findTag($tagid){
        $tag = Tag::find($tagid);
        if($tag){
            return $tag;
        }else{
            $errors = 'message.no_category';
            return redirect()->route('homeadmin.index')->withErrors(__($errors));
        }
    }
}
