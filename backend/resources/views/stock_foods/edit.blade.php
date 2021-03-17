@extends('layouts.user.app')

@section('content')
<div class="container mx-auto max-w-screen-xl">
        <div class="justify-center grid sm:grid-cols-3">
            <div class="col-start-2 shadow-lg rounded-lg">
                <div class="pl-4 bg-gray-50 bg-opacity-50 py-2 w-full border-b-2 border-gray-200 text-gray-400 font-bold lg:text-xl">食べ物を移動</div>
                <div class="py-4">
                @if($errors->any())
                    <div class="text-red-500 pl-4">
                    <ul>
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                    <form action="{{ route('user.stock_foods.edit', ['id'=> $stock_food->stock_id, 'stock_food_id'=>$stock_food->id, 'food_id'=>$stock_food->food_id]) }}" method="post">
                        @csrf
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <select name="stock_id" id="stock_id" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300">
                            @foreach($stocks as $stock)
                            <option value="{{ $stock->id  }} " {{ $stock_food->stock_id === $stock->id ? 'selected' : '' }}>{{ $stock->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="count" id="count" value="{{ old('count') ?? $stock_food->count }}" />
                        </div>
                        <div class="hidden form-group p-4 focus-within:text-gray-600">
                            <input type="hidden"  value="{{ old('food_id') ?? $stock_food->food_id  }}" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="food_id" id="food_id" />
                        </div>
                        <div class="hidden form-group p-4 focus-within:text-gray-600">
                            <input type="hidden"  value="{{ old('register_date') ?? $stock_food->register_date  }}" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="register_date" id="register_date" />
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

