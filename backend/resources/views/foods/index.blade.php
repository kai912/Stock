@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl md:px-10">
        <div class="grid sm:grid-cols-3 gap-4">
            <div class="pb-4 shadow-lg rounded-lg">
                <nav>
                <div class="flex justify-between bg-gray-50 bg-opacity-50 w-full border-b-2 border-gray-200 text-gray-400 font-bold lg:text-xl">
                    <div class="my-auto pl-4">分類</div>
                    <div class="py-4">
                        <a href="{{ route('admin.categories.create') }}" class="my-10 px-4 mr-2 py-2 border-b-2 border-gray-200 hover:border-gray-500">
                        分類を追加する
                        </a>
                    </div>
                </div>
                <ul class="w-full mb-4">
                    @foreach($categories as $category)
                    <li class="text-lg text-center border-b-4 border-double border-gray-300 mx-4 px-4"><a class="" href="{{ route('admin.foods.index', ['id' => $category->id]) }}">
                        {{ $category->name }}
                    </a></li>
                    @endforeach
                </ul>
                </nav>
            </div>
            <div class="sm:col-span-2">
                <div class=" bg-gray-50 bg-opacity-50 shadow-inner rounded-lg pb-4">
                    <div class="flex justify-between text-gray-400 px-4 border-b-2 bg-white bg-opacity-50 mb-4">
                        <div class="font-bold text-xl my-auto">食べ物</div>
                        <div class="py-4">
                        <a href="{{ route('admin.foods.create', ['id' => $current_category_id]) }}" class="px-4 py-2 border-b-2 border-gray-200 font-bold hover:border-gray-500">
                            食べ物を追加する
                        </a>
                        </div>
                    </div>
                    <table class="table-fixed w-full mb-4">
                        <thead class="text-lg border-b-4 border-double border-gray-300">
                            <tr>
                                <th class="w-1/6">品名</th>
                                <th class="w-1/12">量</th>
                                <th class="w-1/12">単位</th>
                                <th class="w-1/6 hidden md:table-cell">P</th>
                                <th class="w-1/6 hidden md:table-cell">F</th>
                                <th class="w-1/6 hidden md:table-cell">C</th>
                                <th class="w-1/6">編集</th>
                            </tr>
                        </thead>
                        <tbody class="text-lg text-center py-1">
                        @foreach($foods as $food)
                            <tr class="whitespace-nowrap text-lg text-center border-t border-solid border-gray-300 border-opacity-60">
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->volume }}</td>
                                <td>{{ $food->unit }}</td>
                                <td class="hidden md:table-cell">{{ $food->protein}}</td>
                                <td class="hidden md:table-cell">{{ $food->fat }}</td>
                                <td class="hidden md:table-cell">{{ $food->carbohydrate }}</td>
                                <td><a href="{{  route('admin.foods.edit', ['id' => $food->category_id, 'food_id' => $food->id])  }}">編集</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
