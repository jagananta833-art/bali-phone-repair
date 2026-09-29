<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Page; use Illuminate\Http\Request; use Illuminate\Support\Str; use Illuminate\Validation\Rule;
class PageController extends Controller {
 public function index(Request $r){$items=Page::query()->when($r->filled('search'),function($q)use($r){$term=$r->string('search');$q->where(fn($qq)=>$qq->where('title','like',"%{$term}%")->orWhere('slug','like',"%{$term}%"));})->when($r->filled('status'),fn($q)=>$q->where('is_published',$r->input('status')==='published'))->latest()->paginate(10)->withQueryString();return view('admin.pages.index',compact('items'));}
 public function create(){return view('admin.pages.form',['item'=>new Page]);}
 public function store(Request $r){Page::create($this->data($r));return redirect()->route('admin.pages.index')->with('ok','Halaman dibuat.');}
 public function edit(Page $page){return view('admin.pages.form',['item'=>$page]);}
 public function update(Request $r,Page $page){$page->update($this->data($r,$page->id));return redirect()->route('admin.pages.index')->with('ok','Halaman diperbarui.');}
 public function destroy(Page $page){$page->delete();return back()->with('ok','Halaman dihapus.');}
 private function data(Request $r,?int $id=null):array{$slug=$r->filled('slug')?Str::slug((string)$r->input('slug')):Str::slug((string)$r->input('title'));$r->merge(['slug'=>$slug]);$d=$r->validate(['title'=>'required|max:160','slug'=>['required','max:160','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',Rule::unique('pages','slug')->ignore($id)],'excerpt'=>'nullable|max:500','content'=>'required','featured_image'=>['nullable','string','max:255','regex:/^[A-Za-z0-9._\/-]+$/','not_regex:/\.\./'],'featured_image_alt'=>'nullable|max:160','meta_title'=>'nullable|max:70','meta_description'=>'nullable|max:170','focus_keyword'=>'nullable|max:120','is_published'=>'nullable|boolean']);$d['is_published']=match($r->input('intent')){'draft'=>false,'publish'=>true,default=>$r->boolean('is_published')};return $d;}
}
