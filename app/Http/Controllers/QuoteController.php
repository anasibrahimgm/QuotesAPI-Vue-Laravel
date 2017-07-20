<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use JWTAuth;
use App\User;

class QuoteController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth.jwt')->except(['getQuotes']);
    }

    public function createQuote (Request $request)
    {
      $user = JWTAuth::parseToken()->toUser();
      //retrievs the authenticated user

      $this->validate($request, [
        'content' => 'required|min:10',
      ]);

      $quote = new Quote();
      $quote->content = $request->input('content');
      $quote->user()->associate($user);
      $quote->save();

      return response()->json(['quote' => $quote, 'user' => $user], 201);
    }

    public function getQuotes ()
    {
      $quotes = Quote::all();
      $response = [
        'quotes' => $quotes
      ];

      return response()->json($response, 200);
    }

    public function getQuote ($id)
    {
      $quote = Quote::find($id);
      $response = [
        'quote' => $quote
      ];

      return response()->json($response, 200);
    }

    public function updateQuote (Request $request, $id)
    {
      $quote = Quote::find($id);
      if (!$quote) {
        return response()->json(['message' => 'Quote Not Found'], 404);
      }
      $quote->content = $request->content;
      $quote->save();

      return response()->json(['quote', $quote], 200);
    }

    public function deleteQuote ($id)
    {
      $quote = Quote::find($id);
      $quote->delete();

      return response()->json(['message' => 'Quote Deleted'], 200);
    }
}
