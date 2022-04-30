<div class="overflow-auto">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th rowspan="2" class="p-2 border border-gray-200" style="width:60px"></th>
                <th rowspan="2" class="p-2 border border-gray-200">Drug</th>
                <th rowspan="2" class="p-2 border border-gray-200" style="width:50px">Days</th>
                <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Breakfast</th>
                <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Lunch</th>
                <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Evening</th>
                <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Dinner</th>
            </tr>
            <tr>
                <th class="p-2 border border-gray-200" style="width:50px">B</th>
                <th class="p-2 border border-gray-200" style="width:50px">A</th>
                <th class="p-2 border border-gray-200" style="width:50px">B</th>
                <th class="p-2 border border-gray-200" style="width:50px">A</th>
                <th class="p-2 border border-gray-200" style="width:50px">B</th>
                <th class="p-2 border border-gray-200" style="width:50px">A</th>
                <th class="p-2 border border-gray-200" style="width:50px">B</th>
                <th class="p-2 border border-gray-200" style="width:50px">A</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultation->prescription->drugs as $row)
            <tr>
                <td class="p-2 border border-gray-200 text-center">{{$loop->iteration}}</td>
                <td class="p-2 border border-gray-200">{{$row->drug->name}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$row->days}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->bb}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->ab}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->bl}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->al}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->be}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->ae}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->bd}}</td>
                <td class="p-2 border border-gray-200 text-center">{{ $row->ad}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="11" class="p-2 border border-gray-200 text-left">{{ $consultation->prescription->comments}}
                </td>
            </tr>
        </tfoot>
    </table>
</div>