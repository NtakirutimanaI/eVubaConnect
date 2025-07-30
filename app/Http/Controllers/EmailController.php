<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SentEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'attachments.*' => 'file|max:5120', // max 5MB per file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Store attachments if any
        $attachmentsPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('email_attachments', $filename, 'public');
                $attachmentsPaths[] = $path;
            }
        }

        // Prepare data for sending email
        $to = $request->input('to');
        $subject = $request->input('subject');
        $body = $request->input('body');

        // Use authenticated user info as "from"
        $user = Auth::user();
        $fromEmail = $user->email;
        $fromName = $user->name ?? 'Sender';

        try {
            // Send email with attachments
            Mail::send([], [], function ($message) use ($to, $subject, $body, $fromEmail, $fromName, $attachmentsPaths) {
                $message->from($fromEmail, $fromName)
                        ->to($to)
                        ->subject($subject)
                        ->setBody($body, 'text/html');

                foreach ($attachmentsPaths as $path) {
                    // Attach from storage disk 'public'
                    $fullPath = Storage::disk('public')->path($path);
                    $message->attach($fullPath);
                }
            });

            // Save sent email record
            $sentEmail = SentEmail::create([
                'to_email' => $to,
                'subject' => $subject,
                'body' => $body,
                'attachments' => json_encode($attachmentsPaths),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email sent and saved successfully.',
                'data' => $sentEmail,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ], 500);
        }
    }
}
