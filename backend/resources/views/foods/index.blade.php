@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto max-w-screen-xl md:px-10">
        <div class="grid sm:grid-cols-3 gap-4 items-start">
            <div class="pb-4 shadow-lg rounded-lg">
                <nav>
                <div class="flex justify-between bg-gray-50 bg-opacity-50 w-full border-b-2 border-gray-200 text-gray-400 font-bold">
                    <div class="my-auto pl-4 lg:text-xl">分類</div>
                    <div class="py-4">
                        <a href="{{ route('admin.categories.create') }}" class="my-10 px-4 mr-2 py-2 border-b-2 border-gray-200 hover:border-gray-500">
                        分類を追加する
                        </a>
                    </div>
                </div>
                <ul class="w-full mb-4">
                    @foreach($categories as $category)
                    <li class="text-lg text-center border-b-2  border-gray-300 mx-4 px-4 py-1 text-gray-400 {{ $current_category_id === $category->id ? 'text-gray-700 border-gray-700' : '' }}"><a class="" href="{{ route('admin.foods.index', ['id' => $category->id]) }}">
                        {{ $category->name }}
                    </a></li>
                    @endforeach
                </ul>
                </nav>
            </div>
            <div class="sm:col-span-2">
                <div class=" bg-gray-50 bg-opacity-50 shadow-inner rounded-lg pb-4">
                    <div class="flex justify-between text-gray-400 px-4 border-b-2 bg-white bg-opacity-50 mb-4">
                        <div class="font-bold my-auto lg:text-xl">食べ物</div>
                        <div class="py-4">
                        <a href="{{ route('admin.foods.create', ['id' => $current_category_id]) }}" class="px-4 py-2 border-b-2 border-gray-200 font-bold hover:border-gray-500">
                            食べ物を追加する
                        </a>
                        </div>
                    </div>
                    <div class="mx-4">
                    <table class="w-full mb-4 text-gray-500">
                        <thead class="text-lg border-b-4 border-double border-gray-500">
                            <tr>
                                <th>品名</th>
                                <th>量</th>
                                <th>単位</th>
                                <th class="hidden md:table-cell">P</th>
                                <th class="hidden md:table-cell">F</th>
                                <th class="hidden md:table-cell">C</th>
                                <th>編集</th>
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
                    {{ $foods->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
