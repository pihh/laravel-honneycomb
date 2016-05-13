    /**
    |---------------------------
    | Otherwise Routes (Place this in the end of the routes file)
    | Log Access to unauthorized routes (HonneyComb to all routes)
    |---------------------------
     */


    Route::any('{slug?}', function(){

        // Log the attempt
        $warning = new \stdClass();
        $warning->trigger = 'HonneyComb Alert';
        if(\Illuminate\Support\Facades\Auth::user()){
            $warning->user = \Illuminate\Support\Facades\Auth::user();
        }else{
            $warning->user = 'Unknown user';
        }
        $warning->browser = browserInfo();

        \Illuminate\Support\Facades\Log::warning(json_encode($warning));

        // Redirect back
        return redirect()->back();
    })->where('slug', '.+');