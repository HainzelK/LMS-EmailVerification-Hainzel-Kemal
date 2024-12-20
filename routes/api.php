<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\CollectionUpdateController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CDController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\NewspaperController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protect all routes with authentication middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Admin routes
    Route::prefix('admin')->group(function () {
        
        // Librarian Management Routes
        Route::get('/librarians', [AdminController::class, 'index']); // List of librarians
        Route::get('/librarians/create', [AdminController::class, 'createLibrarian']); // Form to add librarian
        Route::post('/librarians', [AdminController::class, 'storeLibrarian']); // Add librarian
        Route::delete('/librarians/{id}', [AdminController::class, 'destroyLibrarian']); // Remove librarian
        
        // Collection Updates Management Routes
        Route::get('/collection-updates', [CollectionUpdateController::class, 'index']); // View collection updates
        Route::post('/collection-updates/{id}', [AdminController::class, 'updateCollectionStatus']); // Approve/Reject update
        
    });

    // Librarian routes
    Route::prefix('librarian')->group(function () {
        
        // Library Inventory Routes
        Route::get('/inventory', [LibrarianController::class, 'index']); // View library inventory
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/cds', [CDController::class, 'index'])->name('cds.index');
        Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
        Route::get('/journals/create', [JournalController::class, 'index'])->name('journals.create');
        Route::get('/newspapers', [NewspaperController::class, 'index'])->name('newspapers.index');
        Route::get('/newspapers/create', [NewspaperController::class, 'index'])->name('newspapers.create');
        Route::post('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/cds/create', [CDController::class, 'create'])->name('cds.create');
        
        // Collection Updates Request Routes
        Route::post('/collection-updates', [LibrarianController::class, 'requestCollectionUpdate']); // Request collection update
        
        // // Reservation Management Routes
        // Route::get('/reservations', [LibrarianController::class, 'indexReservations']); // View reservations
        // Route::post('/reservations/{id}', [LibrarianController::class, 'updateReservationStatus']); // Approve/Reject reservation
        
    });

    // Book Routes (Accessible by both Admin and Librarian)
    Route::resource('books', BookController::class);
});
