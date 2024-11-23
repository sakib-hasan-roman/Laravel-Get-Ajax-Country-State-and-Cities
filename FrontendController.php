use Illuminate\Support\Facades\File;

    public function getCountry()
    {
        $countries = json_decode(File::get(database_path('json/countries.json')), true)['countries'];
        return view('Frontend.Pages.getcountry', compact('countries'));
    }


    public function getStates($countryId)
    {
        $states = json_decode(File::get(database_path('json/states.json')), true)['states'];
        $filteredStates = collect($states)->where('country_id', $countryId)->values();
        return response()->json($filteredStates);
    }

    public function getCities($stateId)
    {
        $cities = json_decode(File::get(database_path('json/cities.json')), true)['cities'];
        $filteredCities = collect($cities)->where('state_id', $stateId)->values();
        return response()->json($filteredCities);
    }

