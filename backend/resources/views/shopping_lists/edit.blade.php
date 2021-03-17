@extends('layouts.user.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl sm:px-10">
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
                    <form action="{{ route('user.shopping_lists.edit', ['shopping_list' => $shopping_list]) }}" method="post">
                        @csrf
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="food_id" id="food_id" value="{{ old('food_id') ?? $shopping_list->food->name }}" />
                        </div>
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="quantity" id="quantity" value="{{ old('quantity') ?? $shopping_list->quantity  }}" />
                        </div>
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="priority" id="priority" value="{{ old('priority') ?? $shopping_list->priority  }}" />
                        </div>
                        <div class="form-group p-4 focus-within:text-gray-600">
                            <input type="text" class="shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="memo" id="memo" value="{{ old('memo') ?? $shopping_list->memo  }}" />
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