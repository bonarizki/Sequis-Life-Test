<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Requests\FriendRequest;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function store(FriendRequest $request)
    {
        $request->merge([
            "status" => "pending"
        ]);

        try {
            Friend::create($request->all());
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }
        
        return response()->json(["success" => true]);
    }

    /**
     * update
     *
     * @param mixed $type is accept or reject
     * 
     * @return [type]
     * 
     */
    public function update(FriendRequest $request,$type)
    {
        try {
            Friend::where('requestor', $request->requestor)
                ->where('to', $request->to)
                ->update([
                    "status" => $type == 'accept' ? 'accepted' : 'rejected'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }
        
        return response()->json(["success" => true]);
    }

    public function showRequest($email)
    {
        try {
            $data = Friend::select('requestor','status')
                ->where('to',$email)
                ->get();
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }

        $result = count($data) > 0 ? $data->toArray() : "no friend request";

        return response()->json(["request" => $result]);
    }

    public function showFriend($email)
    {
        try {
            $data = Friend::select('to')
                ->where('requestor',$email)
                ->where('status','accepted')
                ->get();
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }

        $result = count($data) > 0 ? $data->pluck('to') : "no friend request";

        return response()->json(["friends" => $result]);
    }

    public function showSameFriend(Request $request)
    {
        try {
            $data = Friend::select('to', DB::raw('count(*) as total'))
                ->whereIN('requestor',$request->friends)
                ->where('status','accepted')
                ->groupBy('to')
                ->having('total','>','1')
                ->get();
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }

        $result = count($data) > 0 ? $data->pluck('to') : "no friend request";

        return response()->json([
            "success" => "true",
            "friends" => $result,
            "count" => count($result)
        ]);
    }

    public function blockFriend(Request $request)
    {
        try {
            Friend::where('requestor', $request->requestor)
                ->where('to', $request->block)
                ->update([
                    "status" => "blocked"
            ]);
        } catch (\Throwable $th) {
            return response()->json(["failed" => true]);
        }
        
        return response()->json(["success" => true]);
    }
}
