
@extends('layouts.user.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl sm:px-10">
        <div class="my-40 ml-20">
            <div class="sm:text-6xl text-4xl leading-normal font-bold">
                食材の管理、
                <br>
                健康の管理。
            </div>
            <div class="sm:text-2xl mt-6">
                まずは場所を追加しよう!
            </div>
            </div>
            <div class="flex justify-center bg-gray-50 bg-opacity-50 border-b-2 border-gray-200 text-gray-400 font-bold md:col-start-2 shadow-lg rounded-lg">
                <div class="py-4">
                    <a href="{{ route('user.stocks.create') }}" class="my-10 px-4 mr-2 py-2 border-b-2 border-gray-200 hover:border-gray-500">
                    場所の追加
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection