<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(
        Request $request,
        string $notification
    ): RedirectResponse {
        $userNotification = $request->user()
            ->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        if ($userNotification->unread()) {
            $userNotification->markAsRead();
        }

        $url = $userNotification->data['url'] ?? route('notifications.index');

        return redirect($url);
    }

    public function markAllAsRead(Request $request): RedirectResponse
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }
}