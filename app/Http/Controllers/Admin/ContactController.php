<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = Contact::latest();

        // Filtrar por estado si se especifica
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Búsqueda por nombre, email o asunto
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(20)->withQueryString();

        $stats = [
            'total' => Contact::count(),
            'unread' => Contact::where('status', 'unread')->count(),
            'read' => Contact::where('status', 'read')->count(),
            'replied' => Contact::where('status', 'replied')->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'stats'));
    }

    public function show(Contact $contact): View
    {
        // Marcar como leído automáticamente al ver
        if ($contact->isUnread()) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead(Contact $contact): RedirectResponse
    {
        $contact->markAsRead();

        return redirect()->back()
            ->with('success', 'Mensaje marcado como leído.');
    }

    public function markReplied(Contact $contact): RedirectResponse
    {
        $contact->markAsReplied();

        return redirect()->back()
            ->with('success', 'Mensaje marcado como respondido.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Mensaje eliminado exitosamente.');
    }
}
