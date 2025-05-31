    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\ManagerController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\MovieController;
    use App\Http\Controllers\ForgotPasswordController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\RatingController;

//DASHBOARD
Route::get('/public-dashboard', [DashboardController::class, 'index']);


//STATUS
Route::put('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);


//REVIEWS
Route::post('/movies/{movie}/rate', [RatingController::class, 'store']);
Route::delete('/reviews/{id}', [MovieController::class, 'deleteRating']);
Route::get('/admin/ratings', [MovieController::class, 'getAllRatings']);







//PROFILE
Route::get('/profile', [UserController::class, 'profile']);
Route::post('/update-password', [UserController::class, 'updatePassword']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);






// LOGIN & REGISTER
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// MOVIE API Routes
Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::post('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

// USER ROUTES

    Route::get('/users', [UserController::class, 'users']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);



// Role Middleware
Route::middleware(['auth:sanctum', 'role:0'])->group(function() {
    Route::get('/admin', [AuthController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:1'])->group(function() {
    Route::get('/manager', [ManagerController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:2'])->group(function() {
    Route::get('/userdashboard', [UserController::class, 'index']);
    Route::get('/userprofile', [UserController::class, 'userprofile']);
    Route::post('updateprofile', [UserController::class, 'updateprofile']);
   Route::post('/updatepassword', [UserController::class, 'updatePassword']);
});

