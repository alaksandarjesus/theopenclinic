<div class="overflow-auto hidden md:block">
    <table class="table-auto w-full appointments-list ">
        <thead>
            <tr>
                <th class="border border-gray-1 p-3">S.No</th>
                <th class="border border-gray-1 p-3">Doctor</th>
                <th class="border border-gray-1 p-3">Patient</th>
                <th class="border border-gray-1 p-3">Date & Time</th>
                @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                'Administrator', 'Super Administrator']))
                <th class="border border-gray-1 p-3">Paid</th>
                @endif
                <th class="border border-gray-1 p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr data-uuid="{{$appointment->uuid}}" class="{{!empty($appointment->consultation)?'bg-green-200':''}}">
                <td class="border border-gray-1 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-1 p-3">{{$appointment->doctor->name}}</td>
                <td class="border border-gray-1 p-3 name">{{$appointment->patient->name}}</td>
                <td class="border border-gray-1 p-3">{{$appointment->formatted->date}} {{$appointment->formatted->time}}
                </td>
                @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                'Administrator', 'Super Administrator']))
                <td class="border border-gray-1 p-3 text-center">
                    {{$appointment->paid}}
                </td>
                @endif
                <td class="border border-gray-1 p-3">
                    <div class="flex justify-between items-center">

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk', 'Doctor',
                        'Administrator', 'Super Administrator']))
                        @if(!empty($appointment->consultation))
                        <a href="{{url('appointments/'.$appointment->uuid.'/print')}}" target="_blank" class="btn-print"
                            data-tippy-content="Print">
                            @include('components.icons', ['icon'=> 'print'])
                        </a>
                        @endif
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        <a class="btn-payment" data-tippy-content="Payment"
                            href="{{url('appointments/'.$appointment->uuid.'/payments')}}">@include('components.icons',
                            ['icon'=>
                            'payments', 'className' => 'fill-teal-900'])</a>
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Doctor', 'Administrator',
                        'Super Administrator']))
                        @if($appointment->can_consult)
                        <a class="btn-consultation" data-tippy-content="Consultation"
                            href="{{url('appointments/'.$appointment->uuid.'/consultation')}}">@include('components.icons',
                            ['icon'=>
                            'account-box', 'className' => 'fill-green-700'])</a>
                        @endif
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        @if($appointment->can_consult)

                        <a class="btn-pre-consultation" data-tippy-content="Pre Consultation"
                            href="{{url('appointments/'.$appointment->uuid.'/pre-consultation')}}">@include('components.icons',
                            ['icon'=>
                            'fact-check', 'className' => 'fill-gray-700'])</a>
                        @endif

                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        @if($appointment->can_edit)
                        <a class=" btn-edit" data-tippy-content="Edit"
                            href="{{'appointments/edit/'.$appointment->uuid}}">@include('components.icons', ['icon'=>
                            'edit'])</a>
                        @endif
                        @endif

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


<div class="overflow-auto block md:hidden">
    <table class="table-auto w-full appointments-list ">

        <tbody>
            @foreach($appointments as $appointment)
            <tr data-uuid="{{$appointment->uuid}}" class="{{!empty($appointment->consultation)?'bg-green-200':''}}">
                <td class="border p-3 text-center">
                    <div class="p-3 text-left"><strong>Doctor: </strong> {{$appointment->doctor->name}}</div>
                    <div class="p-3 text-left"><strong>Patient: </strong> {{$appointment->patient->name}}</div>
                    <div class="p-3 text-left"><strong>Date: </strong> {{$appointment->formatted->date}}</div>
                    <div class="p-3 text-left"><strong>Time: </strong> {{$appointment->formatted->time}}</div>
                    @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                    'Administrator', 'Super Administrator']))
                    <div class=" p-3 text-left">
                        <strong>Paid: </strong>{{$appointment->paid}}
                    </div>
                    @endif
                    <div class="flex justify-between items-center">

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk', 'Doctor',
                        'Administrator', 'Super Administrator']))
                        @if(!empty($appointment->consultation))
                        <a href="{{url('appointments/'.$appointment->uuid.'/print')}}" target="_blank" class="btn-print"
                            data-tippy-content="Print">
                            @include('components.icons', ['icon'=> 'print'])
                        </a>
                        @endif
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        <a class="btn-payment" data-tippy-content="Payment"
                            href="{{url('appointments/'.$appointment->uuid.'/payments')}}">@include('components.icons',
                            ['icon'=>
                            'payments', 'className' => 'fill-teal-900'])</a>
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Doctor', 'Administrator',
                        'Super Administrator']))
                        @if($appointment->can_consult)
                        <a class="btn-consultation" data-tippy-content="Consultation"
                            href="{{url('appointments/'.$appointment->uuid.'/consultation')}}">@include('components.icons',
                            ['icon'=>
                            'account-box', 'className' => 'fill-green-700'])</a>
                        @endif
                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        @if($appointment->can_consult)

                        <a class="btn-pre-consultation" data-tippy-content="Pre Consultation"
                            href="{{url('appointments/'.$appointment->uuid.'/pre-consultation')}}">@include('components.icons',
                            ['icon'=>
                            'fact-check', 'className' => 'fill-gray-700'])</a>
                        @endif

                        @endif

                        @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
                        'Administrator', 'Super Administrator']))
                        @if($appointment->can_edit)
                        <a class=" btn-edit" data-tippy-content="Edit"
                            href="{{'appointments/edit/'.$appointment->uuid}}">@include('components.icons', ['icon'=>
                            'edit'])</a>
                        @endif
                        @endif

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


<div class="clear-both"></div>
<div class="flex justify-end items-center my-3">
{{ $appointments->links('vendor.pagination.tailwind') }}
</div>