@if(session()->has('message'))
    @if(is_array(session()->get('message')))
        @foreach(session()->get('message') as $message)
            <div class="max-w-7xl flex justify-between">
                <div class="col-12">
                    <div class="w-full py-3 px-5 mb-4 bg-purple-100 text-purple-900 text-sm rounded-md border border-purple-200" role="alert">
                        {{ $message }}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="p-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between">
            <div class="col-12">
                <div class="py-3 px-5 mb-4 bg-purple-100 text-purple-900 text-sm rounded-md border border-purple-200" role="alert">
                {{ session()->get('message') }}
                </div>
            </div>
        </div>
    @endif
@endif
