@extends('layouts.user.app')

@section('content')

    <div class="container mx-auto max-w-screen-xl sm:px-10">
        <div class="">
            <div class="bg-gray-50 bg-opacity-50 shadow-inner rounded-lg pb-4">
                <div class="flex justify-between text-gray-400 px-4 border-b-2 bg-white bg-opacity-50 mb-4">
                    <div class="cursor-default font-bold my-auto lg:text-xl">買い物リスト</div>
                    <div class="py-4">
                        <a href="{{ route('user.shopping_lists.create') }}" class="px-4 py-2 border-b-2 border-gray-200 font-bold hover:border-gray-500">
                            食べ物の追加
                        </a>
                    </div>
                </div>
                <div class="mx-4">
                    <table class="w-full mb-4 text-gray-500">
                        <thead class="text-lg border-b-4 border-double border-gray-500">
                        <tr>
                        <th></th>
                        <th>品名</th>
                        <th>量</th>
                        <th>優先度</th>
                        <th>メモ</th>
                        <th>編集</th>
                        </tr>
                        </thead>
                        <tbody class="text-lg text-center py-1" name="form1">
                        @foreach($shopping_lists as $shopping_list)
                            <tr class="whitespace-nowrap text-lg text-center border-t border-solid border-gray-300 border-opacity-60">
                            <td><input type="checkbox" name="food_list" id="checkbox{{ $shopping_list->id }}" onclick="shoppingListCheck();"></td>
                            <td id="name{{ $shopping_list->id }}">{{ $shopping_list->food->name }}</td>
                            <td>{{ $shopping_list->quantity }}</td>
                            <td>{{ $shopping_list->priority }}</td>
                            <td>{{ $shopping_list->memo }}</td>
                            <td class="flex">
                                <a href="{{  route('user.shopping_lists.edit', [ 'shopping_list' => $shopping_list])  }}" id="edit{{ $shopping_list->id }}" class="mx-auto">編集</a>
                                <div class="w-1/6 hidden mx-auto" id="delete{{ $shopping_list->id }}">
                                <form  action="{{ route('user.shopping_lists.destroy', ['shopping_list'=>$shopping_list]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="my-auto shadow-inner  bg-opacity-60 rounded-sm">
                                <svg width="12px" height="12px" viewBox="0 0 12 12" >
                                    <line x1="0" y1="12" x2="12" y2="0" stroke="black" stroke-width="2"/>
                                    <line x1="0" y1="0" x2="12" y2="12" stroke="black" stroke-width="2"/>
                                </svg>
                                </button>
                                </form>
                                </div>
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


function shoppingListCheck() {
    
    @foreach($shopping_lists as $shopping_list)

    let foodListName{{ $shopping_list->id }} = document.getElementById('name{{ $shopping_list->id }}');
    let foodListDelete{{ $shopping_list->id }} = document.getElementById('delete{{ $shopping_list->id }}');
    let foodListEdit{{ $shopping_list->id }} = document.getElementById('edit{{ $shopping_list->id }}');

    if (document.getElementById('checkbox{{ $shopping_list->id }}').checked) {
        foodListName{{ $shopping_list->id }}.classList.add('line-through');
        foodListDelete{{ $shopping_list->id }}.classList.remove('hidden');
        foodListEdit{{ $shopping_list->id }}.classList.add('hidden');
    } else {
        foodListName{{ $shopping_list->id }}.classList.remove('line-through');
        foodListDelete{{ $shopping_list->id }}.classList.add('hidden');
        foodListEdit{{ $shopping_list->id }}.classList.remove('hidden');
    }  
    @endforeach
}


</script>
@endsection