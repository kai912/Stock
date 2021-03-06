@extends('layouts.user.app')

@section('content')

    <div class="container mx-auto max-w-screen-xl px-4 sm:px-10">
        <div class="grid md:grid-cols-3 gap-4 items-start">
            <nav class="pb-2 shadow-lg rounded-lg">
                <div class="flex justify-between bg-gray-50 bg-opacity-50 w-full border-b-2 border-gray-200 text-gray-400 font-bold px-4 mb-2">
                    <div class="accordion-title my-auto text-md sm:text-xl cursor-pointer">場所<span class="active-stock hidden">:{{ $stock->name }}</span></div>
                    <div class="py-4">
                        <a href="{{ route('user.stocks.create') }}" class="px-2 sm:px-4 py-2 border-b-2 border-gray-200 hover:border-gray-500 text-sm sm:text-lg">
                        場所の追加
                        </a>
                    </div>
                </div>
                <ul class="w-full mb-2 accordion-contents">
                    @foreach($stocks as $Stock)
                    <li class="mx-2 sm:mx-4 py-1 text-gray-400 text-sm sm:text-lg text-center border-b-2  border-gray-300 {{ $current_stock_id === $Stock->id ? 'text-gray-700 border-gray-700' : '' }}">
                        <a href="{{ route('user.stock_foods.index', ['stock' => $Stock]) }}">{{ $Stock->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>

            <div class="bg-gray-50 bg-opacity-50 shadow-inner rounded-lg md:col-span-2">
                <div class="flex justify-between text-gray-400 px-4 border-b-2 bg-white bg-opacity-50 mb-2 sm:mb-4">
                    <a href="{{ route('user.stock_foods.gacha', ['stock' => $stock]) }}" class="cursor-default font-bold my-auto text-md sm:text-xl">食べ物</a>
                    <div class="py-4">
                        <a href="{{ route('user.stock_foods.create', ['stock' => $stock]) }}" class="px-2 sm:px-4 py-2 border-b-2 border-gray-200 text-sm sm:text-lg font-bold hover:border-gray-500">
                            食べ物の追加
                        </a>
                    </div>
                </div>
                <div class="mx-2 sm:mx-4">
                    <table class="sm:text-lg text-sm w-full mb-2 text-gray-500">
                        <thead class="border-b-4 border-double border-gray-500">
                        <tr>
                        <th onclick="calcTotalPFC()">品名</a></th>
                        <th>量</th>
                        <th class="hidden sm:table-cell">P</th>
                        <th class="hidden sm:table-cell">F</th>
                        <th class="hidden sm:table-cell">C</th>
                        <th>登録日</a></th>
                        <th>編集</th>
                        <th>削除</th>
                        </thead>
                        <tbody class="text-center">
                        @foreach($stock_foods as $stock_food)
                            <tr class="whitespace-nowrap border-t border-solid border-gray-300 border-opacity-60">
                            <td>{{ $stock_food->name }}</td>
                            <td>{{ $stock_food->volume * $stock_food->count }}{{ $stock_food->unit }}</td>
                            <td class="hidden sm:table-cell" name="protein">{{ $stock_food->protein * $stock_food->count }}</td>
                            <td class="hidden sm:table-cell" name="fat">{{ $stock_food->fat * $stock_food->count }}</td>
                            <td class="hidden sm:table-cell" name="carbohydrate">{{ $stock_food->carbohydrate * $stock_food->count }}</td>
                            <td>{{ $stock_food->register_date->format('m/d') }}</td>
                            <td>
                                <a href="{{  route('user.stock_foods.edit', [ 'stock' => $stock, 'stock_food' => $stock_food])  }}"  class="mx-auto">編集</a>
                            </td>
                            <td>
                                <form  action="{{ route('user.stock_foods.destroy', ['stock'=>$stock, 'stock_food'=>$stock_food]) }}" method="POST" onsubmit="return confirmFunctionDelete()" >
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">

document.addEventListener('DOMContentLoaded', () => {
    const accordionTitle = document.querySelector('.accordion-title');
    const activeStock = document.querySelector('.active-stock');
    const accordionContents = document.querySelector('.accordion-contents');

    accordionTitle.addEventListener('click', (e) => {
        if(accordionContents.classList.contains('hidden')) {
            accordionContents.classList.remove('hidden');
            activeStock.classList.add('hidden');
        } else {
            accordionContents.classList.add('hidden');
            activeStock.classList.remove('hidden');
        }
    })
})

function confirmFunctionDelete() {
    let checked = confirm('削除しますか？');
    if (checked) {
        return true;
    } else {
        return false;
    }
}

function calcTotalPFC() {

    let ProteinList = document.getElementsByName("protein");
    let FatList = document.getElementsByName("fat");
    let CarbohydrateList = document.getElementsByName("carbohydrate");

    let TotalProtein = 0;
    let TotalFat = 0;
    let TotalCarbohydrate = 0;

    for (let i = 0; i < ProteinList.length; i++) {
        let protein = Number(ProteinList[i].textContent);
        let fat = Number(FatList[i].textContent);
        let carbohydrate = Number(CarbohydrateList[i].textContent);

        TotalProtein += protein;
        TotalFat += fat;
        TotalCarbohydrate += carbohydrate;
    };

    alert('P:' + TotalProtein + ' F:' + TotalFat + ' C:' + TotalCarbohydrate + 'です\n' + '総カロリーは' + Math.round(TotalProtein * 4 + TotalFat * 9 + TotalCarbohydrate * 4) + 'kcalです');
}

</script>
@endsection