<?php


use App\Mail\capslokmail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    $profile_types = DB::table('profile_types')->get();

    return view('welcome')
            ->with('profile_types', $profile_types);
});*/


Auth::routes(['verify' => true]);

/*
 * Home / Welcome routes
 */

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/filter', ['as' => 'user.whereDoIVote', 'uses' => 'HomeController@whereDoIVote']);
Route::get('/filteraddress', ['as' => 'searchby.homeaddress', 'uses' => 'HomeController@searchByHomeAddress']);
Route::get('/allPoliticiansInfoView', ['as' => 'home.allPoliticiansInfoView', 'uses' => 'HomeController@allPoliticiansInfoView']);
Route::post('/postalCodeSubmission', ['as' => 'home.postalCodeSubmission', 'uses' => 'HomeController@postalCodeSubmission']);
Route::get('/type/{id}', 'HomeController@searchByProfileType');
Route::get('/purpose/representatives', 'HomeController@getpurposeRepresentatives');
Route::get('/purpose/voters', 'HomeController@getpurposeVoters');
Route::get('/purpose/elections', 'HomeController@getpurposeElections');
Route::get('/info/representatives', 'HomeController@getInfoRepresentatives');
Route::get('/info/voters', 'HomeController@getInfoVoters');
Route::get('/info/elections', 'HomeController@getInfoElections');
Route::get('/info/votinginfo', 'HomeController@getInfoVotingInfo');
Route::get('/info/privacy', 'HomeController@getInfoPrivacyInfo');
Route::get('/services/capsfeed', 'HomeController@getServicesCapsFeedInfo');
Route::get('/services/capsinsight', 'HomeController@getServicesCapsInsightInfo');
Route::get('/services/capsread', 'HomeController@getServicesCapsReadInfo');

/*
 * Admin routes
 */

Route::post('/update-user-type', 'AdminController@updateUserType')->middleware('auth');
Route::post('/approve-pending-politician', 'AdminController@approvePendingPolitician')->middleware('auth');
Route::post('/decline-pending-politician', 'AdminController@declinePendingPolitician')->middleware('auth');
Route::get('/view/user/{id}', ['as' => 'view.user', 'uses' => 'AdminController@viewUser'])->middleware('auth');
Route::post('/delete-account', ['as' => 'delete.account', 'uses' => 'AdminController@deleteAccount'])->middleware('auth');
Route::post('/hide-account', ['as' => 'account.hideAccount', 'uses' => 'AdminController@hideAccount'])->middleware('auth');
Route::post('/show-account', ['as' => 'account.showAccount', 'uses' => 'AdminController@showAccount'])->middleware('auth');
Route::post('/add-candidate-email', ['as' => 'candidate.addCandidateEmail', 'uses' => 'AdminController@addCandidateEmail'])->middleware('auth');
Route::post('/invite-candidate', ['as' => 'candidate.sendInvitation', 'uses' => 'AdminController@inviteCandidate'])->middleware('auth');
Route::post('/unlock-account', ['as' => 'unlock.account', 'uses' => 'AdminController@unlockAccount'])->middleware('auth');
Route::post('/lock-account', ['as' => 'lock.account', 'uses' => 'AdminController@lockAccount'])->middleware('auth');

/*
 * Dev routes
 */

Route::get('/userlisting', ['as' => 'admin.userlisting', 'uses' => 'DevController@userlisting'])->middleware('auth');
Route::get('/updateCandidates', ['as' => 'admin.updateCandidates', 'uses' => 'DevController@updateCandidates'])->middleware('auth');
Route::post('/processNewCandidates', ['as' => 'admin.processNewCandidates', 'uses' => 'DevController@processNewCandidates'])->middleware('auth');
Route::post('/updateMap', ['as' => 'admin.updateMap', 'uses' => 'DevController@updateMap'])->middleware('auth');
Route::post('/addPoliticiansWithTypeFromJsonFile', ['as' => 'admin.addPoliticiansWithTypeFromJsonFile', 'uses' => 'DevController@addPoliticiansWithTypeFromJsonFile'])->middleware('auth');
Route::post('/updateMapURL', ['as' => 'admin.updateMapURL', 'uses' => 'DevController@updateMapURL'])->middleware('auth');
Route::get('/downloadKMLFile', ['as' => 'admin.downloadKMLFile', 'uses' => 'DevController@downloadKMLFile'])->middleware('auth');
Route::get('/regularuserlisting', ['as' => 'admin.regularuserlisting', 'uses' => 'DevController@regularuserlisting'])->middleware('auth');
Route::get('/moderatoruserlisting', ['as' => 'admin.moderatoruserlisting', 'uses' => 'DevController@moderatoruserlisting'])->middleware('auth');
Route::get('/adminuserlisting', ['as' => 'admin.adminuserlisting', 'uses' => 'DevController@adminuserlisting'])->middleware('auth');
Route::get('/politicianuserlisting', ['as' => 'admin.politicianuserlisting', 'uses' => 'DevController@politicianuserlisting'])->middleware('auth');
Route::get('/pendingpoliticianuserlisting', ['as' => 'admin.pendingpoliticianuserlisting', 'uses' => 'DevController@pendingpoliticianuserlisting'])->middleware('auth');
Route::get('/nonRegisteredPoliticianslisting', ['as' => 'admin.nonRegisteredPoliticianslisting', 'uses' => 'DevController@nonRegisteredPoliticianslisting'])->middleware('auth');
Route::get('/components/{component_name?}/{component_p1?}/{component_p2?}', 'DevController@components')->middleware('auth');

/*
 * Profile routes
 */

Route::get('/profile/{id}/{tab?}', 'ProfileController@show');
Route::post('/update-bio', 'ProfileController@store')->middleware('auth');
Route::post('/add-stance', 'ProfileController@addStance')->middleware('auth');
Route::post('/delete-stance', 'ProfileController@deleteStance')->middleware('auth');
Route::post('/update-stance-title', 'ProfileController@updateTitle')->middleware('auth');
Route::post('/update-aboutme', 'ProfileController@updateAboutme')->middleware('auth');
Route::post('/update-stance-content', 'ProfileController@updateContent')->middleware('auth');
Route::get('/getEditUserProfile', ['as' => 'user.getEditUserProfile', 'uses' => 'ProfileController@getEditUserProfile'])->middleware('auth');
Route::post('/user-editProfile', ['as' => 'user.editprofile', 'uses' => 'ProfileController@editUserProfile'])->middleware('auth');
Route::post('/freezeprofile', ['as' => 'user.freezeprofile', 'uses' => 'ProfileController@freezeprofile'])->middleware('auth');
Route::post('/editPoliticianProfile', ['as' => 'user.editPoliticianProfile', 'uses' => 'ProfileController@editPoliticianProfile'])->middleware('auth');
Route::post('/updateProfilePicture', ['as' => 'user.updateProfilePicture', 'uses' => 'ProfileController@updateProfilePicture'])->middleware('auth');
Route::post('/updateBackgroundPicture', ['as' => 'user.updateBackgroundPicture', 'uses' => 'ProfileController@updateBackgroundPicture'])->middleware('auth');
Route::post('/notify', ['as' => 'candidate.notifyRegister', 'uses' => 'ProfileController@notifyRegister'])->middleware('auth');

/*
 * Wards routes
 */

Route::get('/ward/{id}', 'WardsController@showPoliticiansInWard');

/*
 * Authentication routes
 */

Route::post('/login', ['as' => 'user.login', 'uses' => 'Auth\LoginController@doLogin']);
Route::post('/resendVerification', ['as' => 'user.resendVerification', 'uses' => 'Auth\LoginController@resendVerification']);
Route::post('/logout', ['as' => 'user.logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('/register', ['as' => 'user.register', 'uses' => 'Auth\RegisterController@create']);
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

/*
 * Contact routes
 */

Route::get('contact-us', 'ContactController@contactUS');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactController@contactUSPost']);
Route::get('/email', function () {
    Mail::to('jasontoews88@gmail.com')->send(new capslokmail());
    return view('emails.mailme');
});



Route::get('/home', 'HomeController@index')->name('home');
