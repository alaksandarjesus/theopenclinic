<div class="overflow-auto">
    <table class="table-auto w-full expenditures">
        <thead>
            <tr>
                <th class="border border-gray-200 p-3">S.No</th>

                <th class="border border-gray-200 p-3">Date</th>
                <th class="border border-gray-200 p-3">Amount</th>
                <th class="border border-gray-200 p-3">Description</th>
                <th class="border border-gray-200 p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenditures as $expenditure)
            <tr data-uuid="{{$expenditure->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 expdate">{{$expenditure->formatted->date}}</td>
                <td class="border border-gray-200 p-3 amount">{{$expenditure->amount}}</td>
                <td class="border border-gray-200 p-3 description">{{$expenditure->description}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-center items-center">
                        <button class="mr-2 btn-edit" data-tippy-content="Edit">@include('components.icons', ['icon'=>
                            'edit'])</button>

                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete">@include('components.icons', ['icon'=>
                            'delete'])</button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>