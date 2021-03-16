@extends('layouts.user.app')

@section('content')

    <div class="container mx-auto max-w-screen-xl md:px-10">
        <div class="grid sm:grid-cols-3 gap-4 items-start">
            <div class="pb-4 shadow-lg rounded-lg">
                <nav>
                    <div class="flex justify-between bg-gray-50 bg-opacity-50 w-full border-b-2 border-gray-200 text-gray-400 font-bold lg:text-xl">
                        <div class="my-auto pl-4">場所</div>
                        <div class="py-4">
                            <a href="{{ route('user.stocks.create') }}" class="my-10 px-4 mr-2 py-2 border-b-2 border-gray-200 hover:border-gray-500">
                            場所を追加する
                            </a>
                        </div>
                    </div>
                    <ul class="w-full mb-4">
                        @foreach($stocks as $stock)
                        <li class="text-lg text-center border-b-4 border-double border-gray-300 mx-4 px-4"><a class="list-group-item {{ $current_stock_id === $stock->id ? 'active' : '' }}" href="{{ route('user.stock_foods.index', ['id' => $stock->id]) }}">
                            {{ $stock->name }}
                        </a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="justify-center bg-gray-100 bg-opacity-80 shadow-inner rounded-lg pb-4 px-10 sm:col-span-2">
                <div class="flex justify-between mx-4">
                    <a href="{{ route('user.stock_foods.gacha', ['id' => $current_stock_id]) }}" class="cursor-default font-bold text-xl my-auto">食べ物</a>
                    <div class="py-4">
                        <a href="{{ route('user.stock_foods.create', ['id' => $current_stock_id]) }}" class="my-10 px-4 py-2 border-b-2 border-gray-400 font-bold text-gray-500 hover:border-gray-500">
                            食べ物を追加する
                        </a>
                    </div>
                </div>
                <div class="px-10  bg-gray-50 shadow-sm rounded-md py-4 ">
                    <table class="table-fixed w-full mb-4">
                        <thead class="text-lg border-b-4 border-double border-gray-300">
                        <tr>
                        <th class="w-1/6">品名</a></th>
                        <th class="w-1/6">量</th>
                        <th class="w-1/12 hidden md:table-cell">P</th>
                        <th class="w-1/12 hidden md:table-cell">F</th>
                        <th class="w-1/12 hidden md:table-cell">C</th>
                        <th class="w-1/6">登録日</a></th>
                        <th class="w-1/6">削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-lg text-center py-1">
                        @foreach($stock_foods as $stock_food)
                            <tr class="whitespace-nowrap text-lg text-center border-t border-solid border-gray-300 border-opacity-60">
                            <td class="w-1/6">{{ $stock_food->name }}</td>
                            <td class="w-1/6">{{ $stock_food->volume * $stock_food->count }}{{ $stock_food->unit }}</td>
                            <td class="w-1/12 hidden md:table-cell">{{ $stock_food->protein * $stock_food->count}}g</td>
                            <td class="w-1/12 hidden md:table-cell">{{ $stock_food->fat * $stock_food->count}}g</td>
                            <td class="w-1/12 hidden md:table-cell">{{ $stock_food->carbohydrate * $stock_food->count}}g</td>
                            <td class="w-1/6">{{ $stock_food->register_date->format('m/d') }}</td>
                            <td class="w-1/6">
                                <form  action="{{ route('user.stock_foods.destroy', ['id'=>$stock->id, 'stock_food_id'=>$stock_food->stock_food_id]) }}" method="POST" onsubmit="return confirmFunctionDelete()" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="my-auto shadow-inner  bg-opacity-60 rounded-sm">
                                <svg width="12px" height="12px" viewBox="0 0 12 12" >
                                    <line x1="0" y1="12" x2="12" y2="0" stroke="black" stroke-width="2"/>
                                    <line x1="0" y1="0" x2="12" y2="12" stroke="black" stroke-width="2"/>
                                </svg>
                                </button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $stock_foods->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
function confirmFunctionDelete() {
    var checked = confirm('削除しますか？');
    if (checked) {
        return true;
    } else {
        return false;
    }
}
</script>
@endsection