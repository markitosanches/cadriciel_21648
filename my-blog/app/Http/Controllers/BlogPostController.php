<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class BlogPostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pdo->query(SELECT * FROM blog_posts)->fetchAll();
        $blogs = BlogPost::all();

        return view('blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = new Category;
        //$categories = $categories->categorySelect();

        $categories = Category::categorySelect();

        //return $categories;

        return view('blog.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request;

       $blogPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'categories_id' => $request->categories_id
       ]);

    return redirect(route('blog.show', $blogPost->id))->withSuccess('Post inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //SELECT * FROM blog_posts WHERE id = ?
        //PDO->prepare(SELECT * FROM blog_posts WHERE id = ?)
        //->execute(array($blogPost))
        //$blogPost = fetch()

        //$blogPost->join('users,' 'user_id', 'users.id')->get();
        return view('blog.show', ['blogPost' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = Category::categorySelect();

        return view('blog.edit', ['blogPost' => $blogPost, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
            'categories_id' => $request->categories_id
        ]);

        return redirect(route('blog.show', $blogPost->id))->withSuccess('Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect(route('blog.index'))->withSuccess('Post Deleted');
    }

    public function query(){

        //$blog = pdo->query(select * from blog_posts); $blog->fetchAll();
        //$blog = BlogPost::all();
        //$blog = BlogPost::select('id', 'title')->get();
        //$blog = BlogPost::select()->first();

        //$blog = pdo->prepare(select * from blog_posts WHERE id = ? ); $blog->execute(array($id)); $blog->fetch();
        //$blog = BlogPost::find(5);

        /*$blog = BlogPost::select()
                ->where('id', 1)
                ->first();
        */
        
        /*$blog = BlogPost::select()
                ->where('user_id', '=' ,10)
                ->orderby('title', 'desc')
                ->get();
        */
        //AND  SELECT * FROM blog_posts WHERE user_id = 1 and Title = 'Abc';

        /*$blog = BlogPost::select()
                ->where('user_id', '=' ,1)
                ->where('title', 'Abc')
                ->orderby('title', 'desc')
                ->get();
*/
        //OR  SELECT * FROM blog_posts WHERE user_id = 2 OR Title = 'Abc';
          /*      $blog = BlogPost::select()
                ->where('user_id', '=' ,2)
                ->orwhere('title', 'Abc')
                ->orderby('title', 'desc')
                ->get();
        */
        //INSERT
        /*BlogPost::create([]);

        $blog = new BlogPost;
        $blog->title = 'Abc';
        $blog->save();*/

        //UPDATE


        /*$blog = blogPost::find(1)
        $blog->update([]);
        
        $blog->title = 'Abc';
        $blog->save();*/

        
        //Join
        // Select * FROM blog_posts INNER JOIN users ON user_id = users.id
        /*$blog = BlogPost::select()
                ->join('users', 'blog_posts.user_id', '=','users.id')
                ->get();
        */

        //outer
        // elect * FROM blog_posts RIGHT OUTER JOIN users ON user_id = users.id
        /*$blog = BlogPost::select()
                ->rightjoin('users', 'blog_posts.user_id', '=','users.id')
                ->get();
        */

        //AGGREGATION
        /*$blog = BlogPost::max('id');

        $blog = BlogPost::select()
                ->where("user_id", 2)
                ->count();

        */

        //raw /  brute

        //SELECT count(*) as blog, user_id FROM blog_post group by user_id 
       /* $blog = BlogPost::select(DB::raw('count(*) as blogs'), 'user_id')
        ->groupBy('user_id')
        ->get();
        */

        /*Select * from blog_posts LIMIT 5 (&page=5)
        Select * from blog_posts LIMIT 5 5 (&page=10)*/

      
      
        return $blog;
    }

    public function page(){
        $blogs = BlogPost::select()
        ->paginate(5);

        return view('blog.page', ['blogs' => $blogs ]);

    }

    public function showPdf(BlogPost $blogPost){
        $pdf = PDF::loadView('blog.show-pdf', ['blogPost' => $blogPost]);
        return $pdf->download('blog.pdf');
        //return $pdf->stream('blog.pdf');

    }
}
