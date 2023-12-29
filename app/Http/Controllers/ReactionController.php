<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Reaction;

class ReactionController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogs $blog)
    {
        return view('posts.show', compact('blog'));
    }

    public function react(Request $request, $reactableType, $reactableId)
    {
        $user = auth()->user();
        $breakEmoji = explode('/',$request->input('emoji'));
        
        $newEmoji = $breakEmoji[0];
        $type = $breakEmoji[1];
    
        $existingReaction = Reaction::where([
            'user_id' => $user->id,
            'reactable_type' => "App\\Models\\$reactableType",
            'reactable_id' => $reactableId,
        ])->first();        
        if ($existingReaction) {
            if ($existingReaction->emoji !== $newEmoji) {                
                $existingReaction->update(['type'=>$type, 'emoji' => $newEmoji]);
            } else {
                $existingReaction->delete();
            }
        } else {
            $reaction = new Reaction([
                'user_id' => $user->id,
                'type' => $type,
                'emoji' => $newEmoji,
            ]);
            $reactable = app("App\\Models\\$reactableType")::findOrFail($reactableId);        
            $reactable->reactions()->save($reaction);
        }
        return redirect()->back();
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
