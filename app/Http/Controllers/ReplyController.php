<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replies;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reply = new Replies();
        $reply->body = $request->input('body');
        $reply->comments_id = $request->input('comment_id');

        if (auth()->check()) {
            $reply->user_id = auth()->id();
        }
        $reply->save();

        return redirect()->back()->with('success', 'Reply added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
