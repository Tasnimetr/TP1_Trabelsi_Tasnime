<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//1. Recevoir l’information de tous les équipements
Route::get('equipment', [EquipmentController::class, 'index']);

//2. Recevoir l’information d’un équipement en particulier
Route::get('equipment/{id}', [EquipmentController::class, 'show']);

//3. Recevoir l’indice de popularité d’un équipement
Route::get('equipment/{id}/popularity', [EquipmentController::class, 'popularity']);

//4. Créer un utilisateur
Route::post('users', [UserController::class, 'store']); //ou insert?

//5. Mettre à jour un utilisateur (mise à jour complète et non partielle)
Route::put('users/{id}', [UserController::class, 'update']);

//6. Supprimer une critique
Route::delete('reviews/{id}', [ReviewController::class, 'destroy']); //ou delete?

//7. Recevoir la moyenne du prix total de location d’un équipement 
Route::get('equipment/{id}/average_price', [EquipmentController::class, 'averagePrice']);