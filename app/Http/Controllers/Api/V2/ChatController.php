<?php

namespace App\Http\Controllers\Api\V2;

use App\Conversation;
use App\Http\Resources\V2\ConversationCollection;
use App\Http\Resources\V2\MessageCollection;
use App\Mail\ConversationMailManager;
use App\Message;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Mail;

class ChatController extends Controller
{

    public function conversations($id)
    {
        $conversations = Conversation::where('sender_id', $id)->latest('id')->paginate(10);
        return new ConversationCollection($conversations);
    }

    public function messages($id)
    {
        $messages = Message::where('conversation_id', $id)->latest('id')->paginate(10);
        return new MessageCollection($messages);
    }

    public function insert_message(Request $request)
    {
        $message = new Message;
        $message->conversation_id = $request->conversation_id;
        $message->user_id = $request->user_id;
        $message->message = $request->message;
        $message->save();
        $conversation = $message->conversation;
        if ($conversation->sender_id == $request->user_id) {
            $conversation->receiver_viewed = "1";
        } elseif ($conversation->receiver_id == $request->user_id) {
            $conversation->sender_viewed = "1";
        }
        $conversation->save();
        $messages = Message::where('id', $message->id)->paginate(1);
        return new MessageCollection($messages);
    }

    public function get_new_messages($conversation_id, $last_message_id)
    {
        $messages = Message::where('conversation_id', $conversation_id)->where('id', '>', $last_message_id)->latest('id')->paginate(10);
        return new MessageCollection($messages);
    }

    public function create_conversation(Request $request)
    {
        $seller_user = Product::findOrFail($request->product_id)->user;
        $user = User::find($request->user_id);
        $conversation = new Conversation;
        $conversation->sender_id = $user->id;
        $conversation->receiver_id = Product::findOrFail($request->product_id)->user->id;
        $conversation->title = $request->title;

        if ($conversation->save()) {
            $message = new Message;
            $message->conversation_id = $conversation->id;
            $message->user_id = $user->id;
            $message->message = $request->message;

            if ($message->save()) {
                $this->send_message_to_seller($conversation, $message, $seller_user, $user);
            }
        }

        return response()->json(['result' => true, 'conversation_id' => $conversation->id,
            'shop_name' => $conversation->receiver->user_type == 'admin' ? 'In House Product' : $conversation->receiver->shop->name,
            'shop_logo' => $conversation->receiver->user_type == 'admin' ? api_asset(get_setting('header_logo'))  : api_asset($conversation->receiver->shop->logo),
            'title'=> $conversation->title,
            'message' => "Conversation created",]);
    }

    public function send_message_to_seller($conversation, $message, $seller_user, $user)
    {
        $array['view'] = 'emails.conversation';
        $array['subject'] = 'Sender:- ' . $user->name;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Hi! You recieved a message from ' . $user->name . '.';
        $array['sender'] = $user->name;

        if ($seller_user->type == 'admin') {
            $array['link'] = route('conversations.admin_show', encrypt($conversation->id));
        } else {
            $array['link'] = route('conversations.show', encrypt($conversation->id));
        }

        $array['details'] = $message->message;

        try {
            Mail::to($conversation->receiver->email)->queue(new ConversationMailManager($array));
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }

    }
}
