@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <div class="flex justify-between items-center">
        <h4 class="font-medium text-xl ">{{$drug->name}} History</h4>
        <div>
            @include('pharmacy.drugs.history-filter')
        </div>
    </div>
</div>

<div class="container mt-3">
<div class="overflow-auto">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="p-2 border border-gray-700" style="width:60px">S.No</th>
                <th class="p-2 border border-gray-700" style="width:180px">Ref</th>
                <th class="p-2 border border-gray-700" style="width:60px">Ordered</th>
                <th class="p-2 border border-gray-700" style="width:60px">Received</th>
                <th class="p-2 border border-gray-700" style="width:60px">Purchase Return</th>
                <th class="p-2 border border-gray-700" style="width:60px">Invoice</th>
                <th class="p-2 border border-gray-700" style="width:60px">Invoice Return</th>
                <th class="p-2 border border-gray-700">Datetime</th>
                <th class="p-2 border border-gray-700">Price</th>
                <th class="p-2 border border-gray-700">Tax</th>
                <th class="p-2 border border-gray-700">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
            <tr>
                <td class="p-2 border border-gray-700 text-center">{{$loop->iteration}}</td>
                <td class="p-2 border border-gray-700">{{$row->ref}}</td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Purchase Item')
                    {{$row->item->qty}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700 text-center">
                    @if($row->ref === 'Purchase Inventory')
                    {{$row->item->qty}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Purchase Return')
                    {{$row->item->qty}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700 text-center">
                    @if($row->ref === 'Invoice Item')
                    {{$row->item->qty}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Invoice Return')
                    {{$row->item->qty}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700">
                    {{$row->datetime}}
                </td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Purchase Return' || $row->ref === 'Purchase Item')
                    {{$row->item->formatted->cost}}
                    @endif
                    @if($row->ref === 'Invoice Item' || $row->ref === 'Invoice Return')
                    {{$row->item->formatted->price}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Purchase Return' || $row->ref === 'Purchase Item')
                    {{$row->item->formatted->tax}}
                    @endif
                    @if($row->ref === 'Invoice Item' || $row->ref === 'Invoice Return')
                    {{$row->item->formatted->tax}}
                    @endif
                </td>
                <td class="p-2 border border-gray-700  text-center">
                    @if($row->ref === 'Purchase Return' || $row->ref === 'Purchase Item')
                    {{$row->item->formatted->total}}
                    @endif
                    @if($row->ref === 'Invoice Item' || $row->ref === 'Invoice Return')
                    {{$row->item->formatted->total}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>


@endsection