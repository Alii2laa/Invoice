<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSection;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public  function __construct(){
         $this->middleware('auth');
    }
    public function index()
    {
        $SectionsData = Section::get();
        return view('sections.sections',compact('SectionsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $SectionCreate = view('sections.sectionAdd')->render();
        return response()->json([
            'data' => $SectionCreate
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSection $request
     * @return JsonResponse
     */
    public function store(StoreSection $request)
    {
        $section = Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => Auth::user()->name,
        ]);
        if($section){
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return JsonResponse
     */
    public function edit($section_id)
    {

        if ($section_id){
            $SectionEdit = Section::where('id',$section_id)->first();
            $SectionView = view('sections.sectionUpdate', compact('SectionEdit'))->render();
            return response()->json([
                'data' => $SectionView,
                'check' => 1,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $sections = Section::find($request->section_id)->first();
        $this->validate($request, [

        'section_name' => 'required|max:255',
        'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'description.required' =>'يرجي ادخال البيان',

        ]);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);
        if($sections){
            return response()->json([
                'status' => true,
                'msg' => 'تم التحديث بنجاح'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'فشل التحديث برجاء المحاوله'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
