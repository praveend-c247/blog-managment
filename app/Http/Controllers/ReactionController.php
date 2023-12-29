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

    // public function react(Request $request, Blogs $blog)
    // {
    //     $reactionType = $request->input('reaction_type');

    //     // React to the blog
    //     $blog->react($reactionType);

    //     return back();
    // }

    public function react(Request $request, $reactableType, $reactableId)
    {
        $user = auth()->user();
        $newEmoji = $request->input('emoji');
    
        $existingReaction = Reaction::where([
            'user_id' => $user->id,
            'reactable_type' => "App\\Models\\$reactableType",
            'reactable_id' => $reactableId,
        ])->first();        
        if ($existingReaction) {
            // User has already reacted
            if ($existingReaction->emoji !== $newEmoji) {
                // If the user selected a different emoji, update the existing reaction
                $existingReaction->update(['emoji' => $newEmoji]);
            } else {
                // If the user selected the same emoji, delete the existing reaction
                $existingReaction->delete();
            }
        } else {
            $reaction = new Reaction([
                'user_id' => $user->id,
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
