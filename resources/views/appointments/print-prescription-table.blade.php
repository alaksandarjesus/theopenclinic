<div class="overflow-auto">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th rowspan="2" class="p-2 border border-gray-200 text-center" style="width:60px">S.No</th>
                <th rowspan="2" class="p-2 border border-gray-200 text-center">Drug</th>
                <th rowspan="2" class="p-2 border border-gray-200 text-center" style="width:100px">Days</th>
                <th colspan="2" class="p-2 border border-gray-200 text-center" style="width:200px">Breakfast</th>
                <th colspan="2" class="p-2 border border-gray-200 text-center" style="width:200px">Lunch</th>
                <th colspan="2" class="p-2 border border-gray-200 text-center" style="width:200px">Evening</th>
                <th colspan="2" class="p-2 border border-gray-200 text-center" style="width:200px">Dinner</th>
            </tr>
            <tr>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">B</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">A</th>

                <th class="p-2 border border-gray-200 text-center" style="width:100px">B</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">A</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">B</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">A</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">B</th>
                <th class="p-2 border border-gray-200 text-center" style="width:100px">A</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointment->consultation->prescription->drugs as $index => $drug)
            <tr>
                <td class="p-2 border border-gray-200 text-center">{{($index + 1)}}</td>
                <td class="p-2 border border-gray-200">{{$drug->drug->name}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->days}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->bb}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->ab}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->bl}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->al}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->be}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->ae}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->bd}}</td>
                <td class="p-2 border border-gray-200 text-center">{{$drug->ad}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" class="p-2 border border-gray-200 text-left">
                    {{$appointment->consultation->prescription->comments}}</td>
            </tr>
        </tfoot>
    </table>
</div>