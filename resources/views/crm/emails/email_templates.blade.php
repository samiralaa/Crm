<!DOCTYPE html>
<html lang="pl">
@include('layouts.head', ['title' => 'Email Templates'])
<link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">

<body class="bg-gray-100">

    <div class="flex h-screen" x-data="{ sidebarOpen: false, showDeleteDialog: false, deleteTemplateId: null }">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.header')
            <h1 class=" font-bold text-gray-800">Email Templates</h1>

            <!-- Create New Template Button -->
            <div class=" flex justify-end">
                <a href="{{ route('email-templates.create.form') }}"
                    class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition ease-in-out duration-200">
                    + Create New Template
                </a>
            </div>
            <div class="container mx-auto px-6 mt-6">
                

                <!-- Card for Email Templates -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b">
                        <h2 class="text-xl font-medium text-gray-700">Your Email Templates</h2>
                    </div>
                    <div class="p-6">
                        @if ($email_templates->isEmpty())
                            <div class="text-center py-10 text-gray-500">
                                <p>No email templates found.</p>
                            </div>
                        @else
                            <table class="min-w-full table-auto border-collapse border border-gray-300 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600">
                                        <th class="px-6 py-3 text-left text-sm font-semibold border-b border-gray-300">Template Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold border-b border-gray-300">Subject</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold border-b border-gray-300">Content Type</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold border-b border-gray-300">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($email_templates as $template)
                                        <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                                            <td class="px-6 py-4 text-sm text-gray-700 border-t">{{ $template->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700 border-t">{{ $template->subject }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700 border-t">{{ $template->content_type }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700 border-t">
                                                <a href="{{ route('email-templates.edit.form', $template->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                                |
                                                <a href="javascript:void(0);"
                                                    @click="showDeleteDialog = true; deleteTemplateId = {{ $template->id }}"
                                                    class="text-red-600 hover:text-red-800 font-medium">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Confirmation Dialog -->
            <div x-show="showDeleteDialog" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-lg shadow-lg w-96">
                    <h3 class="text-lg font-semibold text-gray-800">Confirm Delete</h3>
                    <p class="mt-2 text-sm text-gray-600">Are you sure you want to delete this template? This action cannot be undone.</p>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button @click="showDeleteDialog = false"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Cancel</button>
                        <form action="{{ route('email-templates.delete', $template->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="template_id" :value="deleteTemplateId">
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition ease-in-out duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

</body>

</html>
