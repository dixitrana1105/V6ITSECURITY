<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\Visitor_Master;
use App\Models\SchoolSecurityVisitor;

class VisitoreOutController extends Controller
{
    /**
     * Add an out-time remark for a visitor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_out_remark(Request $request)
    {
        // dd($request);
        $request->validate([
            'type' => 'required|in:school,building',
            'visitor_id' => 'required',
            'building_id' => 'required|integer',
            'out_time_remark' => '',
        ]);

        // dd($request->visitor_id);
        $type = $request->input('type');
        $securityId = $request->input('visitor_id');
        $buildingId = $request->input('building_id');
        $remark = $request->input('out_time_remark');

        if ($type === 'building') {
            // $visitor = Visitor_Master::find($securityId);
            $visitor = Visitor_Master::where('visitor_id', $securityId)->first();

            // dd($visitor);
            if ($visitor) {
                $visitor->out_time_remark = !empty($remark) ? $remark : 'OUT';
                $visitor->out_time = Carbon::now('Asia/Kolkata')->format('H:i');
                $visitor->building_id = $buildingId;
                $visitor->save();
                
                   if ($request->card_returned == 1) {
                    $cardId = $visitor->card_id;
                    if ($cardId) {
                        Card::where('id', $cardId)->update(['assign_status' => 'unassigned']);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Visitor_Master record not found.',
                ], 404);
            }
        } elseif ($type === 'school') {
            $visitor = SchoolSecurityVisitor::where('visitor_id', $securityId)->first();

            if ($visitor) {
                $visitor->out_time_remark = $remark;
                $visitor->out_time = Carbon::now('Asia/Kolkata')->format('H:i');
                $visitor->save();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'SchoolSecurityVisitor record not found.',
                ], 404);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Out time remark updated successfully.',
        ], 200);
    }
}
