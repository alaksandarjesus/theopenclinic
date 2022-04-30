<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\MessageRequest;
use App\Models\Messages\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessagesController extends Controller
{
    public function index(Request $request)
    {

        $from = $request->query('from', Carbon::now()->subDays(30)->format('d-m-Y'));
        $to = $request->query('to', Carbon::now()->format('d-m-Y'));
        $q = $request->query('q');

        $start = Carbon::parse($from)->startOfDay();
        $end = Carbon::parse($to)->endOfDay();

        $messages = Message::when($q, function ($query) use ($q) {
            return $query->where('description', 'LIKE', '%' . $q . '%');
        })->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'DESC')->get();

        return view('messages.index', compact('messages', 'from', 'to'));
    }

    public function create(Request $request)
    {

        $message = new Message;

        $parents = [];

        $children = [];

        return view('messages.form', compact('message', 'parents', 'children'));
    }

    public function reply($uuid, Request $request)
    {

        $message = Message::where('uuid', $uuid)->first();

        if (empty($message)) {

            return redirect()->to('404');
        }
        $parents = $this->get_message_parents($message);
        $children = $this->get_message_children($message);

        return view('messages.form', compact('message', 'parents', 'children'));
    }
    public function save(MessageRequest $request)
    {
        $validated = (object) $request->validated();
        $message = new Message;
        $message->uuid = Str::uuid();
        $message->created_by = $request->user->id;
        if (!empty($validated->uuid)) {
            $parent_message = Message::where('uuid', $validated->uuid)->first();
            $message->parent_id = $parent_message->id;
        }

        $message->description = $validated->description;
        $message->save();

        return response()->json(['redirect' => url('/messages')]);
    }
    public function delete($uuid, Request $request)
    {
        $message = Message::where('uuid', $uuid)->first();
        if (empty($message)) {
            $err = [
                'message' => 'Missing message',
                'errors' => ['Unidentified message'],
            ];
            return response()->json($err, 422);
        }

        $parents = $this->get_message_parents($message);
        $children = $this->get_message_children($message);
        
        foreach ($parents as $parent) {
            $parent->deleted_by = $request->user->id;
            $parent->save();
            $parent->delete();
        }
        foreach ($children as $child) {
            $child->deleted_by = $request->user->id;
            $child->save();
            $child->delete();
        }

        $message->deleted_by = $request->user->id;
        $message->save();
        $message->delete();
        return response()->json(['redirect' => url('/messages')]);
    }

    private function get_message_parents($message){

        $parents = [];
        $temp = clone $message;
        while (!empty($temp->parent)) {
            $temp = $temp->parent;
            $parents[] = $temp;
        }
        $parents = array_reverse($parents);

        return $parents;

    }

    private function get_message_children($message){
        $children = [];
        $temp = clone $message;
        while (!empty($temp->children)) {
            $temp = $temp->children;
            $children[] = $temp;
        }
        return $children;
    }
}
