<div class="overflow-auto">
<table class="table-auto w-full messages">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Description</th>
            <th class="border border-gray-200 p-3">Created By</th>
            <th class="border border-gray-200 p-3">Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
        <tr data-uuid="{{$message->uuid}}" class="cursor-pointer hover:bg-gray-200" data-href="{{url('messages/'.$message->uuid.'/reply')}}">
            <td class="border border-gray-200 p-3">{{$loop->iteration}}</td>
            <td class="border border-gray-200 p-3 description">{{$message->description}}</td>
            <td class="border border-gray-200 p-3">{{$message->creator->name}}</td>
            <td class="border border-gray-200 p-3">{{$message->formatted->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>