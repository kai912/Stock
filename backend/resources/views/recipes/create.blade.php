@extends('layouts.user.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl sm:px-10 px-4">
        <div class="justify-center grid sm:grid-cols-3">
            <div class="sm:col-start-2 shadow-lg rounded-lg">
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
                    <form action="{{ route('user.recipes.create') }}" method="post">
                        @csrf
                        <div class="food-group form-group p-4 focus-within:text-gray-600">
                            <input placeholder="料理名" type="text" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="name" id="name" value="{{ old('name') }}" />
                        </div>
                        <!-- 食材の登録最大値5に設定 -->
                        @for($i = 0; $i < 5; $i++)
                        <div class="food-group hidden">
                            <div class="form-group p-4 focus-within:text-gray-600">
                                <select name="food_id{{ $i }}" id="food_id{{ $i }}" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300">
                                <option value="0" hidden>選択してください</option>
                                @foreach($foods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }}({{ $food->volume}}{{ $food->unit }})</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group px-4 focus-within:text-gray-600">
                                <input placeholder="量" type="text" class="placeholder-gray-300 shadow-inner border-gray-100 rounded-md w-full focus:outline-none focus:ring-0 focus:border-gray-300" name="count{{ $i }}" id="count{{ $i }}" value="{{ old('count[$i]') }}" />
                            </div>
                        </div>
                        @endfor
                        <div class="text-center">
                            <button type="submit" class="my-2 px-4 py-2 border-b-2 border-gray-400 font-bold text-gray-500 hover:border-gray-500">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
document.addEventListener("DOMContentLoaded",() => {
    const foodGroup = document.querySelectorAll('.food-group');

    for (let i = 0; i < foodGroup.length; i++){
        let foodGroupEach = foodGroup[i];
        let nextFoodGroup = foodGroupEach.nextElementSibling;
        
        foodGroupEach.addEventListener('change', () => {
            nextFoodGroup.classList.remove('hidden');
        });
    }

});

</script>
@endsection