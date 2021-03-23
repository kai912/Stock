@extends('layouts.user.app')

@section('content')

    <div class="container mx-auto max-w-screen-xl sm:px-10 px-4">
        <div class="bg-gray-50 bg-opacity-50 shadow-inner rounded-lg sm:pb-4">
            <div class="flex justify-between text-gray-400 px-4 border-b-2 bg-white bg-opacity-50 mb-2 sm:mb-4">
                <div class="cursor-default font-bold my-auto text-sm lg:text-xl">レシピ</div>
                <div class="py-4">
                    <a href="{{ route('user.recipes.create') }}" class="px-4 py-2 border-b-2 text-sm sm:text-lg border-gray-200 font-bold hover:border-gray-500">
                        レシピの追加
                    </a>
                </div>
            </div>
            <div class="pb-4">
                <div class="accordion-container">
                @foreach($recipes as $recipe)
                    <div class="accordion-title mx-2 sm:mx-4 py-1 text-gray-400 text-sm sm:text-lg border-b-2  border-gray-300">{{ $recipe->name }}</div>
                    <ul class="accordion-content list-disc list-inside hidden mx-2 sm:mx-4 py-1 text-gray-400 text-sm sm:text-lg border-b-2  border-gray-300">
                        @foreach($recipe->foods as $food)
                        <li class="border-gray-300 border-opacity-60 align-middle">{{ $food->name }} {{ $food->pivot->count * $food->volume }}{{ $food->unit }}</li>
                        @endforeach
                    </ul>
                    <a href="{{  route('user.recipes.edit', [ 'recipe' => $recipe])  }}" class="mx-auto">編集</a>
                    <div>
                    <form  action="{{ route('user.recipes.destroy', ['recipe'=>$recipe]) }}" method="POST">
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
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
document.addEventListener("DOMContentLoaded",() => {
    const title = document.querySelectorAll('.accordion-title');

    for (let i = 0; i < title.length; i++){
        let titleEach = title[i];
        let content = titleEach.nextElementSibling;
        
        titleEach.addEventListener('click', () => {
            titleEach.classList.toggle('text-gray-600');
            content.classList.toggle('hidden');
        });
    }

});



</script>
@endsection