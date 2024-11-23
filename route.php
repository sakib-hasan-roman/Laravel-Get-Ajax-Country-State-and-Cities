Route::get('/states/{countryId}', [FrontendController::class, 'getStates'])->name('states');
Route::get('/cities/{stateId}', [FrontendController::class, 'getCities'])->name('cities');
