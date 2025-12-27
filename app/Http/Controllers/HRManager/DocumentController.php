<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'expiry_date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('employee_documents');

        \App\Models\EmployeeDocument::create([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'type' => $request->type,
            'expiry_date' => $request->expiry_date,
            'file_path' => $filePath,
            'status' => 'Active',
        ]);

        return back()->with('success', 'Document uploaded successfully!');
    }

    public function download(\App\Models\EmployeeDocument $document)
    {
        if (!\Storage::exists($document->file_path)) {
            return back()->with('error', 'File not found.');
        }
        return \Storage::download($document->file_path, $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
    }

    public function destroy(\App\Models\EmployeeDocument $document)
    {
        if (\Storage::exists($document->file_path)) {
            \Storage::delete($document->file_path);
        }
        
        $document->delete();

        return back()->with('success', 'Document deleted successfully!');
    }
}
