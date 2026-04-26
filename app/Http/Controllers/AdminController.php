<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Order;
use App\Models\Message;
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
            'pending_messages' => Message::where('status', 'pending')->count(),
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

    public function banUser(User $user)
    {
        if ($user->is_admin) return redirect()->back()->with('error', 'Cannot ban an admin.');
        $user->update(['is_banned' => true]);
        return redirect()->back()->with('success', 'User banned successfully.');
    }

    public function unbanUser(User $user)
    {
        $user->update(['is_banned' => false]);
        return redirect()->back()->with('success', 'User unbanned successfully.');
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

    // Messages
    public function messages()
    {
        $messages = Message::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function replyMessage(Request $request, Message $message)
    {
        $request->validate(['reply' => 'required|string']);
        
        \Illuminate\Support\Facades\Mail::to($message->email)
            ->send(new \App\Mail\ReplyMessageMail($message, $request->reply));

        return redirect()->route('admin.messages.show', $message)->with('success', 'Email sent to the user successfully! The message is still marked as Pending until you resolve it.');
    }

    public function resolveMessage(Message $message)
    {
        $message->update(['status' => 'resolved']);
        return redirect()->back()->with('success', 'Message marked as resolved.');
    }
}
