<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Animal;
use Symfony\Component\HttpFoundation\Response;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //找到 store 方法，小括號中傳入的 $request 變數是使用者請求時輸入的資料
    //參數要屬於 Request 類別才可以被方法接受
    {
        $animal = Animal::create($request->all());
        //store 方法中呼叫 Animal Model 並使用 Create 方法，把使用者的請求資料用 all() 方法轉為陣列，傳入 create() 方法中
        $animal = $animal->refresh();
        //用 refresh() 方法再查詢一次資料庫，得到該筆的完整資料
        return response($animal, Response::HTTP_CREATED);
        //Laravel 寫好的輔助方法 response()
        //第一個參數傳入變數 $animal，成功寫入資料庫後產生出來的實體物件資料，包含在 HTTP 協定的內容中回傳給客戶端
        //第二個參數設定 HTTP 狀態碼，可以直接輸入 201 表示「建立成功」，或是用 Symfony 套件寫好的常數如範例
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $animal->update($request->all());
        return response($animal, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        //將查詢到的 Animal Model 實體物件，使用 Model 的 delete() 方法刪除資料，
        //將資料庫中的 animals 資料表 ID 為 1 的資料刪除
        return response(null, Response::HTTP_NO_CONTENT);
        //回傳內容為 null 並且給予 204 HTTP 狀態碼
        //這邊一樣使用 Symfony 套件定義好的常數
    }
}
