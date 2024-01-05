<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckOutService;
use App\Models\{Blogs, User, Reaction, SubscriptionPlans};
use Auth;

class PagesController extends Controller
{
    public function __construct(private CheckOutService $checkOutService)
    {
        $this->checkOutService = $checkOutService;
    }

    private $emojis = ['👍', '❤️', '😂', '😲', '😢', '😡'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function HomePage(Request $request)
    {
        $blogList = Blogs::with('blogCategories')->where('is_deleted',0)->get();
        return view('pages.homepage',compact('blogList'));
    }

    public function BlogDetailPage(Request $request)
    {
        $userInfo = Auth::user();
        if (!empty($userInfo)) {
            $user = User::with('subscriptionPlan')->where('id',$userInfo->id)->first();
            if ($user->blog_view_count < $user['subscriptionPlan']->blog_count || $userInfo->role == 1) {
                $user->blog_view_count = $user->blog_view_count + 1;
                $user->update();
                $blogDetail = Blogs::with('blogCategories','comments')->where('is_deleted',0)->where('id',$request->id)->first();
                $emojis = $this->emojis;
                $reactionCounts = Reaction::where('reactable_id', $request->id)
                                    ->select('type','emoji', \DB::raw('count(*) as count'))
                                    ->groupBy('type','emoji')
                                    ->get();
                if (!empty($blogDetail)) {
                    return view('pages.blog-detail',compact('blogDetail','emojis','reactionCounts'));
                }else{
                    return redirect('blogs')->with('error','This Blog is not found...');
                }
            }else{
                return redirect('/')->with('limit_error', 'You have passed your current usage limit. Please upgrading your plan to continue uninterrupted access.');
            }   
        }else{
            $blogDetail = Blogs::with('blogCategories','comments')->where('is_deleted',0)->where('id',$request->id)->first();
            $emojis = $this->emojis;
            $reactionCounts = Reaction::where('reactable_id', $request->id)
                                ->select('type','emoji', \DB::raw('count(*) as count'))
                                ->groupBy('type','emoji')
                                ->get();
            if (!empty($blogDetail)) {
                return view('pages.blog-detail',compact('blogDetail','emojis','reactionCounts'));
            }else{
                return redirect('blogs')->with('error','This Blog is not found...');
            }
        }
    }

    public function BlogsPage(Request $request)
    {
        $blogList = Blogs::with('blogCategories','comments')->where('is_deleted',0)->get();
        return view('pages.blog',compact('blogList'));
    }

    public function checkOut(Request $request)
    {
        $userInfo = Auth::user();
        $subscriptionPlan = SubscriptionPlans::where('id',$request->id)->first();
        
        return view('pages.checkout',compact('userInfo','subscriptionPlan'));
    }

    public function buyNow(Request $request)
    {
        $this->checkOutService->checkOut($request);

        return redirect('/')->with('order_success', 'Congratulations! Your plan upgrade was successful. Enjoy enhanced features.');
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
    public function show(string $postId)
    {
        $post = Blogs::with('comments')->find($postId); // Assuming you have a Post model

        return view('pages.show', ['post' => $post]);
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
