<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::with('store');

        if ($request->filled('search')) {
            $s = $request->get('search');
            $query->where(function($q) use ($s){
                $q->where('item_code','like', "%{$s}%")
                  ->orWhere('item_name','like', "%{$s}%")
                  ->orWhere('location','like', "%{$s}%");
            });
        }

        if ($request->filled('sortField')) {
            $query->orderBy($request->get('sortField'), $request->get('sortDir','asc'));
        } else {
            $query->orderBy('id','desc');
        }

        $page = max(1, (int)$request->get('page',1));
        $size = (int)$request->get('size', 25);

        $paginator = $query->paginate($size, ['*'], 'page', $page);

        return response()->json([
            'data' => $paginator->items(),
            // 'last_page' => $paginator->lastPage(),
            // 'total' => $paginator->total(),
            // 'current_page' => $paginator->currentPage()
        ]);
    }

    public function bulkStore(Request $request)
    {
        $requestecords = $request->get('records',[]);
        $created = [];
        foreach ($requestecords as $requestec) {
            $validated = Validator::make($requestec, [
                'item_code'=>'required',
                'item_name'=>'required',
                'quantity'=>'required|integer',
                'store_id'=>'required|exists:stores,id',
                'in_stock_date'=>'required|date'
            ])->validate();
            $created[] = Stock::create($validated);
        }
        return response()->json(['created'=>$created], 201);
    }

    public function destroy($id)
    {
        $s = Stock::findOrFail($id);
        $s->delete();
        return response()->json(['message'=>'deleted']);
    }
}
