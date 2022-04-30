<div class="container">
    <div class="flex justify-center items-center">
        <div class="w-1/3">
           <ul>
               @foreach($parents as $parent)
               <li class="p-3">
                   <div class="flex justify-between items-center">
                       <h4 class="font-medium text-md text-slate-900">{{$parent->creator->name}}</h4>
                        <div class="text-sm text-slate-600">{{$parent->formatted->created_at}}</div>
                    </div>
                   <div>{{$parent->description}}</div>
               </li>
               @endforeach
              
               <li class="p-3 bg-gray-200">
               <div class="flex justify-between items-center">
                       <h4 class="font-medium text-md text-slate-900">{{$message->creator->name}}</h4>
                       <div class="text-sm text-slate-600">{{$message->formatted->created_at}}</div>
                  
                    </div>    
                   <div>
                   {{$message->description}}
                   </div>
               </li>
               @foreach($children as $child)
               <li class="p-3">
                   <div class="flex justify-between items-center">
                       <h4 class="font-medium text-md text-slate-900">{{$child->creator->name}}</h4>
                        <div class="text-sm text-slate-600">{{$child->formatted->created_at}}</div>
                    </div>
                   <div>{{$child->description}}</div>
               </li>
               @endforeach
           </ul>
        </div>
    </div>
</div>