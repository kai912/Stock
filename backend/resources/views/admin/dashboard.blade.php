@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl">
        <div class="justify-center grid grid-cols-3 gap-4">
            <div class="bg-gray-100 col-start-2 shadow-lg rounded-lg">
                <div class="py-4 text-center w-full border-b-2 border-gray-300 font-bold text-xl">分類を追加</div>
                    <div class="py-4">
                        <a href="{{ route('admin.categories.create') }}" class="my-10 px-2 py-2 border-b-2 border-gray-400 font-bold text-gray-500 hover:border-gray-500">
                        分類を追加する
                        </a>
                    </div>
            </div>
        </div>
    </div>
@endsection