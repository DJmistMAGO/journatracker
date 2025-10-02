<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Storage;
use App\Notifications\IncidentReportNotification;
use App\Notifications\StatusChangedNotification;
use App\Models\User;

class IncidentReportController extends Controller
{
    public function index()
    {
        $incidents = IncidentReport::orderBy('date_submitted', 'desc')->get();

        return view('spj-content.incident-report.index', compact('incidents'));
    }

    public function show($id)
    {
        $incident = IncidentReport::find($id);

        return view('spj-content.incident-report.show', compact('incident'));
    }

    public function storeReport(Request $request)
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_id_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'incident_description' => 'required|string',
            'image_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle student ID image upload
        if ($request->hasFile('student_id_image')) {
            $file = $request->file('student_id_image');
            $date = date('Y-m-d');
            $extension = $file->getClientOriginalExtension();

            $count = Storage::disk('public')->files('student_ids');
            $todayCount = collect($count)
                ->filter(fn($f) => str_contains(basename($f), "{$data['student_name']}_{$date}_"))
                ->count();
            $increment = $todayCount + 1;

            $filename = "student_id_{$date}_{$increment}.{$extension}";

            $data['student_id_image'] = $file->storeAs('student_ids', $filename, 'public');
        }

        // Handle image proof upload
        if ($request->hasFile('image_proof')) {
            $file = $request->file('image_proof');
            $date = date('Y-m-d');
            $extension = $file->getClientOriginalExtension();

            $count = Storage::disk('public')->files('image_proofs');
            $todayCount = collect($count)
                ->filter(fn($f) => str_contains(basename($f), "{$data['student_name']}_{$date}_"))
                ->count();
            $increment = $todayCount + 1;

            $filename = "image_proof_{$date}_{$increment}.{$extension}";

            $data['image_proof'] = $file->storeAs('image_proofs', $filename, 'public');
        }

        $incident = IncidentReport::create($data);

        $incident->type = 'Incident Report';

        $usersToNotify = User::role(['admin', 'eic'])->get();
        foreach ($usersToNotify as $user) {
            $user->notify(new StatusChangedNotification($incident));
        }

        return redirect()
            ->route('welcome')
            ->with('success', 'Incident report submitted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $incident = IncidentReport::find($id);

        $data = $request->validate([
            'status' => 'required|string',
            'date_status' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        $incident->status = $data['status'];
        $incident->date_status = $data['date_status'];
        $incident->remarks = $data['remarks'];
        $incident->save();

        return redirect()
            ->back()
            ->with('success', 'Incident status updated successfully.');
    }
}
