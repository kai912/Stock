@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl">
        <div class="justify-center grid sm:grid-cols-3">
            <div class="col-start-2 shadow-lg rounded-lg">
                <div class="pl-4 bg-gray-50 bg-opacity-50 py-2 w-full border-b-2 border-gray-200 text-gray-400 font-bold lg:text-xl">食べ物を追加</div>
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
                    <form action="{{ route('admin.foods.create', ['id' => $category_id]) }}" class="p-4 focus-within:text-gray-600" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="text" placeholder="名前" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="name" id="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="量" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="volume" id="volume" value="{{ old('volume') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="単位" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="unit" id="unit" value="{{ old('unit') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="P" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="protein" id="protein" value="{{ old('protein') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="F" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="fat" id="fat" value="{{ old('fat') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" placeholder="C" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="carbohydrate" id="carbohydrate" value="{{ old('carbohydrate') }}" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="mr-4 pt-2 px-2 border-b-2 border-gray-200 text-gray-400 hover:border-gray-400 justify-self-end">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection