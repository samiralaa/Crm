<!DOCTYPE html>
<html lang="pl">
@include('layouts.head', ['title' => 'Email Templates'])
<link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">

<body class="bg-gray-100">

    <div class="flex h-screen" x-data="{ sidebarOpen: false }">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.header')



            <div class="container">
                <div class="card">
                    <div class="card-header">
                        Create Email Template
                    </div>
                    {{-- buttom to create new email template    --}}

                    <div class="card-body">
                        <form action={{ route('email-templates.store') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label" for="name">Name *</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Template Name"
                                required>

                            <label class="form-label" for="subject">Subject *</label>
                            <input type="text" id="subject" name= "subject" class="form-control" placeholder="Template Subject"
                                required>

                            <label class="form-label" for="content-type">Content Type</label>
                            <select id="content-type" name="content_type" class="form-select">
                                <option value="HTML">HTML</option>
                                <option value="Text">Text</option>
                            </select>

                            <label class="form-label" for="content">Content *</label>
                            <textarea id="content" class="form-control" name="content" rows="5" placeholder="Email Content" required></textarea>

                            <div class="form-check">
                                <input type="checkbox" name="enabled" id="enabled" class="form-check-input" value="1">
                                <label for="enabled" class="form-check-label">Enabled</label>
                            </div>


                            <button type="submit" class="btn">Create</button>
                        </form>
                    </div>
                </div>
            </div>


            @include('layouts.footer')
        </div>
    </div>

</body>

</html>
