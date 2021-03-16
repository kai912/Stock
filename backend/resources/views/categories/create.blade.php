@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl">
        <div class="justify-center grid sm:grid-cols-3">
            <div class="col-start-2 shadow-lg rounded-lg">
                <div class="pl-4 bg-gray-50 bg-opacity-50 py-2 w-full border-b-2 border-gray-200 text-gray-400 font-bold lg:text-xl">分類を追加</div>
                <div class="py-4">
                @if($errors->any())
                    <div class="text-red-500">
                    <ul>
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                    <form action="{{ route('admin.categories.create') }}" method="post">
                        @csrf
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" placeholder="名前" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="name" id="name" value="{{ old('name') }}" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="mr-4 pt-2 px-2 border-b-2 border-gray-200 text-gray-400 hover:border-gray-400 justify-self-end">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection