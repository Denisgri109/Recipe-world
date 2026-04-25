<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_recipes' => Recipe::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Users
    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'bio']));
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.users')->with('error', 'Cannot delete an admin.');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }

    // Recipes
    public function recipes()
    {
        $recipes = Recipe::with('user')->paginate(20);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function deleteRecipe(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes')->with('success', 'Recipe deleted.');
    }

    // Complaints
    public function complaints()
    {
        $complaints = Complaint::latest()->paginate(20);
        return view('admin.complaints.index', compact('complaints'));
    }

    public function showComplaint(Complaint $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    public function replyComplaint(Request $request, Complaint $complaint)
    {
        $request->validate(['reply' => 'required|string']);
        
        // Simulating email send
        // Mail::to($complaint->email)->send(new ReplyMail($complaint, $request->reply));

        $complaint->update(['status' => 'resolved']);
        return redirect()->route('admin.complaints')->with('success', 'Reply recorded and marked as resolved.');
    }
}
