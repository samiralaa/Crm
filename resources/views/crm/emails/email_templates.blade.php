<!DOCTYPE html>
<html lang="pl">
@include('layouts.head', ['title' => 'Email Templates'])
{{-- <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet"> --}}

<body class="bg-gray-100">

    <div class="flex h-screen" x-data="{ sidebarOpen: false }">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.header')

            <div class="container mx-auto mt-5">
                <h1 class="text-3xl font-semibold mb-6 text-gray-800">Email Templates</h1>

                <!-- Create New Template Button -->
                <div class="mb-4 text-right">
                    <a href="{{ route('email-templates.create.form') }}"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors">
                        Create New Email Template
                    </a>
                </div>

                <!-- Card for Email Templates -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-xl font-medium">Your Email Templates</h2>
                    </div>
                    <div class="p-6">
                        @if ($email_templates->isEmpty())
                            <div class="text-center py-10 text-gray-500">
                                <p>No email templates found.</p>
                            </div>
                        @else
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="text-gray-600">
                                        <th class="px-6 py-3 text-left text-sm font-medium">Template Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">Subject</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">Content Type</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($email_templates as $template)
                                        <tr class="border-t">
                                            <td class="px-6 py-4 text-sm font-medium">{{ $template->name }}</td>
                                            <td class="px-6 py-4 text-sm">{{ $template->subject }}</td>
                                            <td class="px-6 py-4 text-sm">{{ $template->content_type }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <a href="{{ route('email-templates.edit.form', $template->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                                                |
                                                <a href="{{ route('email-templates.delete', $template->id) }}"
                                                    class="text-red-600 hover:text-red-800 font-semibold"
                                                    onclick="return confirm('Are you sure you want to delete this template?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

</body>

</html>
