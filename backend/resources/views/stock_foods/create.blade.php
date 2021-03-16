@extends('layouts.user.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl">
        <div class="justify-center grid grid-cols-3 gap-4">
            <div class="bg-gray-100 col-start-2 shadow-lg rounded-lg">
                <div class="text-center w-full border-b-2 border-gray-300 font-bold text-xl">食べ物を追加する</div>
                <div class="text-center py-4">
                @if($errors->any())
                    <div class="text-red-500">
                    <ul>
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                    <form action="{{ route('user.stock_foods.create', ['id'=> $stock_id]) }}" method="post">
                        @csrf
                        <div class="form-group flex-auto">
                            <select name="food_id" id="food_id" class="bg-white border-b m-auto block border-gray-200 text-gray-700 pb-1 rounded-md">
                            @foreach($foods as $food)
                            <option value="{{ $food->id }}">{{ $food->name }} {{ $food->volume }}{{ $food->unit }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group flex-auto">
                            <label for="count">量:</label>
                            <input type="text" class="bg-white border-b m-auto block border-gray-200 text-gray-700 pb-1 rounded-md" name="count" id="count" value="{{ old('count') }}" />
                        </div>
                        <div class="form-group flex-auto">
                            <label for="register_date">購入日:</label>
                            <input type="date" value="{{ $today }}" class="bg-white border-b m-auto block border-gray-200 text-gray-700 pb-1 rounded-md" name="register_date" id="register_date" value="{{ old('register_date') }}" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="my-2 px-4 py-2 border-b-2 border-gray-400 font-bold text-gray-500 hover:border-gray-500">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

